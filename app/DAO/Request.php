<?php

namespace App\Dao;

use App\Request as FriendRequestModel;
use Errors;

class Request
{
    /**
     * @var string
     */
    protected $error = 'REQUEST_NOT_FOUND';

    /**
     * Find a friend request. Return an error if not found
     *
     * @param $from_user_id
     * @param $to_user_id
     *
     * @return mixed
     */
    public function findRequest($from_user_id, $to_user_id)
    {
        return FriendRequestModel::where([
            'from_user_id' => $from_user_id,
            'to_user_id'   => $to_user_id,
        ])->firstOrFail();
    }

    /**
     * Get friend requests from user
     *
     * @param $from_user_id
     *
     * @return array
     */
    public function requestsFromUser($from_user_id)
    {
        try {
            return ['users' => FriendRequestModel::where('from_user_id', $from_user_id)->first()->requestsFromUser];
        } catch (\Exception $e) {
            return Errors::get($this->error);
        }
    }

    /**
     * Get friend requests to user
     *
     * @param $to_user_id
     *
     * @return array
     */
    public function requestsToUser($to_user_id)
    {
        try {
            return ['users' => FriendRequestModel::where('from_user_id', $to_user_id)->first()->requestsToUser];
        } catch (\Exception $e) {
            return Errors::get($this->error);
        }
    }
}