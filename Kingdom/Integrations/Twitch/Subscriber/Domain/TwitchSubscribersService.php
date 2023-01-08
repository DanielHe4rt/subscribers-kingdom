<?php

namespace Kingdom\Integrations\Twitch\Subscriber\Domain;

interface TwitchSubscribersService
{
    public function getSubscriptionState(string $twitchId, string $channelId);
}
