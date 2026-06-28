<form method="POST" action="{{ url('login') }}">
    @csrf
    <label for="email">Email</label>
    <input type="email" name="email">
    <br>

    <label for="password">Password</label>
    <input type="password" name="password">
    <br>

    <button type="submit">Submit</button>
</form>
