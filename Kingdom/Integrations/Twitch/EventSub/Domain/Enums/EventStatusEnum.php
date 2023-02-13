<?php

namespace Kingdom\Integrations\Twitch\EventSub\Domain\Enums;

enum EventStatusEnum: string
{
    case PENDING = 'webhook_callback_verification_pending';
    case FAILED = 'webhook_callback_verification_failed';
}
