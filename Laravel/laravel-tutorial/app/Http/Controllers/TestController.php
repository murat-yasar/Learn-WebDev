<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    public function index()
    {
        // Display posts
        // $posts = DB::table('posts')->where('title', 'title-1')->get();
        // return $posts;

        // Display Test User
        $name = "Murat Yasar";
        $isAdmin = true;
        return view('test', compact('name', 'isAdmin'));
    }
}
