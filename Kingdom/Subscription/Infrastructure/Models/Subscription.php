<?php

namespace Kingdom\Subscription\Infrastructure\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $subscriber_id
 * @property string $provider
 * @property string $username
 * @property \Carbon\Carbon $subscribed_at
 */
class Subscription extends Model
{
    protected $table = 'subscriptions';

    protected $fillable = [
        'subscriber_id',
        'provider',
        'provider_id',
        'username',
        'subscribed_at',
    ];

    protected $appends = [
        'is_active'
    ];

    protected $casts = [
        'subscribed_at' => 'datetime',
        'is_active' => 'bool'
    ];

    public function getIsActiveAttribute(): bool
    {
        return $this->subscribed_at->isFuture();
    }
}
