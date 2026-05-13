@extends('layouts.app')

@section('content')

<div style="
    min-height: 100vh;
    background: linear-gradient(to bottom right, #eef2ff, #ffffff, #f5f3ff);
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 40px 20px;
">

    <div style="
        width: 100%;
        max-width: 500px;
        background: white;
        border-radius: 24px;
        padding: 40px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.08);
        border: 1px solid #e5e7eb;
    ">

        {{-- Brand --}}
        <div style="text-align:center; margin-bottom:35px;">

            <h1 style="
                font-size: 42px;
                font-weight: 800;
                color: #4f46e5;
                margin-bottom: 10px;
            ">
                TaskNest
            </h1>

            <p style="
                color: #64748b;
                font-size: 15px;
                line-height: 1.6;
            ">
                Reset your password and continue managing your projects.
            </p>

        </div>

        {{-- Header --}}
        <div style="margin-bottom:30px;">

            <h2 style="
                font-size: 30px;
                font-weight: bold;
                color: #0f172a;
                margin-bottom: 10px;
            ">
                Forgot Password
            </h2>

            <p style="
                color: #64748b;
                line-height: 1.6;
            ">
                Enter your email address and we’ll send you a password reset link.
            </p>

        </div>

        {{-- Success Message --}}
        @if(session('status'))
            <div style="
                background: #ecfdf5;
                color: #047857;
                border: 1px solid #a7f3d0;
                padding: 14px 16px;
                border-radius: 12px;
                margin-bottom: 20px;
                font-size: 14px;
            ">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            {{-- Email --}}
            <div style="margin-bottom:25px;">

                <label style="
                    display:block;
                    font-weight:600;
                    color:#334155;
                    margin-bottom:10px;
                ">
                    Email Address
                </label>

                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                    placeholder="Enter your email"
                    style="
                        width:100%;
                        padding:14px 16px;
                        border:1px solid #d1d5db;
                        border-radius:14px;
                        font-size:15px;
                        outline:none;
                        transition:0.3s;
                        box-sizing:border-box;
                    "
                    onfocus="this.style.borderColor='#4f46e5'"
                    onblur="this.style.borderColor='#d1d5db'"
                >

                @error('email')
                    <p style="
                        color:red;
                        margin-top:8px;
                        font-size:14px;
                    ">
                        {{ $message }}
                    </p>
                @enderror

            </div>

            {{-- Button --}}
            <button
                type="submit"
                style="
                    width:100%;
                    background:#4f46e5;
                    color:white;
                    border:none;
                    padding:14px;
                    border-radius:16px;
                    font-size:15px;
                    font-weight:600;
                    cursor:pointer;
                    transition:0.3s;
                    box-shadow:0 10px 20px rgba(79,70,229,0.25);
                "
                onmouseover="this.style.background='#4338ca'"
                onmouseout="this.style.background='#4f46e5'"
            >
                Email Password Reset Link
            </button>

        </form>

        {{-- Footer --}}
        <p style="
            text-align:center;
            color:#94a3b8;
            font-size:13px;
            margin-top:30px;
        ">
            © {{ date('Y') }} TaskNest. All rights reserved.
        </p>

    </div>

</div>

@endsection