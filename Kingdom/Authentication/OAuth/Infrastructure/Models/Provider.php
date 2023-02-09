<?php

namespace Kingdom\Authentication\OAuth\Infrastructure\Models;


use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Kingdom\Authentication\OAuth\Infrastructure\Factories\ProviderFactory;
use Kingdom\Subscriber\Infrastructure\Models\Subscriber;

/**
 * @property string $id
 * @property Subscriber $subscriber
 * @property Collection<Token> $tokens
 * @property string $user_id
 * @property string $provider_username
 * @property string $provider_id
 * @property string $provider
 */
class Provider extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'subscriber_providers';

    protected $fillable = [
        'id',
        'subscriber_id',
        'provider',
        'provider_id',
        'provider_username',
        'email',
    ];

    public function subscriber(): BelongsTo
    {
        return $this->belongsTo(Subscriber::class);
    }

    public function tokens(): HasMany
    {
        return $this->hasMany(Token::class);
    }

    protected static function newFactory(): ProviderFactory
    {
        return ProviderFactory::new();
    }
}
