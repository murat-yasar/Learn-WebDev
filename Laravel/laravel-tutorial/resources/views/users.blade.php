<h1>Users</h1>
@if ($users)
    @foreach ( $users as $user)
        <p><strong>{{ $user->name }} :</strong> {{ $user->email }}</p>
    @endforeach
@else
<h2>No user found!</h2>
@endif
