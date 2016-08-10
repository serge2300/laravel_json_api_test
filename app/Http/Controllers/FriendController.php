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
     * FriendController constructor.
     */
    public function __construct()
    {
        $this->user = Auth::user();
    }
}
