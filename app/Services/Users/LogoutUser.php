<?php
namespace App\Services\Users;

use App\Models\User;

class LogoutUser
{
    public function execute()
    {
        auth('web')->logout();
    }
}