@extends('layout')

@section('title')
Workopia | Job | {{ $title }}
@endsection

@section('content')
<h2>{{ $title }}</h2>
<p>{{ $description }}</p>
@endsection