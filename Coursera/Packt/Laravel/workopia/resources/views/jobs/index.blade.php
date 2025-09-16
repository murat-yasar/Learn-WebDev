<x-layout>
   <x-slot name="title">Workopia | Open Positions</x-slot>
   <h2>Open Positions</h2>
   <ul>
      @forelse ($jobs as $job)
      <li>{{ $job }}</li>
      @empty
      <li>No Jobs Available</li>
      @endforelse
   </ul>
</x-layout>
