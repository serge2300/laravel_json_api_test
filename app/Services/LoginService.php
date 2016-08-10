<?php

namespace App\Services;

use Illuminate\Http\Request;
use Auth;
use Errors;

class LoginService implements ServiceInterface
{
    /**
     * User authentication
     *
     * @param Request $request
     *
     * @return array
     */
    public static function index(Request $request)
    {
        // Check if a user is authenticated
        if (!Auth::check()) {
            // Attempt to authenticate a user
            if (Auth::attempt([
                'username' => $request->json('username'),
                'password' => $request->json('password')
            ], true)) {
                // Return user token
                return ['token' => Auth::user()->getRememberToken()];
            }
        } else {
            return Errors::get('ALREADY_LOGGED_IN');
        }
    }
}
