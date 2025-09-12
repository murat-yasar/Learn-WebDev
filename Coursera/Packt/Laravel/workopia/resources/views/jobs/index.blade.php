<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Available Jobs</title>
</head>
<body>
   <h1>{{ $title }}</h1>
   <!-- @if (!empty($jobs))
   <ul>
      @foreach ($jobs as $job)
      <li>{{ $job }}</li>
      @endforeach
   </ul>
   @else
   <p>Currently, no jobs are available!</p>
   @endif -->
   <ul>
      @forelse ($jobs as $job)
      @if ($loop->first)
      <li>First: {{ $job }}</li>
      @elseif ($loop->last)
      <li>Last: {{ $job }}</li>
      @else
      <li>{{ $loop->iteration }} - {{ $job }}</li>
      @endif
      @empty
      <p>No available jobs!</p>
      @endforelse
   </ul>
</body>
</html>