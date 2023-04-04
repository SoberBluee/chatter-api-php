<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ResetPasswordEmail;
use Illuminate\Support\Facades\Mail;
use App\Http\Services\EmailService;
use App\Models\PasswordReset;
use Carbon\Carbon;

class EmailController extends Controller
{

    public function __construct(private EmailService $emailService)
    {
    }

    public function emailChangePassword(Request $request){
        $passwordReset = new PasswordReset();
        $email = $request->input('email');
        $token = $this->emailService->generatePasswordResetToken($email);

        $passwordReset->email = $email;
        $passwordReset->token = $token;
        $passwordReset->created_at = Carbon::now();
        $passwordReset->save();

        Mail::to($email)
            ->cc("someone@mail.com")
            ->bcc("someoneelse@mail.com")
            ->queue(new ResetPasswordEmail($token, $email));

        return([
            'data' => '',
            'message' => 'Password reset email sent successfully. Please check your inbox',
            'status' => 200,
        ]);
    }

    public function confirmChangePassword(Request $request){
        $email = $request->input('email');
        $token = $request->input('token');



    }
}
