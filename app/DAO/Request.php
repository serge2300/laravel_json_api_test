<?php

namespace App\Dao;

use Illuminate\Http\Request as HttpRequest;
use App\Request as FriendRequestModel;
use Response;
use Errors;

class Request
{
    /**
     * Find a friend request. Return an error if not found
     *
     * @param $from_user_id
     * @param $to_user_id
     *
     * @return mixed
     */
    public function findRequest($from_user_id, $to_user_id)
    {
        return FriendRequestModel::where([
            'from_user_id' => $from_user_id,
            'to_user_id'   => $to_user_id,
        ])->firstOrFail();
    }
}