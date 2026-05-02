@extends('layouts.app')

@section('content')

    {{-- TODO Day 5: pre-fill fields with $task values --}}
    {{-- TODO Day 7: add @error directives --}}

    <div class="container mx-auto py-8">
    <h1 class="text-3xl font-bold mb-6">Edit Task</h1>

    <form>
        @csrf

        <div class="mb-4">
            <label>Task Title</label>
            <input type="text" value="Task 1" class="w-full border px-2 py-1">
        </div>

        <div class="mb-4">
            <label>Description</label>
            <textarea class="w-full border px-2 py-1">Sample description</textarea>
        </div>

        <div class="mb-4">
            <label>Status</label>
            <select class="w-full border px-2 py-1">
                <option selected>Pending</option>
                <option>In Progress</option>
                <option>Completed</option>
            </select>
        </div>

        <button type="button" class="bg-green-500 text-white px-4 py-2">
            Update Task
        </button>
    </form>
</div>
@endsection