@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-slate-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        
        {{-- Header --}}
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-6 mb-12">
            <div>
                <p class="text-sm font-semibold text-indigo-600 uppercase tracking-widest mb-2">Project Tasks</p>
                <h1 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">
                    {{ $project->name }}
                </h1>
            </div>

            <a href="/projects/{{ $project->id }}/tasks/create"
               class="inline-flex items-center justify-center bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold px-6 py-3 rounded-xl shadow-sm hover:shadow-md transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600">
                <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                Add Task
            </a>
        </div>

        {{-- Empty State --}}
        @if($tasks->isEmpty())
            <div class="mt-16 bg-white border-2 border-dashed border-slate-200 rounded-2xl p-12 text-center shadow-sm">
                <svg class="mx-auto h-12 w-12 text-slate-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
                <h3 class="text-lg font-bold text-slate-900">No tasks available</h3>
                <p class="mt-2 text-sm text-slate-500 max-w-sm mx-auto">Get started by creating your first task to keep track of progress on this project.</p>
                <div class="mt-6">
                    <a href="/projects/{{ $project->id }}/tasks/create" class="inline-flex items-center justify-center text-sm font-semibold text-indigo-600 bg-indigo-50 hover:bg-indigo-100 px-5 py-2.5 rounded-lg transition-colors">
                        Create your first task
                    </a>
                </div>
            </div>
        @endif

        {{-- Tasks Grid --}}
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">

            @foreach($tasks as $task)
                <div class="group flex flex-col bg-white rounded-2xl shadow-sm hover:shadow-xl ring-1 ring-slate-200 hover:ring-indigo-100 transition-all duration-300 overflow-hidden">
                    
                    <div class="p-6 flex-1">
                        {{-- Status Badge --}}
                        <div class="mb-5">
                            <span class="
                                inline-flex items-center gap-1.5 px-3 py-1 text-xs font-bold rounded-full ring-1 ring-inset tracking-wide
                                @if($task->status == 'todo') bg-amber-50 text-amber-700 ring-amber-600/20
                                @elseif($task->status == 'in_progress') bg-blue-50 text-blue-700 ring-blue-600/20
                                @else bg-emerald-50 text-emerald-700 ring-emerald-600/20
                                @endif
                            ">
                                <svg class="h-1.5 w-1.5 
                                    @if($task->status == 'todo') fill-amber-500
                                    @elseif($task->status == 'in_progress') fill-blue-500
                                    @else fill-emerald-500
                                    @endif
                                " viewBox="0 0 6 6" aria-hidden="true"><circle cx="3" cy="3" r="3" /></svg>
                                {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                            </span>
                        </div>

                        {{-- Title --}}
                        <h2 class="text-xl font-bold text-slate-900 group-hover:text-indigo-600 transition-colors duration-200 line-clamp-2">
                            {{ $task->title }}
                        </h2>
                    </div>

                    {{-- Actions Footer --}}
                    <div class="mt-auto border-t border-slate-100 bg-slate-50/50 p-4">
                        <div class="flex items-center justify-between">
                            
                            <a href="/projects/{{ $project->id }}/tasks/{{ $task->id }}"
                               class="inline-flex items-center justify-center px-4 py-2 text-sm font-semibold text-indigo-700 bg-white hover:bg-indigo-50 border border-slate-200 hover:border-indigo-200 rounded-lg shadow-sm transition-colors">
                                View Details
                            </a>

                            <div class="flex items-center space-x-2">
                                @can('update',$task)
                                <a href="/projects/{{ $project->id }}/tasks/{{ $task->id }}/edit"
                                   class="inline-flex items-center justify-center p-2 text-slate-400 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg transition-colors" title="Edit">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                </a>
                                @endcan 
                                @can('delete',$task)
                                <form method="POST" action="/projects/{{ $project->id }}/tasks/{{ $task->id }}" class="m-0 flex">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center justify-center p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Delete">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                                @endcan
                            </div>

                        </div>
                    </div>

                </div>
            @endforeach

        </div>
    </div>
</div>

@endsection