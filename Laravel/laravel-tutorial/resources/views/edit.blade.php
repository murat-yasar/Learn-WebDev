<form method="POST" action="{{ url('update_post' . '/' . $post->id) }}">
    @csrf
    <h2>Post: {{ $post->id }}</h2>
    <label for="title">Title</label>
    <input type="text" name="title" value="{{ $post->title }}">
    <br>

    <label for="body">Message Body</label>
    <input type="text" name="body" value="{{ $post->body }}">
    <br>

    <button type="submit">Update</button>
</form>
