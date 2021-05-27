<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function __invoke()
    {
        if (auth('web')->check()) {
            return redirect()->route('home');
        }
        return view('login');
    }
}
