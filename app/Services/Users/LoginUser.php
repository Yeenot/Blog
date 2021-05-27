<?php
namespace App\Services\Users;

use App\Models\User;

class LoginUser
{
    public function execute(array $data)
    {
        $user = User::where('email', $data['email']);

        if (!isset($user))
            return User::LOGIN_BAD_CREDENTIALS;

        // Attempt
        if (!auth('web')->attempt($data))
            return User::LOGIN_BAD_CREDENTIALS;
            
        // Success
        return User::LOGIN_SUCCESS;
    }
}