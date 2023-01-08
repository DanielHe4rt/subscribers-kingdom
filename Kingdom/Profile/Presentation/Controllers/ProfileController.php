<?php

namespace Kingdom\Profile\Presentation\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Kingdom\Subscriber\Infrastructure\Models\Subscriber;

class ProfileController extends Controller
{
    public function getProfile(): View
    {
        /** @var Subscriber $subscriber */
        $subscriber = auth()->user();
        return view('profile::main', [
            'user' => $subscriber
        ]);
    }
}
