<?php

namespace App\Helpers;

use Route;

class Routing
{
    /**
     * Add a new route
     *
     * @param string $method
     * @param string $route
     * @param array  $rules  Params to be validated
     *
     * @return mixed
     */
    public function add($method = 'get', $route = '/', array $rules = [])
    {
        return call_user_func_array(['Route', $method], ["/$route", [
            'middleware' => 'request:' . join('|', $rules),
            'uses' => ucfirst($route).'Controller@index',
        ]]);
    }
}
