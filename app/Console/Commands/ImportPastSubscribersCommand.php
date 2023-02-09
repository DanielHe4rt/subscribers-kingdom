<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

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

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {


        return self::SUCCESS;
    }
}
