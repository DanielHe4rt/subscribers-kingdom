<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Kingdom\Integrations\Twitch\Common\TwitchService;
use Kingdom\Integrations\Twitch\EventSub\Domain\DTOs\EventSubDTO;
use Kingdom\Integrations\Twitch\EventSub\Domain\Enums\EventSubTypesEnum;

class ImportPastSubscribersCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subs:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import the past subscribers list into the system.';


    public function handle(): int
    {
        // TODO: import service

        return self::SUCCESS;
    }
}
