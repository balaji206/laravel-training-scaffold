
@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-10 px-4">

    <div class="max-w-2xl mx-auto bg-white shadow-xl rounded-2xl p-8 border border-gray-100">

        {{-- Header --}}
        <h1 class="text-2xl font-bold text-gray-800 mb-6">
            Edit Task
        </h1>

        <form method="POST" action="/projects/{{ $project->id }}/tasks/{{ $task->id }}">
            @csrf
            @method('PUT')

            {{-- Title --}}
            <div class="mb-5">
                <label class="block text-sm font-semibold text-gray-700 mb-1">
                    Task Title
                </label>
                <input 
                    type="text" 
                    name="title"
                    value="{{ old('title', $task->title) }}"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400"
                >
                @error('title')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Description --}}
            <div class="mb-5">
                <label class="block text-sm font-semibold text-gray-700 mb-1">
                    Description
                </label>
                <textarea 
                    name="description"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400"
                >{{ old('description', $task->description) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- Status --}}
            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-700 mb-1">
                    Status
                </label>
                <select 
                    name="status" 
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400"
                >
                    <option value="todo" {{ $task->status == 'todo' ? 'selected' : '' }}>Pending</option>
                    <option value="in_progress" {{ $task->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="done" {{ $task->status == 'done' ? 'selected' : '' }}>Completed</option>
                </select>
                @error('status')
                    <p class="text-red-500 text-sm mt-1">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="mb-6">

    <label class="block text-sm font-bold text-slate-700 mb-2">
        Assign To
    </label>

    <select 
        name="assigned_to_id"
        class="w-full border rounded px-4 py-2"
    >

        <option value="">Select User</option>

        @foreach($users as $user)

            <option 
                value="{{ $user->id }}"
                {{ $task->assigned_to_id == $user->id ? 'selected' : '' }}
            >
                {{ $user->name }}
            </option>

        @endforeach

    </select>

</div>
            {{-- Buttons --}}
            <div class="flex items-center justify-between">

                <a href="/projects/{{ $project->id }}/tasks"
                   class="text-gray-500 hover:text-gray-700 text-sm">
                    ← Back
                </a>

                <button type="submit"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2 rounded-lg shadow transition">
                    Update Task
                </button>

            </div>

        </form>

    </div>

</div>

@endsection