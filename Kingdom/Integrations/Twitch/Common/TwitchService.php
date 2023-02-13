<?php

namespace Kingdom\Integrations\Twitch\Common;



use Kingdom\Integrations\Twitch\EventSub\Domain\TwitchEventSubService;
use Kingdom\Integrations\Twitch\OAuth\Domain\TwitchOAuthService;
use Kingdom\Integrations\Twitch\Subscriber\Domain\TwitchSubscribersService;

interface TwitchService
{
    public function oauth(): TwitchOAuthService;

    public function subscribers(): TwitchSubscribersService;

    public function eventSub(): TwitchEventSubService;
}
