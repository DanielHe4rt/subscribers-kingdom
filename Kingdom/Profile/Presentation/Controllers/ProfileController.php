<?php

namespace Kingdom\Profile\Presentation\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Kingdom\Integrations\Github\OAuth\Domain\Contracts\GithubOAuthContract;
use Kingdom\Subscriber\Infrastructure\Models\Subscriber;
use Kingdom\Subscription\Application\SubscriptionState;
use Kingdom\Subscription\Domain\Actions\PaginateSubscriptionsById;

class ProfileController extends Controller
{
    public function getProfile(SubscriptionState $subscriptionState): View
    {
        $currentSubscriptionStatus = $subscriptionState->handle(auth()->id(), 'twitch');

        /** @var Subscriber $subscriber */
        $subscriber = auth()->user();
        return view('profile::main', [
            'user' => $subscriber,
            'currentSubscription' => $currentSubscriptionStatus,
            'twitchProvider' => $subscriber->providerByName('twitch'),
            'githubProvider' => $subscriber->providerByName('github'),
            'githubUrl' => app(GithubOAuthContract::class)->redirectUrl()
        ]);
    }

    public function viewSubscriptionHistory(
        SubscriptionState $subscriptionState,
        PaginateSubscriptionsById $subscriptions

    ): View
    {
        /** @var Subscriber $subscriber */
        $subscriber = auth()->user();
        $currentSubscriptionStatus = $subscriptionState->handle(auth()->id(), 'twitch');

        return view('profile::history', [
            'user' => $subscriber,
            'currentSubscription' => $currentSubscriptionStatus,
            'subscriptions' => $subscriptions->paginate(auth()->id())
        ]);
    }
}
