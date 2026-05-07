<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    {{-- Tailwind CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Vite --}}
    @vite(['resources/js/app.js'])
</head>

<body class="bg-gray-100">

    {{-- Navigation --}}
    <nav class="bg-white shadow p-4 flex justify-between">
        
        <a href="/projects" class="font-bold text-lg">
            {{ config('app.name', 'Laravel') }}
        </a>

        <div>
            @guest
                <a href="{{ route('login') }}" class="mr-4 text-blue-600">
                    Login
                </a>

                <a href="{{ route('register') }}" class="text-blue-600">
                    Register
                </a>
            @endguest

            @auth
                <span class="mr-4">
                    {{ Auth::user()->name }}
                </span>

                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf

                    <button type="submit" class="text-red-500">
                        Logout
                    </button>
                </form>
            @endauth
        </div>

    </nav>

    {{-- Main Content --}}
    <main class="p-6">
        @yield('content')
    </main>

</body>
</html>