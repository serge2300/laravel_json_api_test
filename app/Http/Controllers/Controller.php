<?php

namespace App\Http\Controllers;

use App\Http\Requests\Request;
use Validator;
use Response;
use Errors;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;

class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;

    /**
     * @var array Validation rules for request fields
     */
    protected $validationRules = [];

    /**
     * @return array Validation rules
     */
    protected function getValidationRules()
    {
        return $this->validationRules;
    }

    /**
     * Validate fields
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return mixed JSON Response with error on fail or true on success
     */
    protected function validateFields(\Illuminate\Http\Request $request)
    {
        $validator = Validator::make($request->json()->all(), $this->getValidationRules());
        if ($validator->fails()) {
            return Response::json(Errors::validation($validator->errors())->get());
        } else {
            return true;
        }
    }
}
