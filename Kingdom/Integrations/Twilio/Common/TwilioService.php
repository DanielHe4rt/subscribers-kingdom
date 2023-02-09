<?php

namespace Kingdom\Integrations\Twilio\Common;

use Kingdom\Integrations\Twilio\Messages\Infrastructure\TwilioMessageClient;

interface TwilioService
{
    public function messages(): TwilioMessageClient;
}
