<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function index()
    {
        // Display posts
        $posts = DB::table('posts')->get();
        return view('posts', compact('posts'));
    }

    public function show($id)
    {
        $post = DB::table('posts')->where('id', $id)->get();
        return $post;
    }
}
