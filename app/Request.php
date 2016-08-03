<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['from_user_id', 'to_user_id'];

    /**
     * Get requests from user
     */
    public function requestsFromUser()
    {
        return $this->belongsToMany('App\User', 'requests', 'from_user_id', 'to_user_id');
    }

    /**
     * Get requests to user
     */
    public function requestsToUser()
    {
        return $this->belongsToMany('App\User', 'requests', 'to_user_id', 'from_user_id');
    }
}
