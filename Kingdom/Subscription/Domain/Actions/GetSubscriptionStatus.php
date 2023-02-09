<?php

namespace Kingdom\Subscription\Domain\Actions;

use GuzzleHttp\Exception\ClientException;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Kingdom\Authentication\OAuth\Domain\DTO\OAuthAccessDTO;
use Kingdom\Authentication\OAuth\Domain\Repositories\ProviderRepository;
use Kingdom\Authentication\OAuth\Infrastructure\Models\Provider;
use Kingdom\Integrations\Twitch\Common\TwitchService;
use Kingdom\Integrations\Twitch\OAuth\Domain\DTO\TwitchOAuthAccessDTO;
use Kingdom\Integrations\Twitch\Subscriber\Domain\DTO\TwitchSubscriberDTO;
use Kingdom\Subscriber\Domain\DTO\SubscriberProviderDTO;
use Kingdom\Subscriber\Domain\Repositories\SubscribersRepository;

class GetSubscriptionStatus
{
    public function __construct(
        private readonly SubscribersRepository $subscribersRepository,
        private readonly TwitchService         $twitchService
    )
    {
    }

    public function handle(string $subscriberId, string $provider): ?TwitchSubscriberDTO
    {
        $subscriber = $this->subscribersRepository->findById($subscriberId);
        [$accessDTO, $providerDTO] = $this->transformProviderData(
            $subscriber->credentialsByProvider($provider)
        );
        return $this->getSubscriptionState($accessDTO, $providerDTO);
    }


    private function transformProviderData(array $providerData): array
    {
        return [
            TwitchOAuthAccessDTO::make($providerData['access']),
            SubscriberProviderDTO::make($providerData['provider'])
        ];
    }


    private function getSubscriptionState(OAuthAccessDTO $accessDTO, SubscriberProviderDTO $provider): ?TwitchSubscriberDTO
    {
        try {
            return $this->twitchService
                ->subscribers()
                ->getSubscriptionState(
                    $accessDTO,
                    $provider->providerId,
                    config('kingdom.integrations.twitch.channel_id')
                );
        } catch (ClientException $e) {
            // not subscriber on twitch yet
            return null;
        }
    }
}
