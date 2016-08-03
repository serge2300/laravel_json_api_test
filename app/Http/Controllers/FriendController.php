<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use App\Friend;
use App\Request as FriendRequest;
use Auth;
use DB;
use Response;
use Errors;

class FriendController extends Controller
{
    /**
     * @var User
     */
    protected $user;

    /**
     * @var array Validation rules for request fields
     */
    protected $validationRules = [
        'user_id' => 'required|integer|exists:users,id',
    ];

    /**
     * FriendController constructor.
     */
    public function __construct()
    {
        $this->user = Auth::user();
    }

    /**
     * Show all friends
     *
     * @return Response
     */
    public function all()
    {
        return Response::json([
            'users' => Friend::where('user_id', $this->user->id)->first()->friends
        ]);
    }

    /**
     * Accept friend request
     *
     * @param Request $request
     *
     * @return Response
     */
    public function accept(Request $request)
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

    /**
     * Decline friend request
     *
     * @param Request $request
     *
     * @return Response
     */
    public function decline(Request $request)
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

        $friendRequest->delete();

        return Response::make(null);
    }

    /**
     * Show friend requests from user
     *
     * @return Response
     */
    public function inbox()
    {
        return Response::json([
            'users' => FriendRequest::where('from_user_id', $this->user->id)->first()->requestsFromUser
        ]);
    }

    /**
     * Show friend requests to user
     *
     * @return Response
     */
    public function outbox()
    {
        return Response::json([
            'users' => FriendRequest::where('from_user_id', $this->user->id)->first()->requestsToUser
        ]);
    }

    /**
     * Make a friend request
     *
     * @param Request $request
     *
     * @return Response
     */
    public function add(Request $request)
    {
        // Validate fields
        if (($validation = $this->validateFields($request)) !== true) {
            return $validation;
        }

        // Find existing friend request or create a new one
        FriendRequest::firstOrCreate([
            'from_user_id' => $this->user->id,
            'to_user_id'   => $request->json('user_id'),
        ]);

        return Response::make(null);
    }

    /**
     * Remove a friend
     *
     * @param Request $request
     *
     * @return Response
     */
    public function remove(Request $request)
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
