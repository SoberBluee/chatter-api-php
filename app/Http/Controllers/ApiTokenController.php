<?php

namespace App\Http\Controllers;

use \Exception;
use App\Models\User;
use Illuminate\Http\Request;
use \Illuminate\Support\Carbon;

class ApiTokenController extends Controller
{

    /**
     * Update the authenticated user's API token.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function update(Request $request)
    {
        $token = Str::random(60);

        $request->user()->forceFill([
            'api_token' => hash('sha256', $token),
        ])->save();

        return ['token' => $token];
    }
}
