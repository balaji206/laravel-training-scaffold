@extends('layouts.app')

@section('content')

<div class="max-w-5xl mx-auto p-6">

    <h1 class="text-3xl font-bold mb-6">
        Completed Tasks
    </h1>

    <div class="space-y-4">

        @forelse($tasks as $task)

            <div class="bg-white shadow rounded-xl p-5 border">

                <h2 class="text-xl font-semibold">
                    {{ $task->title }}
                </h2>

                <p class="text-gray-600 mt-2">
                    {{ $task->description }}
                </p>

                <p class="text-sm text-indigo-600 mt-3">
                    Project: {{ $task->project->name }}
                </p>

            </div>

        @empty

            <p>No completed tasks found.</p>

        @endforelse

    </div>

</div>

@endsection