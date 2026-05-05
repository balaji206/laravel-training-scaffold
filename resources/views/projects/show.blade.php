{{-- TODO Day 6: list nested $project->tasks with their $task->comments --}}
@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-slate-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-5xl mx-auto">
        
        {{-- Back Link --}}
        <div class="mb-8">
            <a href="/projects" class="inline-flex items-center text-sm font-semibold text-indigo-600 hover:text-indigo-800 transition-colors duration-200 bg-indigo-50 hover:bg-indigo-100 px-4 py-2.5 rounded-xl shadow-sm">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Back to Projects
            </a>
        </div>

        {{-- Main Card --}}
        <div class="bg-white overflow-hidden shadow-xl shadow-slate-200/40 ring-1 ring-slate-200 sm:rounded-3xl">
            
            {{-- Header --}}
            <div class="px-6 py-8 sm:px-8 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-6 bg-white">
                <div>
                    <h1 class="text-3xl font-extrabold leading-tight text-slate-900 tracking-tight">Project Detail</h1>
                    <p class="mt-2 text-sm text-slate-500 font-medium">View and manage the details of this project.</p>
                </div>
                
                <div class="flex items-center gap-3">
                    <a href="/projects/{{ $project->id }}/edit" class="inline-flex items-center justify-center rounded-xl bg-white px-5 py-2.5 text-sm font-semibold text-slate-700 shadow-sm ring-1 ring-inset ring-slate-300 hover:bg-slate-50 hover:text-indigo-600 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        <svg class="w-4 h-4 mr-2 text-slate-400 group-hover:text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                        Edit
                    </a>
                    
                    <form method="POST" action="/projects/{{ $project->id }}" class="inline m-0">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex items-center justify-center rounded-xl bg-red-50 px-5 py-2.5 text-sm font-semibold text-red-700 shadow-sm ring-1 ring-inset ring-red-600/20 hover:bg-red-100 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            Delete
                        </button>
                    </form>
                </div>
            </div>

            {{-- Body --}}
            <div class="px-6 py-6 sm:px-8 bg-white">
                <dl class="divide-y divide-slate-100">
                    <div class="py-6 sm:grid sm:grid-cols-3 sm:gap-4 hover:bg-slate-50/50 transition-colors duration-150 rounded-2xl px-4 -mx-4">
                        <dt class="text-sm font-bold text-slate-900 flex items-center">
                            <span class="bg-slate-100 text-slate-600 px-3 py-1.5 rounded-lg shadow-sm">Project ID</span>
                        </dt>
                        <dd class="mt-2 text-base leading-6 text-slate-800 font-bold sm:col-span-2 sm:mt-0 flex items-center">
                            <span class="text-slate-400 mr-1">#</span>{{ $project->id }}
                        </dd>
                    </div>
                    
                    <div class="py-6 sm:grid sm:grid-cols-3 sm:gap-4 hover:bg-slate-50/50 transition-colors duration-150 rounded-2xl px-4 -mx-4">
                        <dt class="text-sm font-bold text-slate-900 flex items-center">
                            <span class="bg-indigo-50 text-indigo-700 px-3 py-1.5 rounded-lg shadow-sm">Project Name</span>
                        </dt>
                        <dd class="mt-2 text-base leading-6 text-slate-900 font-semibold sm:col-span-2 sm:mt-0 flex items-center">
                            {{ $project->name }}
                        </dd>
                    </div>
                    <a href="/projects/{{ $project->id }}/tasks"
   class="inline-block mt-4 bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg">
    View Tasks
</a>
                    <div class="py-6 sm:grid sm:grid-cols-3 sm:gap-4 hover:bg-slate-50/50 transition-colors duration-150 rounded-2xl px-4 -mx-4">
                        <dt class="text-sm font-bold text-slate-900 flex items-start pt-1">
                            <span class="bg-emerald-50 text-emerald-700 px-3 py-1.5 rounded-lg shadow-sm">Description</span>
                        </dt>
                        <dd class="mt-2 text-base leading-7 text-slate-600 sm:col-span-2 sm:mt-0">
                            <div class="bg-slate-50/80 p-5 rounded-xl border border-slate-100 shadow-inner whitespace-pre-line">{{ $project->description }}</div>
                        </dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>
</div>

@endsection