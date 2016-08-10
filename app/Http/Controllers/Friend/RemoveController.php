<?php

namespace App\Http\Controllers\Friend;

use App\Http\Controllers\FriendController;
use Illuminate\Http\Request;
use App\Friend;
use Response;
use Errors;

class RemoveController extends FriendController
{
    /**
     * Remove a friend
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        // Find a friend. Return an error if not found
        try {
            $friend = (new \App\Dao\Friend())->findFriend($this->user->id, $request->json('user_id'));
        } catch (\Exception $e) {
            return Response::json(Errors::get('FRIEND_NOT_FOUND'));
        }

        $friend->delete();

        return Response::make(null);
    }
}
