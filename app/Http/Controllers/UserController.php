<?php

namespace App\Http\Controllers;

use App\DTO\UserDTO;
use \Exception;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Cache;

class UserController extends BaseController
{

    public function checkOldPassword(Request $request){
        try{
            // dd(User::query()->where('id', $request->input('user_id')) ===
            // Hash::make($request->input('oldPassword')));
            return([
                'data' => User::query()->where('id', $request->input('user_id')) ===
                Hash::make($request->input('oldPassword')),
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

    public function checkUser(Request $request){
        if ($request->user('sanctum')) {
            return([
                'data' =>'auth',
                'message'=>'authenticated',
                'status' => 200,
            ]);
        } else {
            return([
                'data' =>'unauth',
                'message'=>'unauthenticated',
                'status' => 400,
            ]);
        }
    }
    /**
     * Will get a user given a email
     * @params string $email
     */
    public function getUser($id){
        try{
            return([
                'data' => User::find($id),
                'message'=> 'success',
                'status' => 200,
            ]);
        }catch(Exception $e){
            return([
                'data'=>'',
                'message'=>'Could not find your user',
                'status'=>'400',
            ]);
        }
    }

    public function login(Request $request){
        try{
            $user = new User();
            $user->email = $request->input('email');
            $user->password = Hash::make($request->input('password'));

            assert($user->email != null, 'Please enter a valid email');
            assert($user->password != null, 'Please enter a valid password');

            //get user from entered email
            $user = $this->getUserByEmail($user->email);
            if(!$user->email){
                return ([
                    'data' => '',
                    'message' => 'Invalid credentials',
                    'status' => 400,
                ]);
            }

            //Get friends list and store in user
            $user->friend_list = User::find(explode(",", $user->friend_list));

            // validate user password
            if(strcmp($user->password, $user->email)){
                // ====================== USER DTO ATTEMPT ================
                // session(['session_chatter' => Hash::make(env('JWT_SECRET'))]);
                // $result = UserDTO::fromModel($user)->serialize();
                // // $result =    UserDTO::fromModel($user)->serialize();
                // dd($result);

                // $user->remember_token = Session::get('session_chatter');
                // Cache::put('user_session', $user->remember_token);
                $user_sender_messages = DB::table('message_table')->where('user_sender_id', $user->message_id)->get();
                $user_reciever_messages = DB::table('message_table')->where('user_reciever_id', $user->message_id)->get();
                $user->messages = array_merge($user_sender_messages->toArray(), $user_reciever_messages->toArray());
                Auth::login($user);

                return([
                    'data'=> $user,
                    'message'=>'Login successful',
                    'status'=>200,
                ]);
            }
            //if password incorrect
            return([
                'data'=>'',
                'message'=>'Invalid credentials',
                'status'=>400
            ]);
        }catch(Exception $e){
            // something else failed
            return([
                'data'=>'',
                'message'=>'Login Failed',
                'status'=> 400,
            ]);
        }
    }

    /**
     * Creates a new user
     *
     *
     */
    public function registerUser(Request $request){
        //get user from request and set in database
        try{
            $user = new User();
            /**
             * Create UserDTO to set request inputs
             */

            $user->user_name = $request->input('user_name');
            $user->first_name = $request->input('firstname');
            $user->sur_name = $request->input('surname');
            $user->email = $request->input('email');
            $user->phonenumber = $request->input('phone_number');
            $user->password = Hash::make($request->input('password'));
            $user->post_id = 1; //auto aupdate
            $user->message_id = 1;
            $user->email_verified_at = null;
            $user->remember_token = Hash::make($user->password);
            $user->friend_list = "";
            $user->status = 2;
            $user->created_at = Carbon::now();
            $user->updated_at = Carbon::now();

            assert($user->email != null, 'Please enter a valid email');
            assert($user->password != null, 'Please enter a valid password');

            session(['session_chatter' => Hash::make(env('JWT_SECRET'))]);

            $user->remember_token = Session::get('session_chatter');

            // saves user to table
            $user->save();
            // Log user in
            Auth::login($user);
            // get newly created user id
            $user_id = $this->getUserByEmail($user->email);
            $user->user_id = $user_id->id;
            //  return user_id and token
            return([
                'data'=>[
                    'user' => $user,
                ],
                'message'=>'Registration Successfull ',
                'status'=>200,
            ]);
        }catch(Exception $e){
            return([
                'error'=>$e->getMessage(),
                'message'=>'Something went wrong when creating your account',
                'status'=>500
            ]);
        }
    }

    // public function autoLogin(Request $request){
    //     $token = $request->input('remember_token');
    //     $stored_token = Cache::get('user_session');

    //     if($token === $stored_token){

    //         // Auth::login();

    //         return([
    //             'data'=>true,
    //             'message' => 'Successfull',
    //             'status'=> 200,
    //         ]);
    //     }
    //     return([
    //         'data'=>false,
    //         'message' => 'Unsuccessfull',
    //         'status'=> 200,
    //     ]);
    // }

    public function getUserByEmail(string $email){
        return User::where('email', $email)->get()->first();
    }

    /**
     * Deletes a user given a user_id
     *
     */

    public function deleteUser($user_id){

    }

    /**
     * Will edit a user when given data
     *
     */
    public function editUser(Request $request){

    }


}
