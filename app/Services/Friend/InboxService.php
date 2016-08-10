<?php

namespace App\Services\Friend;

use App\Services\ServiceInterface;
use Illuminate\Http\Request;

class InboxService implements ServiceInterface
{
    /**
     * Show friend requests from user
     *
     * @param Request $request
     *
     * @return array
     */
    public static function index(Request $request)
    {
        return (new \App\Dao\Request())->requestsFromUser($request->user()['id']);
    }
}
