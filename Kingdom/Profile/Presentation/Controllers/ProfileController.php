<?php

namespace Kingdom\Profile\Presentation\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Kingdom\Integrations\Github\OAuth\Domain\Contracts\GithubOAuthContract;
use Kingdom\Subscriber\Infrastructure\Models\Subscriber;
use Kingdom\Subscription\Application\SubscriptionState;
use Kingdom\Subscription\Domain\Actions\GetActiveSubscriptions;
use Kingdom\Subscription\Domain\Actions\PaginateSubscriptionsById;

class ProfileController extends Controller
{
    public function getProfile(GetActiveSubscriptions $subscriptionState): View
    {
        $currentSubscriptionsStatus = $subscriptionState->handle(auth()->id());
        $isEligible = isset($currentSubscriptionsStatus[0]['entities']) || isset($currentSubscriptionsStatus[1]['entities']);
        /** @var Subscriber $subscriber */
        $subscriber = auth()->user();
        return view('profile::main', [
            'user' => $subscriber,
            'isEligible' => $isEligible,
            'currentSubscriptions' => $currentSubscriptionsStatus,
            'twitchProvider' => $subscriber->providerByName('twitch'),
            'githubProvider' => $subscriber->providerByName('github'),
            'githubUrl' => app(GithubOAuthContract::class)->redirectUrl()
        ]);
    }

    public function viewSubscriptionHistory(
        SubscriptionState         $subscriptionState,
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
