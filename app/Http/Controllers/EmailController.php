<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ResetPasswordEmail;
use Illuminate\Support\Facades\Mail;
use App\Http\Services\EmailService;

class EmailController extends Controller
{

    public function __construct(private EmailService $emailService)
    {
    }

    public function emailChangePassword(Request $request){
        $email = $request->input('email');

        $token = $this->emailService->generatePasswordResetToken($email);

        Mail::to($email)->cc("someone@mail.com")->bcc("someoneelse@mail.com")->queue(new ResetPasswordEmail($token));

        return([
            'data' => '',
            'message' => 'Password reset email sent successfully. Please check your inbox',
            'status' => 200,
        ]);
    }

    public function confirmChangePassword(string $resetToken){

    }
}
