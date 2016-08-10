<?php

namespace App\Services;

use Illuminate\Http\Request;

interface ServiceInterface
{
    /**
     * @param Request $request
     *
     * @return array
     */
    public static function index(Request $request);
}