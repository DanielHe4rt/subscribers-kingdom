<?php

namespace Kingdom\Subscriber\Infrastructure\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Kingdom\Subscriber\Infrastructure\Factories\SubscriberFactory;

class Subscriber extends Authenticatable
{
    use HasFactory, Notifiable, HasUuids;

    protected $fillable = [
        'id',
        'username',
        'email_id',
        'phone_number',
    ];

    protected static function newFactory(): Factory
    {
        return SubscriberFactory::new();
    }

    public function getAuthIdentifierName()
    {
        return parent::getAuthIdentifierName();

        return '';
    }

    public function getAuthIdentifier()
    {
        return parent::getAuthIdentifier();
        // dd($fodase);
        return '';
    }
}
