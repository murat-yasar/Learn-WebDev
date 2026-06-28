<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
use App\Models\User;

class PostController extends Controller
{
    // Display all posts
    public function index(Request $request)
    {
        // [Code.1]
        // $posts = DB::table('posts')->get();
        // return view('posts', compact('posts'));

        // [Code.2]
        // $posts = Post::all();
        // return view('posts', compact('posts'));

        // [Code.3]
        // $user = User::find(1);
        // $profile = $user->profile;
        // return $profile;

        // [Code.4]
        // $user = User::with('profile')->find(1);
        // return $user->profile;

        // [Code.5]
        // $user = User::with('posts')->find(1);
        // foreach($user->posts as $post)
        // {
        //     $post->title;
        // }

        // [Code.6]
        $user = User::find(1);
        $post = new Post();
        $post->title = $request->title;
        $post->body = $request->body;
        $user->posts()->save($post);
    }



    // Display a specific post
    public function show($id)
    {
        // $post = DB::table('posts')->where('id', $id)->first();
        $post = Post::find($id);

        return $post;
    }



    // Create a post request to insert a new query
    public function store(Request $request)
    {
        // DB::table('posts')->insert([
        //     'title' => $request->title,
        //     'body' => $request->body,
        // ]);
        $post = new Post();
        $post->title = $request->title;
        $post->body = $request->body;
        $post->save();

        // Display all posts
        // $posts = DB::table('posts')->get();
        // return $posts;
        return redirect('posts');
    }



    // Display create page
    public function create()
    {
        return view('create');
    }



    // Edit Post
    public function edit($id)
    {
        // $post = DB::table('posts')->where('id', $id)->first();
        $post = Post::find($id);

        return view('edit', compact('post'));
    }



    // Update post
    public function update($id, Request $request)
    {
        // DB::table('posts')->where('id', $id)->update([
        //     'title' => $request->title,
        //     'body' => $request->body,
        // ]);
        $post = Post::find($id);
        $post->title = $request->title;
        $post->body = $request->body;
        $post->save();

        return "The post $id is updated!";
    }

    public function delete($id)
    {
        // DB::table('posts')->where('id', $id)->delete();
        $post = Post::find($id)->delete();

        return "The post is deleted!";
    }
}
