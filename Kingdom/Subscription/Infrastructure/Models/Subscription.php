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
        'username',
        'subscribed_at',
    ];

    protected $casts = [
        'subscribed_at' => 'datetime'
    ];
}
