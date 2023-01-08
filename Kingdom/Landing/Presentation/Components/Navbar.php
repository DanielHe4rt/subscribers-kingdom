<?php

namespace Kingdom\Landing\Presentation\Components;

use Illuminate\View\Component;
use Illuminate\View\View;
use Kingdom\Integrations\Twitch\OAuth\Domain\TwitchOAuthService;

class Navbar extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(private readonly TwitchOAuthService $service)
    {
        //
    }

    public function render(): View
    {

        return view('landing::components.navbar', [
            'twitchUrl' => $this->service->redirectUrl()
        ]);
    }
}
