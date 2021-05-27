<?php
namespace App\Services\Users;

use App\Models\User;

class CreateUser
{
    public function execute($data)
    {
        $data['password'] = bcrypt($data['password']);
        return User::create($data);
    }
}