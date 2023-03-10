<?php

namespace Kingdom\Subscriber\Infrastructure\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Kingdom\Subscriber\Infrastructure\Models\Subscriber;

class SubscriberFactory extends Factory
{
    protected $model = Subscriber::class;

    public function definition(): array
    {
        return [
            'id' => $this->faker->uuid(),
            'username' => $this->faker->name(),
            'phone_number' => $this->faker->phoneNumber(),
            'phone_verified_at'=> $this->faker->dateTime(),
            'email_id' => null,
        ];
    }
}
