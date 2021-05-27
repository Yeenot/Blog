<?php
namespace App\Services\Users;

use App\Models\User;

class GetUser
{
    public function execute($id)
    {
        return User::with('profile')->find($id);
    }
}