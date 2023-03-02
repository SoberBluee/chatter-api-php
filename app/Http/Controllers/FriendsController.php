<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class FriendsController extends Controller
{
    public function getFriends(Request $request){
        try{
            return([
                'data' => User::find($request->input()),
                'message' => 'Retrieved friends successfully',
                'status' => 200
            ]);
        }catch(\Exception $e){
            return([
                'data' => '',
                'message' => 'Invalid request',
                'status' => 400,
            ]);
        }
    }
}
