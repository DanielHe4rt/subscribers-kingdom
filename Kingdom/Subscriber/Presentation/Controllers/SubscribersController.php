<?php

namespace Kingdom\Subscriber\Presentation\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Kingdom\Subscriber\Domain\Actions\GetAllSubscribersAction;

class SubscribersController extends Controller
{
    public function getSubscribers(GetAllSubscribersAction $action): JsonResponse
    {
        return response()->json($action->handle());
    }
}
