{{-- TODO Day 6: list nested $task->comments --}}
{{-- TODO Day 11: if $task->attachment_path exists, show a download link --}}
@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-slate-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        
        {{-- Back Link --}}
        <div class="mb-6">
            <a href="/projects/{{ $project->id }}/tasks" class="inline-flex items-center text-sm font-semibold text-indigo-600 hover:text-indigo-800 transition duration-150 ease-in-out bg-indigo-50 hover:bg-indigo-100 px-4 py-2.5 rounded-xl shadow-sm">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Back to Tasks
            </a>
        </div>

        {{-- Main Card --}}
        <div class="bg-white shadow-xl shadow-slate-200/40 rounded-2xl overflow-hidden ring-1 ring-slate-200">
            
            {{-- Header --}}
            <div class="p-6 sm:p-8 border-b border-slate-100 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-5 bg-white">
                <div>
                    <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight leading-tight">
                        {{ $task->title }}
                    </h1>
                    <div class="mt-2 flex items-center text-sm font-medium text-slate-500">
                        <span class="bg-slate-100 text-slate-600 px-2 py-1 rounded-md mr-3">Task ID: #{{ $task->id }}</span>
                    </div>
                </div>
                
                <div>
                    <span class="inline-flex items-center gap-1.5 px-4 py-1.5 text-sm font-bold rounded-full ring-1 ring-inset tracking-wide shadow-sm whitespace-nowrap
                        @if($task->status == 'todo') bg-amber-50 text-amber-700 ring-amber-600/20
                        @elseif($task->status == 'in_progress') bg-blue-50 text-blue-700 ring-blue-600/20
                        @else bg-emerald-50 text-emerald-700 ring-emerald-600/20
                        @endif
                    ">
                        <svg class="h-2 w-2 
                            @if($task->status == 'todo') fill-amber-500
                            @elseif($task->status == 'in_progress') fill-blue-500
                            @else fill-emerald-500
                            @endif
                        " viewBox="0 0 6 6" aria-hidden="true"><circle cx="3" cy="3" r="3" /></svg>
                        {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                    </span>
                </div>
            </div>

            {{-- Body --}}
            <div class="p-6 sm:p-8">
                <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path></svg>
                    Description
                </h3>
                <div class="bg-slate-50/80 p-6 rounded-xl border border-slate-100 text-slate-700 leading-relaxed whitespace-pre-line shadow-inner min-h-[120px]">
                    {{ $task->description }}
                </div>
            </div>

            {{-- Footer / Actions --}}
            <div class="px-6 py-5 sm:px-8 bg-slate-50 border-t border-slate-100 flex flex-wrap items-center gap-3">
                <a href="/projects/{{ $project->id }}/tasks/{{ $task->id }}/edit" 
                   class="inline-flex items-center justify-center rounded-lg bg-white px-5 py-2.5 text-sm font-semibold text-slate-700 shadow-sm ring-1 ring-inset ring-slate-300 hover:bg-slate-50 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2">
                    <svg class="w-4 h-4 mr-2 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    Edit Task
                </a>

                <form method="POST" action="/projects/{{ $project->id }}/tasks/{{ $task->id }}" class="inline m-0">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="inline-flex items-center justify-center rounded-lg bg-red-50 hover:bg-red-100 px-5 py-2.5 text-sm font-semibold text-red-700 shadow-sm ring-1 ring-inset ring-red-600/20 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-red-600 focus:ring-offset-2">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        Delete Task
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>

@endsection