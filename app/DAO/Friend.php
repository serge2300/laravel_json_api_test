<?php

namespace App\Dao;

use Illuminate\Http\Request;
use App\Friend as FriendModel;

class Friend
{
    /**
     * Find a friend. Return an error if not found
     *
     * @param $user_id
     * @param $friend_id
     *
     * @return mixed
     */
    public function findFriend($user_id, $friend_id)
    {
        return FriendModel::where([
            'user_id'   => $user_id,
            'friend_id' => $friend_id,
        ])->firstOrFail();
    }
}