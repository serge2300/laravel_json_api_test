<?php

namespace App\Http\Middleware;

use Closure;
use Response;
use Errors;
use Validator;
use Illuminate\Support\Facades\Auth;

class RequestsPreprocessor
{
    /**
     * @var array Validation rules for request fields
     */
    protected $validationRules = [
        'query'    => 'required',
        'user_id'  => 'required|integer|exists:users,id',
        'username' => 'required|string|exists:users',
        'password' => 'required|string',
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $rules
     * @return mixed
     */
    public function handle($request, Closure $next, $rules = null)
    {
        $rules = preg_split('/\|/', $rules);
        // Get validation rules for a request
        foreach ($this->validationRules as $key => $rule) {
            if (!in_array($key, $rules)) {
                unset($this->validationRules[$key]);
            }
        }
        // Validate request params
        $validator = Validator::make($request->json()->all(), $this->validationRules);
        if ($validator->fails()) {
            foreach ($this->validationRules as $key => $rule) {
                Errors::setMessage($key, $validator->errors()->get($key));
            }
            return Response::json(Errors::get());
        }

        return $next($request);
    }
}
