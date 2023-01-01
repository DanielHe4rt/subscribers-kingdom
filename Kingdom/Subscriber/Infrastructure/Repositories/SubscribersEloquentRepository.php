<?php

namespace Kingdom\Subscriber\Infrastructure\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
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
}
