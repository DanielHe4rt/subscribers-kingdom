<?php

namespace Kingdom\Subscriber\Domain\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface SubscribersRepository
{
    public function paginate(): LengthAwarePaginator;

    public function all(): Collection;
}
