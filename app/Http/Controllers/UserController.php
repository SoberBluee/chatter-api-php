<?php

namespace App\Http\Controllers;

use \Exception;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller as BaseController;

class UserController extends BaseController
{

    public function checkUser(Request $request)
    {
        if ($request->user('sanctum')) {
            return ([
                'data' => 'auth',
                'message' => 'authenticated',
                'status' => 200,
            ]);
        } else {
            return ([
                'data' => 'unauth',
                'message' => 'unauthenticated',
                'status' => 400,
            ]);
        }
    }

    public function logoutFunc(Request $reuqest)
    {
        Auth::logout();
        $user = $reuqest->user;
        dd($user);
    }

    /**
     * Will get a user given a email
     * @params string $email
     */
    public function getUser($id)
    {
        try {
            return ([
                'data' => User::find($id),
                'message' => 'success',
                'status' => 200,
            ]);
        } catch (Exception $e) {
            return ([
                'data' => '',
                'message' => 'Could not find your user',
                'status' => '400',
            ]);
        }
    }

    public function login(Request $request)
    {
        try {
            $user = new User();
            $user->email = $request->input('email');
            $user->password = $request->input('password');
            //get user from entered email
            $fetched_user = $this->getUserByEmail($user->email);

            // validate user exitst
            if (!Hash::check($user->password, $fetched_user->password)) {
                return ([
                    'data' => '',
                    'message' => 'Invalid credentials',
                    'status' => 400,
                ]);
            }
            $user = $fetched_user;

            //Get friends list and store in user
            try {
                $user->friend_list = $this->getUserFriends($fetched_user->friend_list);
                //=================== UserDTO attempt ================
                // session(['session_chatter' => Hash::make(env('JWT_SECRET'))]); //trying set jwt session token
                // $result = UserDTO::fromModel($user)->serialize(); //
                // $user->remember_token = Session::get('session_chatter'); // set the user token
                // Cache::put('user_session', $user->remember_token); // cache user session token in laravel cache
                //=================== UserDTO attempt ================

                Auth::login($user);
                return ([
                    'data' => $user,
                    'message' => 'Login successful',
                    'status' => 200,
                ]);
            } catch (Exception $e) {
                // dd($e);
                return ([
                    'data' => '',
                    'message' => 'Something went wrong setting up your account',
                    'status' => 400
                ]);
            }
            //if password incorrect
            return ([
                'data' => '',
                'message' => 'Invalid credentials',
                'status' => 400
            ]);
        } catch (Exception $e) {
            // something else failed
            return ([
                'data' => '',
                'message' => 'Login Failed',
                'status' => 400,
            ]);
        }
    }

    /**
     * Creates a new user
     *
     *
     */
    public function registerUser(Request $request)
    {
        //get user from request and set in database
        try {
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
            $user->email_verified_at = null;
            $user->remember_token = Hash::make($user->password);
            $user->friend_list = "";
            $user->status = 2;
            $user->created_at = Carbon::now();
            $user->updated_at = Carbon::now();

            // saves user to table
            $user->save();
            // Log user in
            Auth::login($user);
            // get newly created user id
            $user_id = $this->getUserByEmail($user->email);
            $user->user_id = $user_id->id;
            //  return user_id and token
            return ([
                'data' => [
                    'user' => $user,
                ],
                'message' => 'Registration Successfull ',
                'status' => 200,
            ]);
        } catch (Exception $e) {
            return ([
                'error' => $e->getMessage(),
                'message' => 'Something went wrong when creating your account',
                'status' => 500
            ]);
        }
    }

    public function getUserByEmail(string $email)
    {
        return User::where('email', $email)->get()->first();
    }

    public function getUserFriends($friend_list)
    {
        return User::find(explode(",", $friend_list));
    }

    /**
     * Deletes a user given a user_id
     *
     */

    public function deleteUser($user_id)
    {
    }

    /**
     * Will edit a user when given data
     *
     */
    public function editUser(Request $request)
    {
    }
}
