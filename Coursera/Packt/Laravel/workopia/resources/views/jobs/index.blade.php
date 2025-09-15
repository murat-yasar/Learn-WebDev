@extends('layout')

@section('title')
Workopia | Open Positions
@endsection

@section('content')
<h2>Open Positions</h2>
<ul>
   @forelse ($jobs as $job)
   <li>{{ $job }}</li>
   @empty
   <li>No Jobs Available</li>
   @endforelse
</ul>
@endsection