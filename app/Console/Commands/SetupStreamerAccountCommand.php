<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Kingdom\Integrations\Twitch\Common\TwitchService;
use Kingdom\Integrations\Twitch\EventSub\Domain\DTOs\EventSubDTO;
use Kingdom\Integrations\Twitch\EventSub\Domain\Enums\EventSubTypesEnum;

class SetupStreamerAccountCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'kingdom:setup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Testing stuff.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(TwitchService $twitchService): int
    {
        $events = [
            EventSubTypesEnum::STREAM_ONLINE,
            EventSubTypesEnum::STREAM_OFFLINE,
            EventSubTypesEnum::NEW_SUBSCRIPTION,
            EventSubTypesEnum::RE_SUBSCRIPTION
        ];


        $credentials = $twitchService->oauth()->authApp();
        Cache::set('twitch-app-token', $credentials->accessToken);

        foreach ($events as $event) {
            $eventDTO = new EventSubDTO(
                $event,
                ['broadcaster_user_id' => config('kingdom.integrations.twitch.channel_id')],
                config('app.url') . '/webhooks/twitch' . rand(1,9999)
            );

            $response = $twitchService
                ->eventSub()
                ->createSubscription($eventDTO);
        }

        return self::SUCCESS;
    }
}
