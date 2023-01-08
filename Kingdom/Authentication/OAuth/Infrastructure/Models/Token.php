<?php

namespace Kingdom\Authentication\OAuth\Infrastructure\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Kingdom\Authentication\OAuth\Infrastructure\Factories\TokenFactory;

class Token extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'subscriber_providers_tokens';

    protected $fillable = [
        'id',
        'provider_id',
        'access_token',
        'refresh_token',
    ];

    public function provider(): BelongsTo
    {
        return $this->belongsTo(Provider::class);
    }

    protected static function newFactory(): TokenFactory
    {
        return TokenFactory::new();
    }
}
