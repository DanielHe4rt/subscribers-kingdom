<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Kingdom\Integrations\Twitch\Common\TwitchService;
use \Kingdom\Integrations\Twitch\EventSub\Domain\Entities\EventSubEntity;

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
        $response = $twitchService
            ->eventSub()
            ->listSubscriptions();

        /** @var EventSubEntity $eventSubEntity */
        foreach ($response as $eventSubEntity) {
            $this->info(sprintf('%s : %s', $eventSubEntity->typesEnum->value, $eventSubEntity->status->value));
            $twitchService->eventSub()->deleteSubscription($eventSubEntity);
        }


        return self::SUCCESS;
    }
}
