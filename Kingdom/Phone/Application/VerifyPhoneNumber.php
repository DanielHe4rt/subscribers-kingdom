<?php

namespace Kingdom\Phone\Application;

use Illuminate\Support\Facades\Cache;
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
            throw new \Exception('token não vinculado à nenhum dispositivo');
        }

        $this->subscribersRepository->verifyNumber(
            $mobileDTO->subscriber->id,
            $mobileDTO->phoneNumber
        );
    }

    private function getValidationFromCache(string $code): ?MobileVerificationDTO
    {
        return Cache::tags(['phone-tokens'])->get($code);
    }
}
