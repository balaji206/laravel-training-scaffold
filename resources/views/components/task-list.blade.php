
@section('page_title', 'Dashboard')

@section('content')
<div class="container mx-auto">
    @auth()
        @if (session('status'))
            <div class="mb-6 p-4 bg-emerald-100 text-emerald-700 rounded-2xl border border-emerald-200 animate-fade-up">
                {{ session('status') }}
            </div>
        @endif

        <div class="space-y-10">
            {{-- 1. Stats Overview Section --}}
            <div>
                <h2 class="text-xl font-bold text-slate-800 mb-6 flex items-center gap-2">
                    <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                    Performance Overview
                </h2>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    {{-- Pending Card --}}
                    <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm hover:shadow-md transition-all">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-10 h-10 bg-amber-50 text-amber-600 rounded-xl flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Todo</span>
                        </div>
                        <h5 class="text-slate-500 text-sm font-bold">Pending Tasks</h5>
                        <p class="text-4xl font-black text-slate-900 mt-1">
                            {{ auth()->user()->projects->flatMap->tasks->where('status', 'todo')->count() }}
                        </p>
                    </div>

                    {{-- In Progress Card --}}
                    <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm hover:shadow-md transition-all">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-10 h-10 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                            </div>
                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Active</span>
                        </div>
                        <h5 class="text-slate-500 text-sm font-bold">In Progress</h5>
                        <p class="text-4xl font-black text-slate-900 mt-1">
                            {{ auth()->user()->projects->flatMap->tasks->where('status', 'in_progress')->count() }}
                        </p>
                    </div>

                    {{-- Completed Card --}}
                    <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm hover:shadow-md transition-all">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-10 h-10 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            </div>
                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Done</span>
                        </div>
                        <h5 class="text-slate-500 text-sm font-bold">Completed</h5>
                        <p class="text-4xl font-black text-slate-900 mt-1">
                            {{ auth()->user()->projects->flatMap->tasks->where('status', 'done')->count() }}
                        </p>
                    </div>
                </div>
            </div>

            {{-- 2. Task Feed Section --}}
            <div class="animate-fade-up" style="animation-delay: 0.2s">
                <h2 class="text-xl font-bold text-slate-800 mb-6">Your Recent Tasks</h2>

                <div class="bg-white border border-slate-200 rounded-[2.5rem] overflow-hidden shadow-sm">
                    <ul id="taskList" class="divide-y divide-slate-50">
                        {{-- Getting tasks directly through projects relationship --}}
                        @forelse(auth()->user()->projects->flatMap->tasks as $task)
                            <li class="p-6 hover:bg-slate-50/50 transition-colors">
                                {{-- We use the component but it MUST be clean of broken routes --}}
                                <x-task-list :task="$task"/>
                            </li>
                        @empty
                            <li class="p-20 text-center">
                                <p class="text-slate-400 font-medium italic">No active tasks found.</p>
                            </li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    @endauth
</div>
@endsection