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
        $post = DB::table('posts')->where('id', $id)->first();
        return $post;
    }

    public function store(Request $request)
    {
        DB::table('posts')->insert([
            'title' => $request->title,
            'body' => $request->body,
        ]);

        $posts = DB::table('posts')->get();
        return $posts;
    }

    public function create()
    {
        return view('create');
    }
}
