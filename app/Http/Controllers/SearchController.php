<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use Response;

class SearchController extends Controller
{
    /**
     * @var array Validation rules for request fields
     */
    protected $validationRules = [
        'query' => 'required',
    ];

    /**
     * Search users
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        // Validate fields
        if (($validation = $this->validateFields($request)) !== true) {
            return $validation;
        }

        $query = $request->json('query');
        $users = User::where('name', 'like', '%' . $query . '%')
            ->orWhere('surname', 'like', '%' . $query . '%')
            ->orWhere('username', 'like', '%' . $query . '%')
            ->get();

        return Response::json(['users' => $users]);
    }
}
