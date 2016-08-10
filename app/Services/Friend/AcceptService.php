<?php

namespace App\Services\Friend;

use App\Services\ServiceInterface;
use Illuminate\Http\Request;
use App\Friend;
use Errors;
use DB;

class AcceptService implements ServiceInterface
{
    /**
     * Accept friend request
     *
     * @param Request $request
     *
     * @return array
     */
    public static function index(Request $request)
    {
        // Find a friend request. Return an error if not found
        try {
            $friendRequest = (new \App\Dao\Request())->findRequest($request->json('user_id'), $request->user()['id']);
        } catch (\Exception $e) {
            return Errors::get('REQUEST_NOT_FOUND');
        }

        // Perform a transaction: add a new friend and delete a friend request
        DB::transaction(function () use ($request, $friendRequest) {
            Friend::firstOrCreate([
                'user_id'   => $request->user()['id'],
                'friend_id' => $request->json('user_id'),
            ]);
            $friendRequest->delete();
        });

        return null;
    }
}
