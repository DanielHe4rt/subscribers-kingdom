<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Kingdom\Subscriber\Infrastructure\Models\Subscriber;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function actingAsSubscriber(array $payload = []): self
    {
        $subscriber = Subscriber::factory()->create($payload);
        return $this->actingAs($subscriber);
    }
}
