<?php

namespace Kingdom\Subscriber\Infrastructure\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Kingdom\Authentication\OAuth\Infrastructure\Models\Provider;
use Kingdom\Authentication\OAuth\Infrastructure\Models\Token;
use Kingdom\Subscriber\Infrastructure\Factories\SubscriberFactory;

/**
 * @property string $id
 * @property string $username
 * @property int $email_id
 * @property string $phone_number
 */
class Subscriber extends Authenticatable
{
    use HasFactory, Notifiable, HasUuids;

    protected $fillable = [
        'id',
        'username',
        'email_id',
        'phone_number',
        'avatar_url',
    ];

    protected static function newFactory(): Factory
    {
        return SubscriberFactory::new();
    }

    public function lastToken(string $provider = null): HasManyThrough
    {
        return $this->hasManyThrough(Token::class, Provider::class)
            ->when(!is_null($provider), fn ($query) => $query->where('provider', $provider))
            ->orderByDesc('created_at');
    }

    public function providers(): HasMany
    {
        return $this->hasMany(Provider::class);
    }

    public function providerByName(string $provider): HasOne
    {
        return $this->hasOne(Provider::class)
            ->where('provider', $provider);
    }

    public function credentialsByProvider(string $provider): array
    {
        return [
            'access' => $this->lastToken($provider)->first()->toArray(),
            'provider' => $this->providerByName($provider)->first()->toArray()
        ];
    }
}
