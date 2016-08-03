<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'created_at', 'updated_at', 'pivot',
    ];

    /**
     * Get the user's registration date in d/m/Y format
     *
     * @param  string $value
     * @return string
     */
    public function getRegisteredAttribute($value)
    {
        return date('d/m/Y', strtotime($value));
    }
}
