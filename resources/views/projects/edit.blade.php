@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-slate-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-2xl mx-auto">
        
        {{-- Header --}}
        <div class="mb-8">
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Edit Project</h1>
            <p class="mt-2 text-sm text-slate-500">Update the details of your project below.</p>
        </div>

        {{-- Form Card --}}
        <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
            <form method="POST" action="/projects/{{ $project->id }}" class="p-6 sm:p-8">
                @csrf
                @method('PUT')

                {{-- Project Name --}}
                <div class="mb-6">
                    <label class="block text-sm font-bold text-slate-700 mb-2">Project Name</label>
                    <input 
                        type="text" 
                        name="name" 
                        value="{{ old('name', $project->name) }}"
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent focus:bg-white transition-all duration-200 shadow-sm"
                    >
                    @error('name')
                        <p class="mt-2 text-sm font-medium text-red-500 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Description --}}
                <div class="mb-8">
                    <label class="block text-sm font-bold text-slate-700 mb-2">Description</label>
                    <textarea 
                        name="description" 
                        rows="5"
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent focus:bg-white transition-all duration-200 shadow-sm resize-y"
                    >{{ old('description', $project->description) }}</textarea>
                    @error('description')
                        <p class="mt-2 text-sm font-medium text-red-500 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Actions --}}
                <div class="flex items-center justify-end pt-4 border-t border-slate-100 mt-2 gap-4">
                    <a href="/projects" class="text-sm font-semibold text-slate-500 hover:text-slate-700 transition-colors">
                        Cancel
                    </a>
                    <button type="submit" class="inline-flex items-center justify-center bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-bold px-8 py-3.5 rounded-xl shadow-md hover:shadow-lg hover:-translate-y-0.5 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-600">
                        <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                        Update Project
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection