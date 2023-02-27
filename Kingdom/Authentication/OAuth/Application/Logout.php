<?php

namespace Kingdom\Authentication\OAuth\Application;

use Illuminate\Support\Facades\Auth;

class Logout
{
    public function disconnect(): void
    {
        Auth::guard('web')->logout();
    }
}
