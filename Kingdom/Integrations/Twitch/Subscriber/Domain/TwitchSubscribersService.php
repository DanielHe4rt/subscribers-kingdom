<?php

namespace Kingdom\Integrations\Twitch\Subscriber\Domain;

use Kingdom\Authentication\OAuth\Domain\DTO\OAuthAccessDTO;

interface TwitchSubscribersService
{
    public function getSubscriptionState(OAuthAccessDTO $dto, string $twitchId, string $channelId);
}
