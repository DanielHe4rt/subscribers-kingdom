<?php

namespace Kingdom\Subscriber\Domain\Actions;

use Illuminate\Database\Eloquent\Collection;
use Kingdom\Subscriber\Domain\Repositories\SubscribersRepository;

class GetAllSubscribersAction
{
    public function __construct(private readonly SubscribersRepository $subscribersRepository)
    {
    }

    public function handle(): Collection
    {
        return $this->subscribersRepository->all();
    }
}
