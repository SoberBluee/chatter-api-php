<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Requests\UpdateAccountRequest;
use \Exception;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    public function checkOldPassword(Request $request){
        try{
            // compare old password with that user password
            return([
                'data' => Hash::check($request->input('oldPassword'), User::find($request->input('id'))['password']),
                'message' => 'password checked',
                'status' => 200,
            ]);
        }catch(Exception $e){
            return([
                'data' => 'no data available',
                'message' => 'something went wrong when checking your password',
                'status' => 400,
            ]);
        }
    }

    public function updatePassword(Request $request){
        $newPassword = Hash::make($request->input('password'));
        $id = $request->input('id');

        assert($id !== null, 'No id provided');

        $result = User::where('id', $id)->update(['password' => $newPassword]);

        if($result){
            return([
                'data' => User::find($id),
                'message' => 'Password updated successfully',
                'status' => 200,
            ]);
        }
        return([
            'data' => '',
            'message' => 'Password was not updated',
            'status' => 400,
        ]);
    }

    public function updateEmail(Request $request){
        $userId = $request->input('userId');
        $email = $request->input('email');
        $confirmEmail = $request->input('confirmEmail');

        assert($email === $confirmEmail, 'Please make sure to confirm you email');

        $result = User::where('id', $userId)->update(['email'=> $email]);

        if($result){
            return([
                'data' => User::find($userId),
                'message' => 'Email updates successfully',
                'status' => 200
            ]);
        }
        return([
            'data' => '',
            'message' => 'Email was not updated',
            'status' => 400
        ]);

    }

    public function updateAccountDetails(UpdateAccountRequest $request){
        try{
            $userId = $request->input('userId');
            $user_name = $request->input('user_name');
            $first_name = $request->input('first_name');
            $sur_name = $request->input('sur_name');
            $email = $request->input('email');
            $phonenumber = $request->input('phonenumber');

            assert($userId !== null, 'No user id provided');

            /**
             *
             * Improve to pass in array and loop over details that need
             * to be updated instead of chekcing each one
             *
             */
            if($user_name !== null){
                User::find($userId)->udpate(['user_name' => $user_name]);
            }else if($first_name !== null){
                User::find($userId)->update(['first_name' => $first_name]);
            }else if($sur_name !== null){
                User::find($userId)->update(['sur_name' => $sur_name]);
            }else if($email !== null){
                User::find($userId)->update(['email' => $email]);
            }else if($phonenumber !== null){
                User::find($userId)->update(['phonenumber' => $phonenumber]);
            }

            return([
                'data' => User::find($userId),
                'message' => 'Account details successfully updated',
                'status' => 200,
            ]);

        }catch(Exception $e){
            return([
                'data' => '',
                'message' =>  'Something went wrong trying to update your details',
                'status' => '400',
            ]);
        }
    }
}
