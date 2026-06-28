<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Laravel') }}</title>
    </head>
    <body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">
        <h1 class="mb-1 font-medium">POSTS</h1>

        @foreach ( $posts as $post)
            <h2>{{ $post->title }}</h2>
            <p>{{ $post->body }}</p>
            <a href="{{ url('edit_post' . '/' . $post->id) }}">Edit</a>
            <a href="{{ url('delete_post' . '/' . $post->id) }}">Delete</a>
            <hr>
        @endforeach
    </body>
</html>
