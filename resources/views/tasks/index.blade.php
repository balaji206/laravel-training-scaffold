@extends('layouts.app')

@section('content')
   
    {{-- Should display all tasks for the current project, grouped or filtered by status --}}
    {{-- TODO Day 5: replace hardcoded data with real DB data passed from the controller --}}
    {{-- TODO Day 9: use @can('update', $task) to conditionally show edit/delete buttons --}}

   <div class="container mx-auto py-8">
    <h1 class="text-3xl font-bold mb-6">Tasks</h1>

    @php
        $tasks = [
            ['id' => 1, 'title' => 'Task 1', 'status' => 'Pending'],
            ['id' => 2, 'title' => 'Task 2', 'status' => 'Completed']
        ];
    @endphp

    @foreach($tasks as $task)
        <div class="mb-3 border p-3">
            <p><strong>{{ $task['title'] }}</strong></p>
            <p>Status: {{ $task['status'] }}</p>

            <a href="/projects/1/tasks/{{ $task['id'] }}" class="text-blue-500">
                View
            </a>
        </div>
    @endforeach

</div>
@endsection