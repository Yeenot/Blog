<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\Users\UserLoginRequest;
use App\Http\Requests\Users\UserStoreRequest;
use App\Services\Users\CreateUser;
use App\Services\Users\LoginUser;
use App\Services\Users\LogoutUser;

class AuthenticationController extends Controller
{
    public function login(UserLoginRequest $request, LoginUser $loginUser)
    {
        $status = $loginUser->execute($request->validated());
        if ($status === User::LOGIN_BAD_CREDENTIALS)
            return redirect()->back()->with(['message' => 'Invalid credentials']);
        return redirect()->route('home');
    }

    public function register(UserStoreRequest $request, CreateUser $createUser)
    {
        $createUser->execute($request->validated());
        return redirect()->back()->with('message', 'You have successfully registered.');
    }

    public function logout(LogoutUser $logoutUser)
    {
        $logoutUser->execute();
        return redirect()->route('login');
    }
}
