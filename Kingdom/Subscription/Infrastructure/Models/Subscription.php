<?php

namespace Kingdom\Subscription\Infrastructure\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = [
        'subscriber_id',
        'provider',
        'username',
        'subscribed_at',
    ];
}
