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
     * @var array Validation rules for request fields
     */
    protected $validationRules = [
        'username' => 'required|string|exists:users',
        'password' => 'required|string'
    ];

    /**
     * User authentication
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        // Validate fields
        if (($validation = $this->validateFields($request)) !== true) {
            return $validation;
        }

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
            return Response::json(Errors::get(['ALREADY_LOGGED_IN']));
        }
    }
}
