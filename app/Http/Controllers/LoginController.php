<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use Response;
use Errors;

class LoginController extends Controller
{
    /**
     * User authentication
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        // Check if a user is authenticated
        if (!Auth::check()) {
            // Attempt to authenticate a user
            if (Auth::attempt([
                'username' => $request->json('username'),
                'password' => $request->json('password')
            ], true)) {
                // Return response with user token
                return Response::json(['token' => Auth::user()->getRememberToken()]);
            }
        } else {
            return Response::json(Errors::get('ALREADY_LOGGED_IN'));
        }
    }
}
