<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;

class ProfileController extends Controller
{
    /**
     * User profile
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $user = (new \App\Dao\User())->getById($request->json('user_id'));

        return Response::json($user);
    }
}
