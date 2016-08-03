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
        // Validate fields
        if (($validation = $this->validateFields($request)) !== true) {
            return $validation;
        }

        // Find a friend request. Return an error if not found
        try {
            $friend = Friend::where([
                'user_id'   => $this->user->id,
                'friend_id' => $request->json('user_id'),
            ])->firstOrFail();
        } catch (\Exception $e) {
            return Response::json(Errors::get(['FRIEND_NOT_FOUND']));
        }

        $friend->delete();

        return Response::make(null);
    }
}
