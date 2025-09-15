@extends('layout')

@section('title')
Workopia | Create Job
@endsection

@section('content')
<h2>Create a New Job</h2>
<form action="/jobs" method="POST">
   @csrf
   <input type="text" name="title" placeholder="title"><br>
   <input type="text" name="description" placeholder="description"><br>
   <button type="submit">Submit</button>
</form>
@endsection