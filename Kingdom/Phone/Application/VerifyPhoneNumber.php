<?php

namespace Kingdom\Phone\Application;

use Illuminate\Support\Facades\Cache;
use Kingdom\Phone\Application\Exceptions\PhoneNumberException;
use Kingdom\Phone\Domain\DTOs\MobileVerificationDTO;
use Kingdom\Subscriber\Domain\Repositories\SubscribersRepository;

class VerifyPhoneNumber
{
    public function __construct(
        private readonly SubscribersRepository $subscribersRepository
    )
    {
    }

    public function fromCode(string $code): void
    {
        $mobileDTO = $this->getValidationFromCache($code);

        if (!$mobileDTO) {
            throw PhoneNumberException::invalidToken();
        }

        $this->subscribersRepository->verifyNumber(
            $mobileDTO->subscriber->id,
            $mobileDTO->phoneNumber
        );

        Cache::tags(['phone-tokens'])->delete($code);
    }

    private function getValidationFromCache(string $code): ?MobileVerificationDTO
    {
        return Cache::tags(['phone-tokens'])->get($code);
    }
}
