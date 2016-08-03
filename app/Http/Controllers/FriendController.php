<?php

namespace App\Http\Controllers;

use App\User;
use Auth;

class FriendController extends Controller
{
    /**
     * @var User
     */
    protected $user;

    /**
     * @var array Validation rules for request fields
     */
    protected $validationRules = [
        'user_id' => 'required|integer|exists:users,id',
    ];

    /**
     * FriendController constructor.
     */
    public function __construct()
    {
        $this->user = Auth::user();
    }
}
