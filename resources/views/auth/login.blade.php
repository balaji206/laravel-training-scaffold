@extends('layouts.app')

@section('content')

<div style="
    max-width: 450px;
    margin: 80px auto;
    background: white;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 0 15px rgba(0,0,0,0.1);
">

    <h1 style="
        font-size: 32px;
        font-weight: bold;
        margin-bottom: 10px;
    ">
        Welcome Back 👋
    </h1>

    <p style="
        color: gray;
        margin-bottom: 30px;
    ">
        Login to continue managing your projects
    </p>

    @if(session('status'))
        <div style="color: green; margin-bottom: 15px;">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        {{-- Email --}}
        <div style="margin-bottom: 20px;">
            <label>Email Address</label>

            <input
                type="email"
                name="email"
                value="{{ old('email') }}"
                required
                autofocus
                style="
                    width: 100%;
                    padding: 10px;
                    margin-top: 8px;
                    border: 1px solid #ccc;
                    border-radius: 8px;
                "
            >

            @error('email')
                <p style="color:red; margin-top:5px;">
                    {{ $message }}
                </p>
            @enderror
        </div>

        {{-- Password --}}
        <div style="margin-bottom: 20px;">
            <label>Password</label>

            <input
                type="password"
                name="password"
                required
                style="
                    width: 100%;
                    padding: 10px;
                    margin-top: 8px;
                    border: 1px solid #ccc;
                    border-radius: 8px;
                "
            >

            @error('password')
                <p style="color:red; margin-top:5px;">
                    {{ $message }}
                </p>
            @enderror
        </div>

        {{-- Remember --}}
        <div style="margin-bottom: 20px;">
            <input type="checkbox" name="remember">

            <label>Remember me</label>
        </div>

        <div style="
            display:flex;
            justify-content:space-between;
            align-items:center;
        ">

            <a href="{{ route('password.request') }}">
                Forgot Password?
            </a>

            <button
                type="submit"
                style="
                    background:#4f46e5;
                    color:white;
                    border:none;
                    padding:10px 20px;
                    border-radius:8px;
                    cursor:pointer;
                "
            >
                Log in
            </button>

        </div>

    </form>

</div>

@endsection