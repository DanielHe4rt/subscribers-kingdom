<?php

namespace Kingdom\Authentication\OAuth\Application;

use Illuminate\Support\Facades\Auth;
use Kingdom\Authentication\OAuth\Domain\Actions\GetOAuthUser;
use Kingdom\Authentication\OAuth\Domain\Repositories\ProviderRepository;
use Kingdom\Authentication\OAuth\Domain\Repositories\TokenRepository;
use Kingdom\Subscriber\Domain\DTO\SubscriberDTO;
use Kingdom\Subscriber\Domain\Repositories\SubscribersRepository;

final readonly class OAuthService
{
    public function __construct(
        private GetOAuthUser          $getUserAction,
        private ProviderRepository    $providerRepository,
        private TokenRepository       $tokenRepository,
        private SubscribersRepository $subscribersRepository
    )
    {
    }

    public function handle(string $provider, string $code)
    {
        $providerUser = $this->getUserAction->handle($provider, $code);
        $persistedProvider = $this->providerRepository->findByProvider($providerUser);

        if ($persistedProvider) {
            $this->tokenRepository->create($persistedProvider->getKey(), $providerUser->credentials);
            Auth::login($persistedProvider->subscriber);
            return;
        }

        $subscriberId = Auth::check()
            ? Auth::id()
            : $this->subscribersRepository->create(new SubscriberDTO($providerUser->username))->getKey();

        $persistedProvider = $this->providerRepository->create($subscriberId, $providerUser);
        $this->tokenRepository->create($persistedProvider->getKey(), $providerUser->credentials);

        Auth::login($persistedProvider->subscriber);
    }
}
