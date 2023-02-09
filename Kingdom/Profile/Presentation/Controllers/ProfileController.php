<?php

namespace Kingdom\Profile\Presentation\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Kingdom\Subscriber\Infrastructure\Models\Subscriber;
use Kingdom\Subscription\Application\SubscriptionState;
use Kingdom\Subscription\Domain\Actions\GetSubscriptionStatus;

class ProfileController extends Controller
{
    public function getProfile(SubscriptionState $action): View
    {
        $data = $action->handle(auth()->id(), 'twitch');

        /** @var Subscriber $subscriber */
        $subscriber = auth()->user();
        return view('profile::main', [
            'user' => $subscriber
        ]);
    }
}
