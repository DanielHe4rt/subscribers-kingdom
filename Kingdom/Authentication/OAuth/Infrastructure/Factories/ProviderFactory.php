<?php

namespace Kingdom\Authentication\OAuth\Infrastructure\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Kingdom\Authentication\OAuth\Infrastructure\Models\Provider;
use Kingdom\Subscriber\Infrastructure\Models\Subscriber;

class ProviderFactory extends Factory
{
    protected $model = Provider::class;
    public function definition(): array
    {
        return [
            'id' => $this->faker->uuid(),
            'subscriber_id' => Subscriber::factory(),
            'provider' => $this->faker->randomElement(['twitch', 'google', 'apoiase', 'github']),
            'provider_id' => $this->faker->uuid,
            'email' => $this->faker->unique()->email,
        ];
    }
}
