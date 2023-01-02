<?php

namespace Kingdom\Authentication\Presentation\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Kingdom\Authentication\Application\AuthenticateService;
use Kingdom\Authentication\Domain\Actions\RedirectOAuthUrl;

class OAuthController extends Controller
{
    public function getRedirect(string $provider, RedirectOAuthUrl $action): RedirectResponse
    {
        return redirect()->to($action->handle($provider));
    }

    public function getAuthenticate(string $provider, AuthenticateService $action): RedirectResponse
    {
        $action->handle($provider, request()->input('code'));
        return redirect()->to('/profile');
    }
}
