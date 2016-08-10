<?php

namespace App\Services\Friend;

use App\Services\ServiceInterface;
use Illuminate\Http\Request;
use App\Friend;

class AllService implements ServiceInterface
{
    /**
     * Show all friends
     *
     * @param Request $request
     *
     * @return array
     */
    public static function index(Request $request)
    {
        return ['users' => Friend::where('user_id', $request->user()['id'])->first()->friends];
    }
}
