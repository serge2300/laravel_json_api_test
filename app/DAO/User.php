<?php

namespace App\Dao;

use Illuminate\Http\Request;
use App\User as UserModel;

class User
{
    /**
     * Get a user by ID
     *
     * @param $id
     *
     * @return \App\User|null
     */
    public function getById($id)
    {
        return UserModel::find($id);
    }

    /**
     * Find users by a query
     *
     * @param $query
     *
     * @return mixed
     */
    public function getByQuery($query)
    {
        return UserModel::where('name', 'like', '%' . $query . '%')
             ->orWhere('surname', 'like', '%' . $query . '%')
             ->orWhere('username', 'like', '%' . $query . '%')
             ->get();
    }
}