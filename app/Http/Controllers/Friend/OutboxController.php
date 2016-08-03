<?php

namespace App\Http\Controllers\Friend;

use App\Http\Controllers\FriendController;
use App\Request as FriendRequest;
use Response;

class OutboxController extends FriendController
{
    /**
     * Show friend requests to user
     *
     * @return Response
     */
    public function index()
    {
        return Response::json([
            'users' => FriendRequest::where('from_user_id', $this->user->id)->first()->requestsToUser
        ]);
    }
}
