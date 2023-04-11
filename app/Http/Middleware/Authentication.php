<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Validation\UnauthorizedException;

class Authentication
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        $token = $request->header('api-token');
        $user = User::where('api_token', $token)->first();

        //Check if that token exists
        if ($user === null) return $next([
            'data' => '',
            'message' => 'Unauthorized',
            'status' => '405'
        ]);
        //Check if token has expired

        if ($user->api_token_expiry <= Carbon::now()) {
            $user->api_token = null;
            $user->api_token_expiry = null;
            $user->save();
            return $next([
                'data' => '',
                'message' => 'Your token has expiried. Please login again',
                'status' => 405,
            ]);
        }

        if ($user !== null) {
            return $next($request);
        }
    }
}
