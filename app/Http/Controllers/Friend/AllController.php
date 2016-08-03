<?php

namespace App\Http\Controllers\Friend;

use App\Http\Controllers\FriendController;
use App\Friend;
use Response;

class AllController extends FriendController
{
    /**
     * Show all friends
     *
     * @return Response
     */
    public function index()
    {
        return Response::json([
            'users' => Friend::where('user_id', $this->user->id)->first()->friends
        ]);
    }
}
