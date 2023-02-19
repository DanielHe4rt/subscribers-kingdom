<?php

namespace Kingdom\Subscriber\Infrastructure\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Kingdom\Subscriber\Domain\DTO\SubscriberDTO;
use Kingdom\Subscriber\Domain\Repositories\SubscribersRepository;
use Kingdom\Subscriber\Infrastructure\Models\Subscriber;

class SubscribersEloquentRepository implements SubscribersRepository
{

    public function paginate(): LengthAwarePaginator
    {
        return Subscriber::paginate(15);
    }

    public function all(): Collection
    {
        return Subscriber::get();
    }

    public function create(SubscriberDTO $dto): Subscriber
    {
        return Subscriber::create($dto->toDatabase());
    }

    public function findById(string $subscriberId): Subscriber
    {
        return Subscriber::find($subscriberId);
    }

    public function verifyNumber(string $subscriberId, string $phoneNumber): void
    {
        Subscriber::find($subscriberId)->update([
            'phone_verified_at' => now(),
            'phone_number' => $phoneNumber
        ]);
    }

    public function isPhoneNumberVerified(string $subscriberId, string $phoneNumber): bool
    {
        return Subscriber::whereNotNull('phone_verified_at')
            ->whereNotNull('phone_number')
            ->where('id', '=' , $subscriberId)
            ->exists();
    }
}
