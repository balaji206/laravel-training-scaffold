<!-- 
    
    {{-- TODO Day 5: wire POST action and old() helper for repopulation --}}
    {{-- TODO Day 7: add @error directives to display validation errors --}} -->

    


@extends('layouts.app')

@section('content')

<div class="container mx-auto py-8">
    <h1 class="text-3xl font-bold mb-6">New Project</h1>

    <form method="POST" action="/projects">
        @csrf

        {{-- Project Name --}}
        <div class="mb-4">
            <label class="block text-sm font-medium">Project Name</label>
            <input 
                type="text" 
                name="name" 
                class="w-full border rounded px-3 py-2 mt-1"
                placeholder="Enter project name"
            >
        </div>

        {{-- Description --}}
        <div class="mb-4">
            <label class="block text-sm font-medium">Description</label>
            <textarea 
                name="description" 
                class="w-full border rounded px-3 py-2 mt-1"
                placeholder="Enter project description"
            ></textarea>
        </div>

        {{-- Submit --}}
        <button class="bg-blue-500 text-white px-4 py-2 rounded" type="button">
            Create Project
        </button>

    </form>
</div>

@endsection