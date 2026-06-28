<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    // Display all posts
    public function index()
    {
        $posts = DB::table('posts')->get();
        return view('posts', compact('posts'));
    }

    // Display a specific post
    public function show($id)
    {
        $post = DB::table('posts')->where('id', $id)->first();
        return $post;
    }

    // Create a post request to insert a new query
    public function store(Request $request)
    {
        DB::table('posts')->insert([
            'title' => $request->title,
            'body' => $request->body,
        ]);

        $posts = DB::table('posts')->get();
        return $posts;
    }

    // Display create page
    public function create()
    {
        return view('create');
    }

    // Edit Post
    public function edit($id)
    {
        $post = DB::table('posts')->where('id', $id)->first();
        return view('edit', compact('post'));
    }

    // Update post
    public function update($id, Request $request)
    {
        DB::table('posts')->where('id', $id)->update([
            'title' => $request->title,
            'body' => $request->body,
        ]);

        return "The post $id is updated!";
    }
}
