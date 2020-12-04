<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class MailController extends Controller
{
    public function mailVerificationNotice()
    {
        return view('site.auth.verify');
    }

    public function verifyMail(EmailVerificationRequest $request)
    {
        $request->fulfill();
        return redirect('/');
    }

    public function resendMail(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    }
}
