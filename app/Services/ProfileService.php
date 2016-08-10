<?php

namespace App\Services;

use Illuminate\Http\Request;

class ProfileService implements ServiceInterface
{
    /**
     * User profile
     *
     * @param Request $request
     *
     * @return \App\User|null
     */
    public static function index(Request $request)
    {
        return (new \App\Dao\User())->getById($request->json('user_id'));
    }
}
