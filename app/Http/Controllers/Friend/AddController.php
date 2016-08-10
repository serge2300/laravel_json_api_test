<?php

namespace App\Http\Controllers\Friend;

use App\Http\Controllers\FriendController;
use Illuminate\Http\Request;
use App\Request as FriendRequest;
use Response;

class AddController extends FriendController
{
    /**
     * Make a friend request
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        // Find existing friend request or create a new one
        FriendRequest::firstOrCreate([
            'from_user_id' => $this->user->id,
            'to_user_id'   => $request->json('user_id'),
        ]);

        return Response::make(null);
    }
}
