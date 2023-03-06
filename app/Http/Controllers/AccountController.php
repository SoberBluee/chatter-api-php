<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use \Exception;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

use function PHPSTORM_META\map;

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
                'data' => '',
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

    public function updateAccountDetails(Request $request){

    }
}
