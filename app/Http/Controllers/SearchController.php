<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;

class SearchController extends Controller
{
    /**
     * Search users
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        return Response::json(
            ['users' => (new \App\Dao\User())->getByQuery($request->json('query'))]
        );
    }
}
