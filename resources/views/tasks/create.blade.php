@extends('layouts.app')

@section('content')
    {{-- TODO Day 5: wire POST action and old() helper for repopulation --}}
    {{-- TODO Day 7: add @error directives to display validation errors --}}
    {{-- TODO Day 11: add file upload input (enctype="multipart/form-data") --}}

    <div class="container mx-auto py-8">
    <h1 class="text-3xl font-bold mb-6">New Task</h1>

    <form>
        @csrf

        <div class="mb-4">
            <label>Task Title</label>
            <input type="text" class="w-full border px-2 py-1">
        </div>

        <div class="mb-4">
            <label>Description</label>
            <textarea class="w-full border px-2 py-1"></textarea>
        </div>

        <div class="mb-4">
            <label>Status</label>
            <select class="w-full border px-2 py-1">
                <option>Pending</option>
                <option>In Progress</option>
                <option>Completed</option>
            </select>
        </div>

        <button type="button" class="bg-blue-500 text-white px-4 py-2">
            Create Task
        </button>
    </form>
</div>
@endsection