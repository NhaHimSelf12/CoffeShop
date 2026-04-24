@extends('layouts.app')

@section('content')
    <div class="login-wrap">

        {{-- LEFT PANEL --}}
        <div class="login-left">
            <div class="glow g1"></div>
            <div class="glow g2"></div>

            <div class="left-top">
                <div class="logo-row">
                    <div class="logo-icon">
                        <svg viewBox="0 0 24 24" fill="none">
                            <path d="M4 8h13l-2 9H6L4 8z" fill="white" opacity=".9" />
                            <path d="M17 10h2a2 2 0 010 4h-2" stroke="white" stroke-width="1.5" stroke-linecap="round" />
                            <path d="M9 6c0-1.5 2-2 2-4M12 5.5c0-1.5 2-2 2-4" stroke="white" stroke-width="1.3"
                                stroke-linecap="round" opacity=".6" />
                        </svg>
                    </div>
                    <span class="logo-text">PosCoffe</span>
                </div>

                <h1 class="headline">Start managing<br>your cafe <span>today</span></h1>
                <p class="sub-text">Create your workspace in minutes and get full access to all PosCoffe tools.</p>

                <div class="step-list">
                    <div class="step">
                        <div class="step-num">1</div>
                        <div class="step-info">
                            <div class="step-title">Create your account</div>
                            <div class="step-desc">Fill in your details to register</div>
                        </div>
                    </div>
                    <div class="step">
                        <div class="step-num">2</div>
                        <div class="step-info">
                            <div class="step-title">Set up your workspace</div>
                            <div class="step-desc">Configure branches, staff &amp; menu</div>
                        </div>
                    </div>
                    <div class="step">
                        <div class="step-num">3</div>
                        <div class="step-info">
                            <div class="step-title">Start selling</div>
                            <div class="step-desc">Accept orders and track revenue live</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="left-bottom">
                <blockquote>
                    "Setting up took less than 10 minutes. Now I manage 3 branches from one screen."
                </blockquote>
                <div class="tester-row">
                    <div class="avatar">SR</div>
                    <span class="tester-name">Sophea R. — Café Owner, Phnom Penh</span>
                </div>
            </div>
        </div>

        {{-- RIGHT PANEL --}}
        <div class="login-right">
            <div class="form-box">
                <p class="eyebrow">New Account</p>
                <h2 class="form-heading">Create your workspace</h2>
                <p class="form-desc">Join thousands of cafes already using PosCoffe</p>

                <form action="{{ route('register') }}" method="POST">
                    @csrf

                    {{-- Full Name --}}
                    <div class="field">
                        <label for="name" class="flabel">Full name</label>
                        <div class="input-wrap @error('name') is-error @enderror">
                            <span class="iico">
                                <svg fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 20 20">
                                    <circle cx="10" cy="7" r="3" />
                                    <path d="M3.5 17c0-3 3-5 6.5-5s6.5 2 6.5 5" stroke-linecap="round" />
                                </svg>
                            </span>
                            <input class="inp" type="text" name="name" id="name" placeholder="Your full name"
                                value="{{ old('name') }}" autocomplete="name" required autofocus>
                        </div>
                        @error('name')
                            <p class="field-error">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="field">
                        <label for="email" class="flabel">Email address</label>
                        <div class="input-wrap @error('email') is-error @enderror">
                            <span class="iico">
                                <svg fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 20 20">
                                    <path
                                        d="M2.5 5.5h15a.8.8 0 01.8.8v8a.8.8 0 01-.8.8h-15a.8.8 0 01-.8-.8v-8a.8.8 0 01.8-.8z" />
                                    <path d="M3 6.5l7 5 7-5" />
                                </svg>
                            </span>
                            <input class="inp" type="email" name="email" id="email" placeholder="your@email.com"
                                value="{{ old('email') }}" autocomplete="email" required>
                        </div>
                        @error('email')
                            <p class="field-error">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div class="field">
                        <label for="password" class="flabel">Password</label>
                        <div class="input-wrap @error('password') is-error @enderror">
                            <span class="iico">
                                <svg fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 20 20">
                                    <rect x="4" y="9" width="12" height="8.5" rx="1.5" />
                                    <path d="M7.5 9V6.5a2.5 2.5 0 015 0V9" />
                                    <circle cx="10" cy="13" r="1.2" fill="currentColor" />
                                </svg>
                            </span>
                            <input class="inp" type="password" name="password" id="password" placeholder="Min. 8 characters"
                                autocomplete="new-password" oninput="checkPw(this.value)" required>
                            <button type="button" class="eye-btn" onclick="togglePw('password', 'eye1a', 'eye1b')">
                                <svg id="eye1a" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 20 20">
                                    <ellipse cx="10" cy="10" rx="8" ry="5" />
                                    <circle cx="10" cy="10" r="2" />
                                </svg>
                                <svg id="eye1b" style="display:none" fill="none" stroke="currentColor" stroke-width="1.6"
                                    viewBox="0 0 20 20">
                                    <path
                                        d="M3 3l14 14M8.5 8.7a2.5 2.5 0 003.8 3.2M5.5 5.8C3.8 7 2.5 8.7 2 10c1 2.2 4.2 6 8 6a8 8 0 003.5-.9M11 4.2A8 8 0 0118 10c-.5.9-1.3 2-2.5 3" />
                                </svg>
                            </button>
                        </div>
                        <div class="pw-strength">
                            <div class="pw-bar" id="b1"></div>
                            <div class="pw-bar" id="b2"></div>
                            <div class="pw-bar" id="b3"></div>
                            <div class="pw-bar" id="b4"></div>
                        </div>
                        @error('password')
                            <p class="field-error">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Confirm Password --}}
                    <div class="field">
                        <label for="password_confirmation" class="flabel">Confirm password</label>
                        <div class="input-wrap">
                            <span class="iico">
                                <svg fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 20 20">
                                    <rect x="4" y="9" width="12" height="8.5" rx="1.5" />
                                    <path d="M7.5 9V6.5a2.5 2.5 0 015 0V9" />
                                    <circle cx="10" cy="13" r="1.2" fill="currentColor" />
                                </svg>
                            </span>
                            <input class="inp" type="password" name="password_confirmation" id="password_confirmation"
                                placeholder="Re-enter password" autocomplete="new-password" required>
                            <button type="button" class="eye-btn"
                                onclick="togglePw('password_confirmation', 'eye2a', 'eye2b')">
                                <svg id="eye2a" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 20 20">
                                    <ellipse cx="10" cy="10" rx="8" ry="5" />
                                    <circle cx="10" cy="10" r="2" />
                                </svg>
                                <svg id="eye2b" style="display:none" fill="none" stroke="currentColor" stroke-width="1.6"
                                    viewBox="0 0 20 20">
                                    <path
                                        d="M3 3l14 14M8.5 8.7a2.5 2.5 0 003.8 3.2M5.5 5.8C3.8 7 2.5 8.7 2 10c1 2.2 4.2 6 8 6a8 8 0 003.5-.9M11 4.2A8 8 0 0118 10c-.5.9-1.3 2-2.5 3" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <button type="submit" class="btn-submit">
                        Create account
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 20 20">
                            <path d="M4 10h12M11 6l4 4-4 4" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>
                </form>

                <div class="signup-row">
                    Already have an account?
                    <a href="{{ route('login') }}" class="signup-link">Sign in</a>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('styles')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');

        * {
            box-sizing: border-box;
        }

        :root {
            --dark: #0c1117;
            --dark2: #1e293b;
            --amber: #d97706;
            --amberh: #b45309;
            --text: #111827;
            --muted: #6b7280;
            --light: #9ca3af;
            --border: #e5e7eb;
            --surf: #fafafa;
            --sans: 'Plus Jakarta Sans', system-ui, sans-serif;
        }

        body {
            font-family: var(--sans);
        }

        .login-wrap {
            display: flex;
            min-height: 100vh;
        }

        /* ── Left ── */
        .login-left {
            width: 420px;
            flex-shrink: 0;
            background: var(--dark);
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 48px 44px;
        }

        .glow {
            position: absolute;
            border-radius: 50%;
            pointer-events: none;
        }

        .g1 {
            width: 360px;
            height: 360px;
            background: radial-gradient(circle, rgba(217, 119, 6, .14) 0%, transparent 70%);
            top: -80px;
            right: -100px;
        }

        .g2 {
            width: 240px;
            height: 240px;
            background: radial-gradient(circle, rgba(217, 119, 6, .07) 0%, transparent 70%);
            bottom: 60px;
            left: -60px;
        }

        .logo-row {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 48px;
            position: relative;
            z-index: 2;
        }

        .logo-icon {
            width: 36px;
            height: 36px;
            background: var(--amber);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .logo-icon svg {
            width: 20px;
            height: 20px;
        }

        .logo-text {
            font-size: 15px;
            font-weight: 700;
            color: #fff;
            letter-spacing: -.01em;
        }

        .headline {
            font-size: 30px;
            font-weight: 700;
            color: #fff;
            line-height: 1.2;
            letter-spacing: -.03em;
            margin-bottom: 12px;
            position: relative;
            z-index: 2;
        }

        .headline span {
            color: var(--amber);
        }

        .sub-text {
            font-size: 13px;
            color: #475569;
            line-height: 1.75;
            max-width: 280px;
            margin-bottom: 28px;
            position: relative;
            z-index: 2;
        }

        .step-list {
            display: flex;
            flex-direction: column;
            gap: 16px;
            position: relative;
            z-index: 2;
        }

        .step {
            display: flex;
            align-items: flex-start;
            gap: 12px;
        }

        .step-num {
            width: 22px;
            height: 22px;
            border-radius: 50%;
            background: rgba(217, 119, 6, .15);
            border: 1px solid rgba(217, 119, 6, .3);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            font-weight: 700;
            color: var(--amber);
            flex-shrink: 0;
            margin-top: 1px;
        }

        .step-title {
            font-size: 12px;
            font-weight: 600;
            color: #94a3b8;
            margin-bottom: 2px;
        }

        .step-desc {
            font-size: 11.5px;
            color: #475569;
            line-height: 1.5;
        }

        .left-bottom {
            position: relative;
            z-index: 2;
            padding-top: 32px;
            border-top: 1px solid #1e2a35;
        }

        .left-bottom blockquote {
            font-size: 12.5px;
            color: #475569;
            line-height: 1.75;
            font-style: italic;
            margin-bottom: 12px;
        }

        .tester-row {
            display: flex;
            align-items: center;
            gap: 9px;
        }

        .avatar {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background: #1e3a2f;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            font-weight: 700;
            color: #4ade80;
            flex-shrink: 0;
        }

        .tester-name {
            font-size: 11.5px;
            color: #475569;
            font-weight: 500;
        }

        /* ── Right ── */
        .login-right {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 48px 40px;
            background: #fff;
        }

        .form-box {
            width: 100%;
            max-width: 360px;
        }

        .eyebrow {
            font-size: 11px;
            font-weight: 600;
            letter-spacing: .1em;
            text-transform: uppercase;
            color: var(--amber);
            margin-bottom: 8px;
        }

        .form-heading {
            font-size: 26px;
            font-weight: 700;
            color: var(--dark);
            letter-spacing: -.03em;
            margin-bottom: 4px;
        }

        .form-desc {
            font-size: 13px;
            color: var(--light);
            margin-bottom: 28px;
        }

        .field {
            display: flex;
            flex-direction: column;
            gap: 5px;
            margin-bottom: 14px;
        }

        .flabel {
            font-size: 11.5px;
            font-weight: 600;
            color: #374151;
            letter-spacing: .01em;
        }

        .input-wrap {
            display: flex;
            align-items: center;
            border: 1.5px solid var(--border);
            border-radius: 8px;
            background: var(--surf);
            transition: border-color .15s, background .15s, box-shadow .15s;
            overflow: hidden;
        }

        .input-wrap:focus-within {
            border-color: var(--amber);
            background: #fff;
            box-shadow: 0 0 0 3px rgba(217, 119, 6, .08);
        }

        .input-wrap.is-error {
            border-color: #ef4444;
        }

        .iico {
            display: flex;
            align-items: center;
            padding: 0 10px 0 13px;
            color: #9ca3af;
            flex-shrink: 0;
        }

        .iico svg {
            width: 15px;
            height: 15px;
        }

        .inp {
            flex: 1;
            border: none;
            outline: none;
            background: transparent;
            padding: 11px 10px 11px 0;
            font-family: var(--sans);
            font-size: 13.5px;
            color: var(--text);
        }

        .inp::placeholder {
            color: #d1d5db;
        }

        .eye-btn {
            background: none;
            border: none;
            cursor: pointer;
            padding: 0 11px;
            color: #9ca3af;
            display: flex;
            align-items: center;
            transition: color .15s;
        }

        .eye-btn:hover {
            color: #6b7280;
        }

        .eye-btn svg {
            width: 15px;
            height: 15px;
        }

        .field-error {
            font-size: 11.5px;
            color: #ef4444;
            margin-top: 2px;
        }

        /* Password strength */
        .pw-strength {
            display: flex;
            gap: 4px;
            margin-top: 6px;
        }

        .pw-bar {
            flex: 1;
            height: 3px;
            border-radius: 2px;
            background: #f1f5f9;
            transition: background .3s;
        }

        .pw-bar.w {
            background: #f59e0b;
        }

        .pw-bar.m {
            background: #3b82f6;
        }

        .pw-bar.s {
            background: #22c55e;
        }

        /* Submit */
        .btn-submit {
            width: 100%;
            background: var(--dark);
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 13px 16px;
            font-family: var(--sans);
            font-size: 13.5px;
            font-weight: 600;
            cursor: pointer;
            letter-spacing: .01em;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: background .2s, transform .1s;
            margin-top: 4px;
        }

        .btn-submit:hover {
            background: var(--dark2);
        }

        .btn-submit:active {
            transform: scale(.99);
        }

        .btn-submit svg {
            width: 15px;
            height: 15px;
            transition: transform .2s;
        }

        .btn-submit:hover svg {
            transform: translateX(3px);
        }

        .signup-row {
            margin-top: 22px;
            text-align: center;
            font-size: 12.5px;
            color: var(--light);
        }

        .signup-link {
            color: var(--amber);
            font-weight: 700;
            text-decoration: none;
            margin-left: 4px;
            transition: color .15s;
        }

        .signup-link:hover {
            color: var(--amberh);
        }

        @media (max-width: 900px) {
            .login-left {
                display: none;
            }

            .login-right {
                background: #f8fafc;
            }
        }
    </style>

    <script>
        function togglePw(id, showId, hideId) {
            var i = document.getElementById(id);
            var s = document.getElementById(showId);
            var h = document.getElementById(hideId);
            if (i.type === 'password') { i.type = 'text'; s.style.display = 'none'; h.style.display = 'block'; }
            else { i.type = 'password'; s.style.display = 'block'; h.style.display = 'none'; }
        }
        function checkPw(v) {
            var bars = ['b1', 'b2', 'b3', 'b4'].map(function (id) { return document.getElementById(id); });
            var score = 0;
            if (v.length >= 6) score++;
            if (v.length >= 10) score++;
            if (/[A-Z]/.test(v) && /[0-9]/.test(v)) score++;
            if (/[^A-Za-z0-9]/.test(v)) score++;
            var cls = score <= 1 ? 'w' : score <= 2 ? 'm' : 's';
            bars.forEach(function (b, i) { b.className = 'pw-bar' + (i < score ? ' ' + cls : ''); });
        }
    </script>
@endsection