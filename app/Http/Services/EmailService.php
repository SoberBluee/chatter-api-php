<?php

namespace App\Http\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\PasswordReset;

class EmailService
{
    /**
     * Will generate a reset password token with the users email address and the date
     * is was created.
     */
    public function generatePasswordResetToken(string $email){
        $result = PasswordReset::where('email', $email);

        $token = sha1(time());
    }

    public function checkPasswordResetToken(string $resetToken){

    }
}
