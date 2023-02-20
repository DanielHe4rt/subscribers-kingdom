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
use Kingdom\Subscription\Infrastructure\Models\Subscription;

/**
 * @property string $id
 * @property string $username
 * @property int $email_id
 * @property string $phone_number
 * @property \Carbon\Carbon $phone_verified_at
 */
class Subscriber extends Authenticatable
{
    use HasFactory, Notifiable, HasUuids;

    protected $fillable = [
        'id',
        'username',
        'email_id',
        'phone_number',
        'phone_verified_at',
        'avatar_url',
    ];

    protected $appends = [
        'months_subscribed'
    ];

    protected $casts = [
        'phone_verified_at' => 'datetime',
    ];

    public function monthsSubscribed(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->subscriptions()->count()
        );
    }

    public function subscriptions(): HasMany
    {
        return $this->hasMany(Subscription::class);
    }

    protected static function newFactory(): Factory
    {
        return SubscriberFactory::new();
    }

    public function lastToken(string $provider = null): Token
    {
        return $this->hasOne(Provider::class)
            ->whereProvider($provider)
            ->first()
            ->tokens()
            ->orderByDesc('created_at')
            ->first();
    }

    public function providers(): HasMany
    {
        return $this->hasMany(Provider::class);
    }

    public function providerByName(string $provider): ?Provider
    {
        return $this->hasOne(Provider::class)->where('provider', $provider)->first();
    }

    public function credentialsByProvider(string $provider): array
    {
        return [
            'access' => $this->lastToken($provider)->toArray(),
            'provider' => $this->providers()
                ->whereProvider($provider)
                ->first()
                ->toArray()
        ];
    }
}
