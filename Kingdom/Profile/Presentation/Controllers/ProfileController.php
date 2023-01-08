<?php

namespace Kingdom\Profile\Presentation\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function getProfile(): JsonResponse
    {
        return response()->json(auth()->user()->toArray());
    }
}
