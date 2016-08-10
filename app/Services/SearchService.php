<?php

namespace App\Services;

use Illuminate\Http\Request;

class SearchService implements ServiceInterface
{
    /**
     * Search users
     *
     * @param Request $request
     *
     * @return array
     */
    public static function index(Request $request)
    {
        return ['users' => (new \App\Dao\User())->getByQuery($request->json('query'))];
    }
}
