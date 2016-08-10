<?php

namespace App\Services\Friend;

use App\Services\ServiceInterface;
use Illuminate\Http\Request;
use Errors;

class DeclineService implements ServiceInterface
{
    /**
     * Decline friend request
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

        $friendRequest->delete();

        return null;
    }
}
