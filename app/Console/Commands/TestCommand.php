<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Kingdom\Integrations\Twitch\Common\TwitchService;
use Kingdom\Integrations\Twitch\EventSub\Domain\DTOs\EventSubDTO;
use Kingdom\Integrations\Twitch\EventSub\Domain\Enums\EventSubTypesEnum;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'testing';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(TwitchService $twitchService): int
    {
        $eventDTO = new EventSubDTO(
            EventSubTypesEnum::NEW_SUBSCRIPTION,
            ['broadcaster_user_id' => 123],
            config('app.url') . '/webhooks/twitch'
        );

        $response = $twitchService
            ->eventSub()
            ->listSubscriptions();

        foreach ($response as $a) {
            $twitchService->eventSub()->deleteSubscription($a);
        }


        return self::SUCCESS;
    }
}
