@extends('layouts.app')

@section('page_title', 'Dashboard')

@section('content')

<div class="min-h-screen bg-slate-50 py-10">

    <div class="max-w-7xl mx-auto px-6">

        {{-- Header --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-10">

            <div>
                @auth
                    Welcome back, {{ auth()->user()->name }}
                @else
                    Welcome to TaskNest
                @endauth

                <p class="mt-2 text-slate-500 text-lg">
                    Manage your projects and tasks efficiently.
                </p>
            </div>

            <a href="/projects"
               class="mt-5 md:mt-0 inline-flex items-center gap-2 px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-2xl shadow-lg shadow-indigo-200 transition">

                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M12 4v16m8-8H4">
                    </path>
                </svg>

                View Projects
            </a>

        </div>

        {{-- Stats Section --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">

            {{-- Total Projects --}}
            <div class="bg-white rounded-3xl p-8 shadow-sm border border-slate-100 hover:shadow-xl transition">

                <div class="flex items-center justify-between mb-6">

                    <div class="w-14 h-14 rounded-2xl bg-indigo-100 flex items-center justify-center">
                        <svg class="w-7 h-7 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M3 7h18M3 12h18M3 17h18">
                            </path>
                        </svg>
                    </div>

                    <span class="text-xs uppercase tracking-widest font-bold text-slate-400">
                        Projects
                    </span>

                </div>

                <h2 class="text-slate-500 font-semibold text-lg">
                    Total Projects
                </h2>

                {{ auth()->user()?->projects?->count() ?? 0 }}

            </div>

            {{-- Active Tasks --}}
            <div class="bg-white rounded-3xl p-8 shadow-sm border border-slate-100 hover:shadow-xl transition">

                <div class="flex items-center justify-between mb-6">

                    <div class="w-14 h-14 rounded-2xl bg-blue-100 flex items-center justify-center">
                        <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M13 10V3L4 14h7v7l9-11h-7z">
                            </path>
                        </svg>
                    </div>

                    <span class="text-xs uppercase tracking-widest font-bold text-slate-400">
                        Tasks
                    </span>

                </div>

                <h2 class="text-slate-500 font-semibold text-lg">
                    Active Tasks
                </h2>

                <p class="mt-3 text-5xl font-black text-slate-900">
                    {{ \App\Models\Task::where('status', 'in_progress')->count() }}
                </p>

            </div>

            {{-- Completed Tasks --}}
            <div class="bg-white rounded-3xl p-8 shadow-sm border border-slate-100 hover:shadow-xl transition">

                <div class="flex items-center justify-between mb-6">

                    <div class="w-14 h-14 rounded-2xl bg-emerald-100 flex items-center justify-center">
                        <svg class="w-7 h-7 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                    </div>

                    <span class="text-xs uppercase tracking-widest font-bold text-slate-400">
                        Done
                    </span>

                </div>

                <h2 class="text-slate-500 font-semibold text-lg">
                    Completed Tasks
                </h2>

                <p class="mt-3 text-5xl font-black text-slate-900">
                    {{ \App\Models\Task::where('status', 'done')->count() }}
                </p>

            </div>

        </div>

        {{-- Recent Projects --}}
        <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm overflow-hidden">

            <div class="px-8 py-6 border-b border-slate-100 flex items-center justify-between">

                <div>
                    <h2 class="text-2xl font-bold text-slate-900">
                        Recent Projects
                    </h2>

                    <p class="text-slate-500 mt-1">
                        Your latest created projects
                    </p>
                </div>

            </div>

            <div class="divide-y divide-slate-100">

                @auth

@forelse(auth()->user()->projects()->latest()->take(5)->get() as $project)

                    <div class="p-8 hover:bg-slate-50 transition">

                        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                            <div>

                                <h3 class="text-xl font-bold text-slate-900">
                                    {{ $project->name }}
                                </h3>

                                <p class="mt-2 text-slate-500">
                                    {{ $project->description }}
                                </p>

                            </div>

                            <a href="/projects/{{ $project->id }}"
                               class="inline-flex items-center justify-center px-5 py-2.5 rounded-xl bg-indigo-50 text-indigo-700 hover:bg-indigo-100 font-semibold transition">

                                View Project

                            </a>

                        </div>

                    </div>

                @empty

                    <div class="p-16 text-center">

                        <p class="text-slate-400 text-lg font-medium">
                            No projects found.
                        </p>

                    </div>

                @endforelse
                @endauth

            </div>

        </div>

    </div>

</div>

@endsection