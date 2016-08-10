<?php

namespace App\Helpers;

use Illuminate\Support\MessageBag;

class Errors
{
    /**
     * @var array List of error messages
     */
    private $messages = [];

    /**
     * @var array List of validation errors
     */
    private $validationErrors = [
        'username' => [
            'validation.required' => 'USERNAME_REQUIRED',
            'validation.string'   => 'BAD_USERNAME',
            'validation.exists'   => 'BAD_USERNAME',
        ],
        'password' => [
            'validation.required' => 'PASSWORD_REQUIRED',
            'validation.string'   => 'BAD_PASSWORD',
        ],
        'user_id' => [
            'validation.required' => 'USER_ID_REQUIRED',
            'validation.integer'  => 'BAD_USER_ID',
            'validation.exists'   => 'BAD_USER_ID',
        ],
        'query' => [
            'validation.required' => 'QUERY_REQUIRED',
        ],
    ];

    /**
     * Set error message
     *
     * @param $rule
     * @param $error
     */
    public function setMessage($rule, $error)
    {
        $this->messages[] = $this->validationErrors[$rule][$error[0]];
    }

    /**
     * Set error messages
     *
     * @param array $messages
     */
    public function setMessages(array $messages)
    {
        $this->messages += $messages;
    }

    /**
     * Get error messages
     *
     * @return mixed
     */
    public function getMessages()
    {
        return count($this->messages) > 1 ? $this->messages : $this->messages[0];
    }

    /**
     * Get formatted error response
     *
     * @param string|array $messages Set error messages
     *
     * @return array
     */
    public function get($messages = null)
    {
        if (is_array($messages)) {
            $this->messages = array_merge($this->messages, $messages);
        } elseif (is_string($messages)) {
            $this->messages[] = $messages;
        }

        return ['err' => $this->getMessages()];
    }
}
