
{{-- TODO Day 11: add file upload input (enctype="multipart/form-data") --}}
@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-slate-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-2xl mx-auto">
        
        {{-- Header --}}
        <div class="mb-8">
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">New Task</h1>
            <p class="mt-2 text-sm text-slate-500">Fill in the details below to add a new task to your project.</p>
        </div>

        {{-- Form Card --}}
        <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
            <form method="POST" action="/projects/{{ $project->id }}/tasks" class="p-6 sm:p-8">
                @csrf

                {{-- Title --}}
                <div class="mb-6">
                    <label class="block text-sm font-bold text-slate-700 mb-2">Task Title</label>
                    <input 
                        type="text" 
                        name="title" 
                        value="{{ old('title') }}" 
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent focus:bg-white transition-all duration-200 shadow-sm"
                        placeholder="e.g., Update user dashboard"
                    >
                    @error('title')
                        <p class="mt-2 text-sm font-medium text-red-500 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Description --}}
                <div class="mb-6">
                    <label class="block text-sm font-bold text-slate-700 mb-2">Description</label>
                    <textarea 
                        name="description"
                        rows="4"
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent focus:bg-white transition-all duration-200 shadow-sm resize-y"
                        placeholder="Provide more details about this task..."
                    >{{ old('description') }}</textarea>
                    @error('description')
                        <p class="mt-2 text-sm font-medium text-red-500 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Status --}}
                <div class="mb-8">
                    <label class="block text-sm font-bold text-slate-700 mb-2">Status</label>
                    <div class="relative">
                        <select name="status" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-slate-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent focus:bg-white transition-all duration-200 shadow-sm appearance-none">
                            <option value="todo">Pending</option>
                            <option value="in_progress">In Progress</option>
                            <option value="done">Completed</option>
                        </select>
                        @error('status')
                            <p class="mt-2 text-sm font-medium text-red-500 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-500">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </div>
                </div>

                {{-- Actions --}}
                <div class="flex items-center justify-end pt-4 border-t border-slate-100 mt-2 gap-4">
                    <a href="/projects/{{ $project->id }}/tasks" class="text-sm font-semibold text-slate-500 hover:text-slate-700 transition-colors">
                        Cancel
                    </a>
                    <button type="submit" class="inline-flex items-center justify-center bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-bold px-8 py-3.5 rounded-xl shadow-md hover:shadow-lg hover:-translate-y-0.5 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600">
                        <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Create Task
                    </button>
                </div>

            </form>
        </div>

    </div>
</div>

@endsection