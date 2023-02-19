<?php

namespace Kingdom\Phone\Application;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Str;
use Kingdom\Integrations\Twilio\Common\TwilioService;
use Kingdom\Phone\Application\Exceptions\PhoneNumberException;
use Kingdom\Phone\Domain\Action\GetMailingService;
use Kingdom\Phone\Domain\DTOs\MobileVerificationDTO;
use Kingdom\Phone\Infrastructure\Jobs\SendMessageJob;
use Kingdom\Subscriber\Domain\Repositories\SubscribersRepository;
use Ramsey\Uuid\Uuid;

class SendPhoneVerification
{
    public function __construct(
        private readonly SubscribersRepository $subscribersRepository,
    )
    {
    }


    public function sendMessage(string $subscriberId, string $phoneNumber): void
    {
        $mobileDTO = MobileVerificationDTO::make(
            $this->subscribersRepository->findById($subscriberId),
            '+55' . $phoneNumber
        );

        $isSubscriberPhoneNumberVerified = $this->subscribersRepository->isSubscriberPhoneNumberVerified($subscriberId);
        if ($isSubscriberPhoneNumberVerified) {
            throw PhoneNumberException::alreadyVerified();
        }

        $isPhoneNumberVerified = $this->subscribersRepository->isPhoneNumberVerified($mobileDTO->phoneNumber);
        if ($isPhoneNumberVerified) {
            throw PhoneNumberException::alreadyRegisteredOnSomeoneElseAccount();
        }

        $generatedSubscriberToken = $this->generateSubscriberToken($mobileDTO);
        Queue::connection('redis')->push(new SendMessageJob($mobileDTO, $generatedSubscriberToken));
    }


    private function generateSubscriberToken(MobileVerificationDTO $mobileDTO): string
    {
        $token = rand(111111, 999999);
        Cache::tags(['phone-tokens'])->put($token, $mobileDTO, 60 * 5);
        Cache::tags(['awaiting-validation'])->put($mobileDTO->subscriber->id, true, 60 * 5);

        return $token;
    }


}
