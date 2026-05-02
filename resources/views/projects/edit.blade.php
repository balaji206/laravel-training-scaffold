@extends('layouts.app')

@section('content')
 
    {{-- TODO Day 5: pre-fill fields with $project values --}}
    <!-- {{-- TODO Day 7: add @error directives --}} -->

    <div class="container mx-auto py-8">
    <h1 class="text-3xl font-bold mb-6">Edit Project</h1>

    <form method="POST" action="#">
        @csrf

        {{-- Project Name --}}
        <div class="mb-4">
            <label class="block text-sm font-medium">Project Name</label>
            <input 
                type="text" 
                name="name" 
                class="w-full border rounded px-3 py-2 mt-1"
                value="{{$project['name']}}"
            >
        </div>

        {{-- Description --}}
        <div class="mb-4">
            <label class="block text-sm font-medium">Description</label>
            <textarea 
                name="description" 
                class="w-full border rounded px-3 py-2 mt-1"
            >Sample description</textarea>
        </div>

        {{-- Submit --}}
        <button type="button" class="bg-green-500 text-white px-4 py-2 rounded">
            Update Project
        </button>

    </form>

    <div class="mt-4">
        <a href="/projects" class="text-blue-500">Back</a>
    </div>
</div>
@endsection