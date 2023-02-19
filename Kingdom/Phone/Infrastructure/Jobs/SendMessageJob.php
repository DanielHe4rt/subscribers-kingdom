<?php

namespace Kingdom\Phone\Infrastructure\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Kingdom\Phone\Domain\Action\GetMailingService;
use Kingdom\Phone\Domain\DTOs\MobileVerificationDTO;

class SendMessageJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        private readonly MobileVerificationDTO $mobileDTO,
        private readonly int                   $token
    )
    {
    }

    public function handle(GetMailingService $mailingService): void
    {
        $message = $this->buildMessage();

        $mailingService = $mailingService->retrieve();
        $mailingService->sendSMS($this->mobileDTO->phoneNumber, $message);
    }

    private function buildMessage(): string
    {
        return sprintf(
            "Salve %s, tranquilidade? Código de verificação do Daniel Coração: %s",
            $this->mobileDTO->subscriber->username,
            $this->token
        );
    }
}
