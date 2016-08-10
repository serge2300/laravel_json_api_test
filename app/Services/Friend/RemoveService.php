<?php

namespace App\Services\Friend;

use App\Services\ServiceInterface;
use Illuminate\Http\Request;
use Errors;

class RemoveService implements ServiceInterface
{
    /**
     * Remove a friend
     *
     * @param Request $request
     *
     * @return array
     */
    public static function index(Request $request)
    {
        // Find a friend. Return an error if not found
        try {
            $friend = (new \App\Dao\Friend())->findFriend($request->user()['id'], $request->json('user_id'));
        } catch (\Exception $e) {
            return Errors::get('FRIEND_NOT_FOUND');
        }

        $friend->delete();

        return null;
    }
}
