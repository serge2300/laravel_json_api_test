<?php

namespace App\Services\Friend;

use App\Services\ServiceInterface;
use Illuminate\Http\Request;

class OutboxService implements ServiceInterface
{
    /**
     * Show friend requests to user
     *
     * @param Request $request
     *
     * @return array
     */
    public static function index(Request $request)
    {
        return (new \App\Dao\Request())->requestsToUser($request->user()['id']);
    }
}
