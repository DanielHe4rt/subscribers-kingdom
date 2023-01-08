<?php

namespace Kingdom\Landing\Presentation\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class LandingController extends Controller
{
    public function viewLanding(): View
    {
        return view('landing::landing');
    }
}
