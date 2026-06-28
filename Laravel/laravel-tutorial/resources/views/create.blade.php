<form method="POST" action="{{ url('posts') }}">
    @csrf
    <label for="title">Title</label>
    <input type="text" name="title">
    <br>

    <label for="body">Message Body</label>
    <input type="text" name="body">
    <br>

    <button type="submit">Submit</button>
</form>
