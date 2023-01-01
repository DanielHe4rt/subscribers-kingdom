<?php

namespace Kingdom\Core\Classes;

use FilesystemIterator;
use Kingdom\Core\Contracts\DomainInterface;
use Kingdom\Core\Exceptions\DomainNotExistsException;
use Kingdom\Core\Exceptions\DomainExtendException;
use Kingdom\Core\Traits\Singleton;
use RecursiveIteratorIterator;
use Illuminate\Support\Facades\File;
use RecursiveDirectoryIterator;
use Illuminate\Support\Str;


class DomainManager
{

    use Singleton;

    public array $domains = [];

    public bool $booted = false;

    public bool $registered = false;

    protected array $normalizedMap;

    protected array $pathMap;

    /**
     * @codeCoverageIgnore
     */
    protected function init()
    {
        $this->loadDomains();
    }

    public function loadDomains(): array
    {
        /**
         * Locate all domains and binds them to the container
         */
        foreach ($this->getDomainNamespaces() as $namespace => $path) {
            $this->loadDomain($namespace, $path);
        }

        return $this->domains;
    }

    /**
     * Returns a flat array of vendor domain namespaces and their paths
     *
     * @return array
     */
    public function getDomainNamespaces(): array
    {
        $classNames = [];

        foreach ($this->getVendorAndDomainNames() as $vendorName => $vendorList) {
            foreach ($vendorList as $domainName => $domainPath) {
                $namespace = '\\' . $vendorName . '\\' . $domainName;
                $namespace = $this->normalizeClassName($namespace);
                $classNames[$namespace] = $domainPath;
            }
        }

        return $classNames;
    }

    public function normalizeClassName($name): string
    {
        if (is_object($name)) {
            $name = get_class($name);
        }

        return '\\' . ltrim($name, '\\');
    }

    /**
     * Returns a 2 dimensional array of vendors and their domains.
     *
     * @return array
     */
    public function getVendorAndDomainNames(): array
    {
        $dir = __DIR__ . '/../../';
        $domains = [];
        $dirPath = realpath($dir);
        $dirPathSeparated = explode('/', $dirPath);
        $coreDomain = array_pop($dirPathSeparated);
        if (!File::isDirectory($dirPath)) {
            return $domains;
        }

        $it = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($dirPath, FilesystemIterator::FOLLOW_SYMLINKS)
        );
        $it->setMaxDepth();
        $it->rewind();

        while ($it->valid()) {
            if ($it->isFile() && (strtolower($it->getFilename()) == 'domain.php')) {
                $filePath = dirname($it->getPathname());
                $vendorPaths = array_reverse(explode('/', $filePath));
                $domainName = basename($filePath);
                $vendorName = $this->getPathFromCoreDomain($coreDomain, $vendorPaths);
                $domains[$vendorName][$domainName] = $filePath;
            }

            $it->next();
        }

        return $domains;
    }

    /**
     * Returns a path to a subdomain from the core domain
     *
     * @param string $coreDomain
     * @param array $vendorPaths
     * @return string
     */
    private function getPathFromCoreDomain(string $coreDomain, array $vendorPaths): string
    {
        $vendorName = '';
        $vendorPaths = array_slice($vendorPaths, 1); // Removing domain name

        foreach ($vendorPaths as $vendorPath) {
            $vendorName = $vendorPath . '\\' . $vendorName;
            if ($vendorPath === $coreDomain) {
                break;
            }
        }

        return rtrim($vendorName, '\\');
    }

    /**
     * Loads a single domain into the manager.
     *
     * @param string|object $namespace Eg: Lms\Auth
     * @param string $path Eg: 'LMS/Auth';
     * @return void|DomainInterface
     *
     * @throws DomainNotExistsException
     * @throws DomainExtendException
     */
    public function loadDomain($namespace, string $path)
    {
        $class = $this->getDomainClassName($namespace);

        // Not a valid domain!
        if (is_string($class) && !class_exists($class)) {
            throw new DomainNotExistsException('Domain ' . $class . ' could not be instantiated.');
        }

        if (realpath($path) === false) {
            throw new DomainNotExistsException('Path ' . $path . ' not exists.');
        }

        if (!is_subclass_of($class, DomainInterface::class)) {
            throw new DomainExtendException('The domain must extend the abstract class \TruckPag\Core\Contracts\DomainInterface');
        }

        if (!is_object($class)) {
            /** @var DomainInterface $class */
            $class = new $class();
        }

        $classId = $this->getIdentifier($class);
        /*
         * Check for disabled domains
         */
        if ($class->isDisabled()) {
            return;
        }

        $this->domains[$classId] = $class;
        $this->pathMap[$classId] = $path;
        $this->normalizedMap[strtolower($classId)] = $classId;

        return $class;
    }

    /**
     * @param object|string $class
     * @return string|object
     */
    private function getDomainClassName($class)
    {
        if (is_object($class)) {
            return $class;
        }

        if (is_string($class) && !Str::endsWith($class, 'Domain')) {
            return $class . '\Domain';
        }

        return $class;
    }

    /**
     * Resolves a domain identifier
     *
     * @param mixed $namespace Domain class name or object
     * @return string           Identifier in format of Domain
     */
    public function getIdentifier($namespace): string
    {
        $namespace = $this->normalizeClassName($namespace);
        if (str_contains($namespace, '\\')) {
            return $namespace;
        }

        $parts = explode('\\', $namespace);
        $slice = array_slice($parts, 1, 2);

        return implode('.', $slice);
    }

    /**
     * @return array
     */
    public function getProviders(): array
    {
        $providers = [];
        /** @var DomainInterface $domainObj * */
        foreach ($this->domains as $domainObj) {
            $providers = array_merge($providers, $domainObj->registerProvider());
        }

        return $providers;
    }


}
