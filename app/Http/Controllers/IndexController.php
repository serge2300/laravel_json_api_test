<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Response;

class IndexController extends Controller
{
    /**
     * Handle a request
     *
     * @return Response
     */
    public function handle(Request $request)
    {
        $path = null;
        $segments = $request->segments();
        // Get a path to a service
        switch (count($segments)) {
            case 2:
                $path = ucfirst($segments[1]);
                break;
            case 3:
                $path = ucfirst($segments[1]) . '\\' . ucfirst($segments[2]);
                break;
        }

        $response = call_user_func_array(['\\App\\Services\\' . $path . 'Service', 'index'], [$request]);

        return Response::json($response);
    }
}
