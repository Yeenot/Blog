<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Users\GetUser;

class ProfileController extends Controller
{
    public function index(GetUser $getUser, $id)
    {
        $user = $getUser->execute($id);
        return view('profile', compact('user'));
    }
}
