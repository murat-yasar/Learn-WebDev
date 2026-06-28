<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register_form()
    {
        return view('register_form');
    }

    public function login_form()
    {
        return view('login_form');
    }

    public function register(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        return "The new user is registered!";
    }

    public function login(Request $request)
    {
        $credentials = request(['email', 'password']);

        if (Auth::guard('web')->attempt($credentials)){
            return "You are logged in!";
        } else {
            return "You are NOT logged in!";
        }
    }
}
