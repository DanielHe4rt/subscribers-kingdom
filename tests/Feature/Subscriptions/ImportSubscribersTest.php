<?php

namespace Tests\Feature\Subscriptions;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Kingdom\Subscription\Application\ImportSubscribers;
use Tests\TestCase;

class ImportSubscribersTest extends TestCase
{
    use DatabaseMigrations;

    public function testCanImport()
    {
        $importSubscribers = app(ImportSubscribers::class);

        $importSubscribers->fromCSV();
    }
}
