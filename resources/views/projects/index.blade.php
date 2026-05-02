@extends('layouts.app')

@section('content')

    {{-- Should display all projects in a Tailwind grid; each card links to the show page --}}
    {{-- TODO Day 5: replace hardcoded data with real DB data passed from the controller --}}
    {{-- TODO Day 9: use @can('update', $project) to conditionally show edit/delete buttons --}}
    <h1 class="text-3xl font-bold mb-4">Projects</h1>

@if(count($projects) == 0)
    <p>No projects found</p>
@endif

@foreach($projects as $project)
    <div class="mb-2">
        <a href="/projects/{{ $project['id'] }}" class="text-blue-500">
            {{ $project['name'] }}
        </a>
    </div>
@endforeach
@endsection