<?php
namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordResetLinkSent;
use App\Http\Controllers\Controller;

class ForgotPasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('auth.passwords.email');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $response = $this->broker()->sendResetLink(['email' => $request->email]);

        if ($response == Password::RESET_LINK_SENT) {
            event(new PasswordResetLinkSent($request->email));
            return back()->with('status', trans($response));
        }

        return back()->withErrors(['email' => trans($response)]);
    }

    protected function broker()
    {
        return Password::broker();
    }
}
