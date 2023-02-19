<?php

namespace Tests\Feature\Phone;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Queue;
use Kingdom\Phone\Infrastructure\Jobs\SendMessageJob;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class SendPhoneVerificationTest extends TestCase
{
    use DatabaseMigrations;

    public function testCanVerify(): void
    {
        Queue::fake();
        $result = $this->actingAsSubscriber()
            ->post(route('subscribers.send-code'), [
                'phone_number' => '11985863714'
            ]);

        $result->assertStatus(Response::HTTP_FOUND);

        Queue::assertPushed(SendMessageJob::class);
    }

    public function testAlreadyVerified(): void
    {
        $result = $this->actingAsSubscriber([
            'phone_verified_at' => now(),
            'phone_number' => '+5511985863714'
        ])->post(route('subscribers.send-code'), [
            'phone_number' => '+5511985863714'
        ]);

        $result->assertStatus(Response::HTTP_FOUND)
            ->assertRedirectToRoute('profile')
            ->assertSee(':/');
    }
}
