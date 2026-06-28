<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function getUsers()
    {
        $users = DB::table('users')
                                    // ->where('email', '')
                                    ->get();
        return view('users', compact('users'));
    }
}
