<?php

namespace Kingdom\Phone\Domain\Action;

use Kingdom\Integrations\Telesign\Common\TelesignService;
use Kingdom\Integrations\Twilio\Common\TwilioService;
use Kingdom\Shared\Domain\Contracts\MessageContract;

class GetMailingService
{
    public function handle(): MessageContract
    {
        return match(config('kingdom.sms_provider')) {
            'telesign' => app(TelesignService::class)->messages(),
            'twilio' => app(TwilioService::class)->messages()
        };
    }
}
