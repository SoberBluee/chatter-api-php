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
     * @params strin $email
     *
     * @returns sha1 string
     */
    public function generatePasswordResetToken(string $email){
        // Check if there is already a password reset email
        $result = PasswordReset::where("email", $email)->get();
        // If an email already exists, throw error
        assert($result !== null, 'You have already generated a password reset token. Please try again in a few minutes');
        // generate new token
        return sha1(time());
    }

    public function checkPasswordResetToken(string $email, string $resetToken){
        $result = PasswordReset::find($email)->where('token',$resetToken);
        dd($result);
    }
}
