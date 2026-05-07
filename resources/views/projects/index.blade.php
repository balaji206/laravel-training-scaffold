{{-- Should display all projects in a Tailwind grid; each card links to the show page --}}
{{-- TODO Day 9: use @can('update', $project) to conditionally show edit/delete buttons --}}
@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-slate-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">

        {{-- Header --}}
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-6 mb-10">
            <div>
                <h1 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">Projects</h1>
                <p class="mt-2 text-sm text-slate-500">Manage and oversee all your ongoing projects.</p>
            </div>

            <a href="/projects/create" class="inline-flex items-center justify-center bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold px-6 py-3.5 rounded-xl shadow-md hover:shadow-lg hover:-translate-y-0.5 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600">
                <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                Create Project
            </a>
        </div>

        {{-- Empty State --}}
        @if($projects->isEmpty())
            <div class="bg-white border-2 border-dashed border-slate-200 rounded-3xl p-16 text-center shadow-sm">
                <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-slate-50 mb-6">
                    <svg class="h-10 w-10 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-2">No projects found</h3>
                <p class="text-slate-500 max-w-sm mx-auto mb-8">Get started by creating your first project to organize your tasks.</p>
            </div>
        @endif

        {{-- Projects Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
            @foreach($projects as $project)
                <div class="group flex flex-col bg-white rounded-3xl shadow-sm hover:shadow-xl border border-slate-100 hover:border-indigo-100 hover:-translate-y-1 transition-all duration-300 overflow-hidden relative">
                    
                    {{-- Top Accent Line --}}
                    <div class="absolute top-0 left-0 w-full h-1.5 bg-indigo-500 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

                    <div class="p-6 flex-1 pt-8">
                        {{-- Project Name --}}
                        <a href="/projects/{{ $project->id }}" class="text-xl font-bold text-slate-900 group-hover:text-indigo-600 transition-colors duration-200 line-clamp-2">
                            {{ $project->name }}
                        </a>
                        <p class="text-sm text-slate-500 mt-2">
    Tasks: {{ $project->tasks->count() }}
</p>
                    </div>
                    

                    {{-- Actions Footer --}}
                    <div class="mt-auto border-t border-slate-50 bg-slate-50/50 p-4 px-6 flex items-center justify-between">
                        <a href="/projects/{{ $project->id }}" class="text-sm font-bold text-indigo-600 hover:text-indigo-800 transition-colors">
                            View Details &rarr;
                        </a>

                        <div class="flex items-center space-x-1">
                            @can('update',$project)
                            <a href="/projects/{{ $project->id }}/edit" class="inline-flex items-center justify-center p-2 text-slate-400 hover:text-emerald-600 hover:bg-emerald-50 rounded-xl transition-colors" title="Edit">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            </a>

                            <form method="POST" action="/projects/{{ $project->id }}" class="m-0 flex">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center justify-center p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-xl transition-colors" title="Delete">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                            @endcan
                        </div>
                    </div>

                </div>
            @endforeach
        </div>

    </div>
</div>

@endsection