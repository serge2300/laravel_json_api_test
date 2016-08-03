<?php

namespace App\Http\Controllers\Friend;

use App\Http\Controllers\FriendController;
use Illuminate\Http\Request;
use App\Friend;
use App\Request as FriendRequest;
use Response;
use Errors;
use DB;

class AcceptController extends FriendController
{
    /**
     * Accept friend request
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
            $friendRequest = FriendRequest::where([
                'from_user_id' => $request->json('user_id'),
                'to_user_id'   => $this->user->id,
            ])->firstOrFail();
        } catch (\Exception $e) {
            return Response::json(Errors::get(['REQUEST_NOT_FOUND']));
        }

        // Perform a transaction: add a new friend and delete a friend request
        DB::transaction(function () use ($request, $friendRequest) {
            Friend::firstOrCreate([
                'user_id'   => $this->user->id,
                'friend_id' => $request->json('user_id'),
            ]);
            $friendRequest->delete();
        });

        return Response::make(null);
    }
}