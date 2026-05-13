<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>TaskNest</title>

    {{-- Tailwind & Fonts --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f8fafc; color: #1e293b; }
        .glass { background: rgba(255, 255, 255, 0.85); backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); border: 1px solid rgba(255, 255, 255, 0.3); }
        
        /* High-Fidelity Grid Background */
        .bg-hero-grid { 
            background-image: linear-gradient(to right, #e2e8f0 1px, transparent 1px), 
                              linear-gradient(to bottom, #e2e8f0 1px, transparent 1px);
            background-size: 40px 40px;
            mask-image: radial-gradient(ellipse 60% 50% at 50% 0%, #000 70%, transparent 100%);
        }

        /* Hero Text Gradient */
        .hero-text { background: linear-gradient(to right, #4f46e5, #9333ea); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }

        /* Floating Animation for UI Elements */
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(1deg); }
        }
        .animate-float { animation: float 6s ease-in-out infinite; }
        .delay-1 { animation-delay: 2s; }

        @keyframes fade-up { 
            from { opacity: 0; transform: translateY(20px); } 
            to { opacity: 1; transform: translateY(0); } 
        }
        .animate-fade-up { animation: fade-up 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
    </style>
</head>

<body class="antialiased selection:bg-indigo-100">

    {{-- 1. Navigation --}}
    <nav class="glass sticky top-0 z-50 border-b border-slate-200/60">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex justify-between items-center">
            <a href="/" class="flex items-center gap-2.5 group">
                <div class="w-9 h-9 bg-indigo-600 rounded-xl flex items-center justify-center shadow-lg shadow-indigo-200 group-hover:bg-indigo-700 transition-all">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                </div>
                <span class="font-bold text-xl tracking-tight text-slate-900">TaskNest</span>
            </a>

            <div class="flex items-center gap-6">
                @guest
                    <a href="{{ route('login') }}" class="text-sm font-semibold text-slate-600 hover:text-indigo-600 transition-colors">Login</a>
                    <a href="{{ route('register') }}" class="bg-slate-900 text-white px-5 py-2.5 rounded-full text-sm font-bold hover:bg-indigo-600 transition-all shadow-md active:scale-95">Get Started</a>
                @endguest

                @auth
                    <div class="flex items-center gap-4 bg-white px-4 py-1.5 rounded-full border border-slate-200 shadow-sm">
                        <span class="text-sm font-bold text-slate-700">{{ Auth::user()->name }}</span>
                        <form action="{{ route('logout') }}" method="POST" class="inline border-l border-slate-100 pl-3">
                            @csrf
                            <button type="submit" class="text-slate-400 hover:text-red-500 transition-colors pt-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7"/></svg>
                            </button>
                        </form>
                    </div>
                @endauth
            </div>
        </div>
    </nav>

    {{-- 2. HOMEPAGE VIEW --}}
    @if(Request::is('/'))
        <div class="relative overflow-hidden bg-gradient-to-br from-slate-50 via-white to-indigo-50">
        
        {{-- Background Effects --}}
        <div class="absolute inset-0 bg-hero-grid opacity-50"></div>

        <div class="absolute top-0 left-0 w-[500px] h-[500px] bg-indigo-200/30 blur-3xl rounded-full"></div>
        <div class="absolute bottom-0 right-0 w-[450px] h-[450px] bg-purple-200/30 blur-3xl rounded-full"></div>

        {{-- Hero Section --}}
        <header class="relative max-w-7xl mx-auto px-4 pt-24 pb-28 grid grid-cols-1 lg:grid-cols-2 gap-20 items-center">
            
            {{-- Left Content --}}
            <div class="animate-fade-up">
                
                <div class="inline-flex items-center gap-2 bg-indigo-100 text-indigo-700 px-4 py-2 rounded-full text-xs font-bold uppercase tracking-wider mb-6 shadow-sm">
                    <span class="w-2 h-2 bg-indigo-600 rounded-full animate-pulse"></span>
                    Smart Workflow Platform
                </div>

                <h1 class="text-5xl md:text-7xl font-black text-slate-900 leading-[1.05] tracking-tight mb-8">
                    Manage your <br>
                    projects with <br>
                    <span class="hero-text">clarity & speed</span>
                </h1>

                <p class="text-lg text-slate-500 leading-relaxed max-w-xl mb-10">
                    TaskNest helps teams organize projects, assign tasks, track progress, 
                    and collaborate seamlessly with modern workflow automation and real-time updates.
                </p>

                {{-- Stats --}}
                <div class="flex flex-wrap gap-8 mb-10">
                    <div>
                        <h3 class="text-3xl font-black text-slate-900">10K+</h3>
                        <p class="text-sm text-slate-500 font-medium">Tasks Managed</p>
                    </div>

                    <div>
                        <h3 class="text-3xl font-black text-slate-900">98%</h3>
                        <p class="text-sm text-slate-500 font-medium">Client Satisfaction</p>
                    </div>

                    <div>
                        <h3 class="text-3xl font-black text-slate-900">24/7</h3>
                        <p class="text-sm text-slate-500 font-medium">Realtime Sync</p>
                    </div>
                </div>

                {{-- CTA Buttons --}}
                <div class="flex flex-wrap items-center gap-4">
                    <a href="{{ route('register') }}"
                       class="px-8 py-4 bg-slate-900 text-white rounded-2xl font-bold shadow-2xl hover:bg-indigo-600 hover:-translate-y-1 transition-all duration-300 active:scale-95">
                        Start Managing
                    </a>

                    <a href="#features"
                       class="px-8 py-4 bg-white border border-slate-200 text-slate-700 rounded-2xl font-semibold hover:border-indigo-300 hover:text-indigo-600 transition-all shadow-sm">
                        Explore Features
                    </a>
                </div>
            </div>

            {{-- Right Dashboard UI --}}
            <div class="relative hidden lg:flex items-center justify-center h-[650px]">

                {{-- Main Dashboard Card --}}
                <div class="glass w-[430px] rounded-[2.5rem] p-8 shadow-[0_25px_80px_rgba(15,23,42,0.12)] border border-white/40 animate-float">
                    
                    {{-- Top --}}
                    <div class="flex items-center justify-between mb-8">
                        <div>
                            <h3 class="text-lg font-black text-slate-900">Project Overview</h3>
                            <p class="text-sm text-slate-400">Weekly productivity report</p>
                        </div>

                        <div class="w-12 h-12 rounded-2xl bg-indigo-600 flex items-center justify-center shadow-lg shadow-indigo-200">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M9 17v-6m4 6V7m4 10V4"/>
                            </svg>
                        </div>
                    </div>

                    {{-- Chart Bars --}}
                    <div class="space-y-5 mb-8">
                        
                        <div>
                            <div class="flex justify-between mb-2">
                                <span class="text-sm font-semibold text-slate-600">UI Design</span>
                                <span class="text-sm font-bold text-indigo-600">92%</span>
                            </div>

                            <div class="w-full h-3 bg-slate-100 rounded-full overflow-hidden">
                                <div class="h-full w-[92%] bg-gradient-to-r from-indigo-500 to-purple-500 rounded-full"></div>
                            </div>
                        </div>

                        <div>
                            <div class="flex justify-between mb-2">
                                <span class="text-sm font-semibold text-slate-600">Backend API</span>
                                <span class="text-sm font-bold text-emerald-500">81%</span>
                            </div>

                            <div class="w-full h-3 bg-slate-100 rounded-full overflow-hidden">
                                <div class="h-full w-[81%] bg-gradient-to-r from-emerald-400 to-emerald-600 rounded-full"></div>
                            </div>
                        </div>

                        <div>
                            <div class="flex justify-between mb-2">
                                <span class="text-sm font-semibold text-slate-600">Deployment</span>
                                <span class="text-sm font-bold text-orange-500">64%</span>
                            </div>

                            <div class="w-full h-3 bg-slate-100 rounded-full overflow-hidden">
                                <div class="h-full w-[64%] bg-gradient-to-r from-orange-400 to-orange-500 rounded-full"></div>
                            </div>
                        </div>
                    </div>

                    {{-- Team Members --}}
                    <div class="bg-slate-50 rounded-3xl p-5 border border-slate-100">
                        <div class="flex items-center justify-between mb-5">
                            <h4 class="font-bold text-slate-800">Team Collaboration</h4>
                            <span class="text-xs font-bold text-emerald-600 bg-emerald-100 px-3 py-1 rounded-full">
                                Active
                            </span>
                        </div>

                        <div class="space-y-4">
                            
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <img src="https://i.pravatar.cc/100?img=11"
                                         class="w-11 h-11 rounded-2xl border-2 border-white shadow-md">

                                    <div>
                                        <h5 class="text-sm font-bold text-slate-800">Sarah Johnson</h5>
                                        <p class="text-xs text-slate-400">Frontend Developer</p>
                                    </div>
                                </div>

                                <span class="text-xs font-bold text-indigo-600">Online</span>
                            </div>

                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <img src="https://i.pravatar.cc/100?img=12"
                                         class="w-11 h-11 rounded-2xl border-2 border-white shadow-md">

                                    <div>
                                        <h5 class="text-sm font-bold text-slate-800">Michael Lee</h5>
                                        <p class="text-xs text-slate-400">Backend Engineer</p>
                                    </div>
                                </div>

                                <span class="text-xs font-bold text-emerald-600">Reviewing</span>
                            </div>

                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <img src="https://i.pravatar.cc/100?img=13"
                                         class="w-11 h-11 rounded-2xl border-2 border-white shadow-md">

                                    <div>
                                        <h5 class="text-sm font-bold text-slate-800">Emily Watson</h5>
                                        <p class="text-xs text-slate-400">Project Manager</p>
                                    </div>
                                </div>

                                <span class="text-xs font-bold text-orange-500">Pending</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Floating Card 1 --}}
                <div class="absolute top-8 -left-6 glass rounded-3xl p-5 shadow-xl animate-float delay-1">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-2xl bg-indigo-100 flex items-center justify-center">
                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 8c-1.657 0-3 1.343-3 3s1.343 3 3 3 3-1.343 3-3-1.343-3-3-3z"/>
                            </svg>
                        </div>

                        <div>
                            <h4 class="font-black text-slate-800">124+</h4>
                            <p class="text-xs text-slate-400 font-medium">Tasks Completed</p>
                        </div>
                    </div>
                </div>

                {{-- Floating Card 2 --}}
                <div class="absolute bottom-10 -right-8 glass rounded-3xl p-5 shadow-xl animate-float">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-2xl bg-emerald-100 flex items-center justify-center">
                            <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>

                        <div>
                            <h4 class="font-black text-slate-800">Realtime</h4>
                            <p class="text-xs text-slate-400 font-medium">Task Synchronization</p>
                        </div>
                    </div>
                </div>

            </div>
        </header>
    </div>

    {{-- Features Section --}}
    <section id="features" class="relative py-24 bg-white overflow-hidden">
        
        <div class="absolute inset-0 bg-gradient-to-b from-white to-slate-50"></div>

        <div class="relative max-w-7xl mx-auto px-4">
            
            {{-- Section Heading --}}
            <div class="text-center mb-20">
                <div class="inline-flex items-center gap-2 bg-indigo-100 text-indigo-700 px-4 py-2 rounded-full text-xs font-bold uppercase tracking-wider mb-6">
                    Advanced Features
                </div>

                <h2 class="text-5xl font-black text-slate-900 mb-6 tracking-tight">
                    Everything your team needs
                </h2>

                <p class="max-w-2xl mx-auto text-lg text-slate-500 leading-relaxed">
                    Powerful workflow tools designed for startups, enterprises, and modern remote teams.
                </p>
            </div>

            {{-- Feature Cards --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                
                {{-- Card --}}
                <div class="bg-white border border-slate-200 rounded-[2rem] p-8 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-500">
                    <div class="w-14 h-14 rounded-2xl bg-indigo-100 flex items-center justify-center mb-6">
                        <svg class="w-7 h-7 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M9 17v-2m3 2v-4m3 4v-6"/>
                        </svg>
                    </div>

                    <h3 class="text-xl font-black text-slate-900 mb-3">
                        Smart Analytics
                    </h3>

                    <p class="text-slate-500 leading-relaxed">
                        Monitor productivity, deadlines, and performance using realtime visual insights.
                    </p>
                </div>

                {{-- Card --}}
                <div class="bg-white border border-slate-200 rounded-[2rem] p-8 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-500">
                    <div class="w-14 h-14 rounded-2xl bg-purple-100 flex items-center justify-center mb-6">
                        <svg class="w-7 h-7 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M17 20h5V4H2v16h5"/>
                        </svg>
                    </div>

                    <h3 class="text-xl font-black text-slate-900 mb-3">
                        Team Management
                    </h3>

                    <p class="text-slate-500 leading-relaxed">
                        Assign roles, manage permissions, and collaborate efficiently with your team.
                    </p>
                </div>

                {{-- Card --}}
                <div class="bg-white border border-slate-200 rounded-[2rem] p-8 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-500">
                    <div class="w-14 h-14 rounded-2xl bg-emerald-100 flex items-center justify-center mb-6">
                        <svg class="w-7 h-7 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 8v4l3 3"/>
                        </svg>
                    </div>

                    <h3 class="text-xl font-black text-slate-900 mb-3">
                        Realtime Updates
                    </h3>

                    <p class="text-slate-500 leading-relaxed">
                        Receive instant updates on tasks, milestones, and project activities.
                    </p>
                </div>

            </div>
        </div>
    </section>

    {{-- 3. INNER PAGES VIEW (Login, Register, etc.) --}}
    @else
        <main class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <div class="animate-fade-up">
                {{-- For Login/Register, you can wrap them in a centered div in their own files --}}
                @yield('content')
            </div>
        </main>
    @endif

    {{-- 4. Unified Footer --}}
    <footer class="border-t border-slate-200 bg-white py-12">
        <div class="max-w-7xl mx-auto px-4 flex flex-col md:flex-row justify-between items-center gap-8">
            <p class="text-slate-400 text-[10px] font-bold uppercase tracking-widest leading-none">&copy; {{ date('Y') }} TaskNest &bull; Build for the future.</p>
        </div>
    </footer>

</body>
</html>