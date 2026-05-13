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
        max-width: 550px;
        background: white;
        border-radius: 24px;
        padding: 45px;
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
                Verify your email address to activate your account.
            </p>

        </div>

        {{-- Header --}}
        <div style="margin-bottom:30px;">

            <h2 style="
                font-size: 30px;
                font-weight: bold;
                color: #0f172a;
                margin-bottom: 12px;
            ">
                Email Verification
            </h2>

            <p style="
                color: #64748b;
                line-height: 1.8;
                font-size: 15px;
            ">
                Thanks for signing up! Before getting started, please verify your
                email address by clicking the link we just emailed to you.
                If you didn’t receive the email, we’ll gladly send another one.
            </p>

        </div>

        {{-- Success Message --}}
        @if (session('status') == 'verification-link-sent')

            <div style="
                background: #ecfdf5;
                color: #047857;
                border: 1px solid #a7f3d0;
                padding: 14px 16px;
                border-radius: 12px;
                margin-bottom: 24px;
                font-size: 14px;
            ">
                A new verification link has been sent to your email address.
            </div>

        @endif

        {{-- Actions --}}
        <div style="
            display:flex;
            justify-content:space-between;
            align-items:center;
            gap:16px;
            flex-wrap:wrap;
        ">

            {{-- Resend Verification --}}
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <button
                    type="submit"
                    style="
                        background:#4f46e5;
                        color:white;
                        border:none;
                        padding:14px 24px;
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
                    Resend Verification Email
                </button>

            </form>

            {{-- Logout --}}
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button
                    type="submit"
                    style="
                        background:transparent;
                        border:none;
                        color:#64748b;
                        font-size:15px;
                        font-weight:600;
                        cursor:pointer;
                        transition:0.3s;
                    "
                    onmouseover="this.style.color='#0f172a'"
                    onmouseout="this.style.color='#64748b'"
                >
                    Log Out
                </button>

            </form>

        </div>

        {{-- Footer --}}
        <p style="
            text-align:center;
            color:#94a3b8;
            font-size:13px;
            margin-top:35px;
        ">
            © {{ date('Y') }} TaskNest. All rights reserved.
        </p>

    </div>

</div>

@endsection