<?php

namespace Kingdom\Subscriber\Presentation\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Kingdom\Phone\Application\SendPhoneVerification;
use Kingdom\Phone\Application\VerifyPhoneNumber;
use Kingdom\Subscriber\Domain\Actions\GetAllSubscribersAction;

class SubscribersController extends Controller
{
    public function getSubscribers(GetAllSubscribersAction $action): JsonResponse
    {
        return response()->json($action->handle());
    }

    public function postPhoneVerification(Request $request, SendPhoneVerification $verifyPhoneNumber)
    {
        $verifyPhoneNumber->sendMessage(
            auth()->id(),
            $request->input('phone_number')
        );

        return redirect()->route('profile')->with('alert.success', 'Foi enviado para seu zap um código foda');
    }

    public function postVerifyPhone(Request $request, VerifyPhoneNumber $verification): RedirectResponse
    {
        $verification->fromCode($request->input('code'));

        return redirect()->route('profile')->with('alert.success', 'Seu número foi verificado!');
    }
}
