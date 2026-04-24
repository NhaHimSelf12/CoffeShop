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

                <h1 class="headline">{{ __('auth.manage_cafe') }}</h1>
                <p class="sub-text">{{ __('auth.pos_description') }}</p>

                <ul class="feature-list">
                    <li>{{ __('auth.features.real_time') }}</li>
                    <li>{{ __('auth.features.multi_branch') }}</li>
                    <li>{{ __('auth.features.staff') }}</li>
                    <li>{{ __('auth.features.analytics') }}</li>
                </ul>
            </div>

            <div class="left-bottom">
                <blockquote>
                    "PosCoffe transformed how we run our 3 branches. We went from chaos to clarity in a week."
                </blockquote>
                <div class="tester-row">
                    <div class="avatar">CN</div>
                    <span class="tester-name">CoffeCounner</span>
                </div>
            </div>
        </div>

        {{-- RIGHT PANEL --}}
        <div class="login-right">
            <div class="form-box">
                <p class="eyebrow">{{ __('auth.workspace_access') }}</p>
                <h2 class="form-heading">{{ __('auth.welcome_back') }}</h2>
                <p class="form-desc">{{ __('auth.enter_credentials') }}</p>

                <form action="{{ route('login') }}" method="POST">
                    @csrf

                    <div class="field">
                        <label for="email" class="flabel">{{ __('auth.email_address') }}</label>
                        <div class="input-wrap @error('email') is-error @enderror">
                            <span class="iico">
                                <svg fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 20 20">
                                    <path
                                        d="M2.5 5.5h15a.8.8 0 01.8.8v8a.8.8 0 01-.8.8h-15a.8.8 0 01-.8-.8v-8a.8.8 0 01.8-.8z" />
                                    <path d="M3 6.5l7 5 7-5" />
                                </svg>
                            </span>
                            <input class="inp" type="email" name="email" id="email" placeholder="your@email.com"
                                value="{{ old('email') }}" autocomplete="email" required autofocus>
                        </div>
                        @error('email')
                            <p class="field-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="field">
                        <label for="password" class="flabel">{{ __('auth.password') }}</label>
                        <div class="input-wrap @error('password') is-error @enderror">
                            <span class="iico">
                                <svg fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 20 20">
                                    <rect x="4" y="9" width="12" height="8.5" rx="1.5" />
                                    <path d="M7.5 9V6.5a2.5 2.5 0 015 0V9" />
                                    <circle cx="10" cy="13" r="1.2" fill="currentColor" />
                                </svg>
                            </span>
                            <input class="inp" type="password" name="password" id="password" placeholder="••••••••"
                                autocomplete="current-password" required>
                            <button type="button" class="eye-btn" onclick="togglePw()">
                                <svg id="eye-show" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 20 20">
                                    <ellipse cx="10" cy="10" rx="8" ry="5" />
                                    <circle cx="10" cy="10" r="2" />
                                </svg>
                                <svg id="eye-hide" style="display:none" fill="none" stroke="currentColor" stroke-width="1.6"
                                    viewBox="0 0 20 20">
                                    <path
                                        d="M3 3l14 14M8.5 8.7a2.5 2.5 0 003.8 3.2M5.5 5.8C3.8 7 2.5 8.7 2 10c1 2.2 4.2 6 8 6a8 8 0 003.5-.9M11 4.2A8 8 0 0118 10c-.5.9-1.3 2-2.5 3" />
                                </svg>
                            </button>
                        </div>
                        @error('password')
                            <p class="field-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="meta-row">
                        <label class="check-row">
                            <input type="checkbox" name="remember" class="sr-only">
                            <div class="cb" onclick="this.classList.toggle('on')"></div>
                            <span>{{ __('auth.remember_me') }}</span>
                        </label>
                        <a href="#" class="forgot-link">{{ __('auth.forgot_password') }}</a>
                    </div>

                    <button type="submit" class="btn-submit">
                            {{ __('auth.sign_in_workspace') }}
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 20 20">
                            <path d="M4 10h12M11 6l4 4-4 4" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>
                </form>

                <div class="or-divider">
                    <span class="or-line"></span>
                    <span class="or-text">{{ __('auth.or_continue_with') }}</span>
                    <span class="or-line"></span>
                </div>

                <button type="button" class="btn-google">
                    <svg viewBox="0 0 24 24" width="16" height="16">
                        <path
                            d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"
                            fill="#4285F4" />
                        <path
                            d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"
                            fill="#34A853" />
                        <path
                            d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z"
                            fill="#FBBC05" />
                        <path
                            d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"
                            fill="#EA4335" />
                    </svg>
                   {{ __('auth.sign_in_google') }}
                </button>

                <div class="signup-row">
                   {{ __('auth.dont_have_account') }}
                    <a href="{{ route('register') }}" class="signup-link">{{ __('auth.create_one_free') }}</a>
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
            margin-bottom: 52px;
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
            font-size: 32px;
            font-weight: 700;
            color: #fff;
            line-height: 1.2;
            letter-spacing: -.03em;
            margin-bottom: 14px;
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
            margin-bottom: 32px;
            position: relative;
            z-index: 2;
        }

        .feature-list {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 12px;
            position: relative;
            z-index: 2;
        }

        .feature-list li {
            font-size: 12.5px;
            color: #64748b;
            padding-left: 16px;
            position: relative;
        }

        .feature-list li::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 5px;
            height: 5px;
            border-radius: 50%;
            background: var(--amber);
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
            margin-bottom: 14px;
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
            margin-bottom: 32px;
        }

        .field {
            display: flex;
            flex-direction: column;
            gap: 5px;
            margin-bottom: 16px;
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

        .meta-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin: 4px 0 24px;
        }

        .check-row {
            display: flex;
            align-items: center;
            gap: 7px;
            cursor: pointer;
            font-size: 12px;
            color: var(--muted);
            user-select: none;
        }

        .sr-only {
            display: none;
        }

        .cb {
            width: 15px;
            height: 15px;
            border: 1.5px solid var(--border);
            border-radius: 3px;
            background: #fff;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: .15s;
            cursor: pointer;
        }

        .cb.on {
            background: var(--dark);
            border-color: var(--dark);
        }

        .cb.on::after {
            content: '';
            width: 8px;
            height: 5px;
            border-left: 1.5px solid #fff;
            border-bottom: 1.5px solid #fff;
            transform: rotate(-45deg) translate(1px, -1px);
            display: block;
        }

        .forgot-link {
            font-size: 12px;
            font-weight: 600;
            color: var(--amber);
            text-decoration: none;
            transition: color .15s;
        }

        .forgot-link:hover {
            color: var(--amberh);
        }

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

        .or-divider {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 20px 0;
        }

        .or-line {
            flex: 1;
            height: 1px;
            background: #f1f5f9;
        }

        .or-text {
            font-size: 11px;
            color: #d1d5db;
            white-space: nowrap;
        }

        .btn-google {
            width: 100%;
            background: #fff;
            border: 1.5px solid var(--border);
            border-radius: 8px;
            padding: 11px 16px;
            font-family: var(--sans);
            font-size: 13px;
            color: #374151;
            font-weight: 500;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: border-color .15s, background .15s;
        }

        .btn-google:hover {
            border-color: #d1d5db;
            background: var(--surf);
        }

        .signup-row {
            margin-top: 24px;
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
        function togglePw() {
            var i = document.getElementById('password');
            var s = document.getElementById('eye-show');
            var h = document.getElementById('eye-hide');
            if (i.type === 'password') { i.type = 'text'; s.style.display = 'none'; h.style.display = 'block'; }
            else { i.type = 'password'; s.style.display = 'block'; h.style.display = 'none'; }
        }
    </script>
@endsection