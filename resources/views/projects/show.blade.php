@extends('layouts.app')

@section('content')
  
    {{-- TODO Day 5: pass $project from the controller and display its fields --}}
    {{-- TODO Day 6: list nested $project->tasks with their $task->comments --}}

    <h1 class="text-3xl font-bold mb-4">Project Detail</h1>

<div class="mb-4">
    <p><strong>ID:</strong> {{ $project['id'] }}</p>
    <p><strong>Name:</strong> {{ $project['name'] }}</p>
</div>

<a href="/projects" class="text-blue-500">Back to Projects</a>
@endsection