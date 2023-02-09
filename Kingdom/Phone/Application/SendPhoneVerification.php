<?php

namespace Kingdom\Phone\Application;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Kingdom\Integrations\Twilio\Common\TwilioService;
use Kingdom\Phone\Domain\DTOs\MobileVerificationDTO;
use Kingdom\Subscriber\Domain\Repositories\SubscribersRepository;
use Ramsey\Uuid\Uuid;

class SendPhoneVerification
{
    public function __construct(
        private readonly SubscribersRepository $subscribersRepository,
        private readonly TwilioService         $twilioService,
    )
    {
    }


    public function sendMessage(string $subscriberId, string $phoneNumber): void
    {
        $mobileDTO = MobileVerificationDTO::make(
            $this->subscribersRepository->findById($subscriberId),
            '+55' . $phoneNumber
        );

        // TODO: validate if number is already registered

        $generatedSubscriberToken = $this->generateSubscriberToken($mobileDTO);
        $message = $this->buildMessage($mobileDTO, $generatedSubscriberToken);

        $this->twilioService->messages()->sendMessage($mobileDTO->phoneNumber, $message);
    }

    private function generateSubscriberToken(MobileVerificationDTO $mobileDTO): string
    {
        $hashedToken = strtolower(Str::random(6));
        Cache::tags(['phone-tokens'])->put($hashedToken, $mobileDTO, 60 * 5);
        Cache::tags(['awaiting-validation'])->put($mobileDTO->subscriber->id, true, 60 * 5);

        return $hashedToken;
    }

    private function buildMessage(MobileVerificationDTO $mobileDTO, string $accessCode): string
    {
        return sprintf(
            "Salve %s, tranquilidade? Cê tá recebendo essa mensagem pra verificar seu zap" .
            " no grupo de subs do daniel coração. Pra verificar use esse código: %s",
            $mobileDTO->subscriber->username,
            $accessCode
        );
    }
}
