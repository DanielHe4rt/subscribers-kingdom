<?php

namespace Kingdom\Subscriber\Domain\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Kingdom\Subscriber\Domain\DTO\SubscriberDTO;
use Kingdom\Subscriber\Infrastructure\Models\Subscriber;

interface SubscribersRepository
{
    public function paginate(): LengthAwarePaginator;

    public function all(): Collection;

    public function create(SubscriberDTO $dto): Subscriber;

    public function findById(string $subscriberId): Subscriber;

    public function verifyNumber(string $subscriberId, string $phoneNumber): void;

    public function isSubscriberPhoneNumberVerified(string $subscriberId): bool;

    public function isPhoneNumberVerified(string $phoneNumber): bool;
}
