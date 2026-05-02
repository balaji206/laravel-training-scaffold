@extends('layouts.app')

@section('content')
    
    {{-- TODO Day 5: pass $task from the controller and display its fields --}}
    {{-- TODO Day 6: list nested $task->comments --}}
    {{-- TODO Day 11: if $task->attachment_path exists, show a download link --}}

    <div class="container mx-auto py-8">
    <h1 class="text-3xl font-bold mb-6">Task Detail</h1>

    @php
        $task = [
            'id' => 1,
            'title' => 'Task 1',
            'description' => 'Sample description',
            'status' => 'Pending'
        ];
    @endphp

    <p><strong>ID:</strong> {{ $task['id'] }}</p>
    <p><strong>Title:</strong> {{ $task['title'] }}</p>
    <p><strong>Description:</strong> {{ $task['description'] }}</p>
    <p><strong>Status:</strong> {{ $task['status'] }}</p>

    <a href="/projects/1/tasks" class="text-blue-500">Back</a>

</div>
@endsection