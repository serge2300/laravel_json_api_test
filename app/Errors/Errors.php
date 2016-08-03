<?php

namespace App\Errors;

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
        'The username field is required.'   => 'USERNAME_REQUIRED',
        'The password field is required.'   => 'PASSWORD_REQUIRED',
        'The user id field is required.'    => 'USER_ID_REQUIRED',
        'The query field is required.'      => 'QUERY_REQUIRED',
        'The username must be a string.'    => 'BAD_USERNAME',
        'The selected username is invalid.' => 'BAD_USERNAME',
        'The password must be a string.'    => 'BAD_PASSWORD',
        'The user id must be an integer.'   => 'BAD_USER_ID',
        'The selected user id is invalid.'  => 'BAD_USER_ID',
    ];

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
     * Set messages for validation errors
     *
     * @param MessageBag $messages
     *
     * @return $this
     */
    public function validation(MessageBag $messages)
    {
        foreach ($messages->all() as $message) {
            if ($this->validationErrors[$message]) {
                $this->messages[] = $this->validationErrors[$message];
            }
        }

        return $this;
    }

    /**
     * Get formatted error response
     *
     * @param array $messages Set error messages
     *
     * @return array
     */
    public function get(array $messages = [])
    {
        $this->messages += $messages;

        return ['err' => $this->getMessages()];
    }
}
