<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use Response;

class ProfileController extends Controller
{
    /**
     * @var array Validation rules for request fields
     */
    protected $validationRules = [
        'user_id' => 'required|integer|exists:users,id',
    ];

    /**
     * User profile
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

        $user = User::find($request->json('user_id'));

        return Response::json($user);
    }
}
