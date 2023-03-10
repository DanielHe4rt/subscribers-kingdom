<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Kingdom\Integrations\Twitch\Common\TwitchService;
use Kingdom\Integrations\Twitch\EventSub\Domain\DTOs\EventSubDTO;
use Kingdom\Integrations\Twitch\EventSub\Domain\Enums\EventSubTypesEnum;
use Kingdom\Subscriber\Domain\DTO\SubscriberDTO;
use Kingdom\Subscription\Application\ImportSubscribers;
use Kingdom\Subscription\Domain\DTO\NewSubscriberDTO;
use Kingdom\Subscription\Domain\Enums\SubscriptionSpreadsheetsEnum;

class ImportPastSubscribersCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'kingdom:subs:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import the past subscribers list into the system.';


    public function handle(ImportSubscribers $importSubscribers): int
    {
        $lists = $this->prepareSubscriptionLists();

        $importSubscribers->fromCSV(
            $lists,
            fn(NewSubscriberDTO $dto) => $this->info($dto->username . ' - ' . $dto->subscribedAt->format('c'))
        );

        return self::SUCCESS;
    }

    /**
     * @return array
     */
    public function prepareSubscriptionLists(): array
    {
        $lists = [];
        foreach (SubscriptionSpreadsheetsEnum::all() as $spreadsheetsEnum) {
            $spreadsheetUrl = $this->secret('Spreadsheet URL for >' . $spreadsheetsEnum->value);
            $lists[] = [
                $spreadsheetsEnum,
                $spreadsheetUrl
            ];
        }
        return $lists;
    }
}
