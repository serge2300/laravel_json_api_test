<?php

namespace App\Services\Friend;

use App\Services\ServiceInterface;
use Illuminate\Http\Request;
use App\Request as FriendRequest;

class AddService implements ServiceInterface
{
    /**
     * Make a friend request
     *
     * @param Request $request
     *
     * @return array
     */
    public static function index(Request $request)
    {
        // Find existing friend request or create a new one
        FriendRequest::firstOrCreate([
            'from_user_id' => $request->user()['id'],
            'to_user_id'   => $request->json('user_id'),
        ]);

        return null;
    }
}
