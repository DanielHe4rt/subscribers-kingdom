<?php

namespace Kingdom\Authentication\Infrastructure\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Kingdom\Authentication\Infrastructure\Models\Provider;
use Kingdom\Authentication\Infrastructure\Models\Token;

class TokenFactory extends Factory
{
    protected $model = Token::class;
    public function definition(): array
    {
        return [
            'id' => $this->faker->uuid(),
            'provider_id' => Provider::factory(),
            'access_token' => $this->faker->uuid(),
            'refresh_token' => $this->faker->uuid(),
            'expires_in' => $this->faker->randomNumber(4)
        ];
    }
}
