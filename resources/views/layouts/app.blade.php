<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('', 'ConnerCoffe') }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=DM+Sans:wght@300;400;500;600&family=Kantumruy+Pro:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <style>
        :root {
            --espresso: #1a2235;
            --roast: #243050;
            --caramel: #f5a623;
            --gold: #f7c56a;
            --cream: #f0ede6;
            --milk: #f5f2eb;
            --steam: #e0d8cc;
            --text-main: #1a2235;
            --text-muted: #8a7c6e;
            --sidebar-w: 280px;
            --radius: 14px;
            --transition: 0.22s cubic-bezier(.4, 0, .2, 1);
        }

        /* ─── SIDEBAR ─────────────────────────────── */
        #sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: var(--sidebar-w);
            height: 100vh;
            background: #1a2235;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            z-index: 100;
        }

        #sidebar::before {
            content: '';
            position: absolute;
            inset: 0;
            background:
                radial-gradient(ellipse at 15% 8%, rgba(245, 166, 35, .12) 0%, transparent 55%),
                radial-gradient(ellipse at 85% 92%, rgba(245, 166, 35, .06) 0%, transparent 45%);
            pointer-events: none;
        }

        .sidebar-brand {
            padding: 28px 20px 22px;
            border-bottom: 1px solid rgba(255, 255, 255, .06);
        }

        .sidebar-brand .brand-icon {
            width: 52px;
            height: 52px;
            background: linear-gradient(135deg, #f5a623, #f7c56a);
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            color: #1a2235;
            margin-bottom: 12px;
            box-shadow: 0 4px 16px rgba(245, 166, 35, .4);
        }

        .sidebar-brand h5 {
            font-family: 'Playfair Display', serif;
            font-size: 1.25rem;
            color: #fff;
            letter-spacing: .01em;
            line-height: 1.2;
            margin: 0 0 3px;
        }

        .sidebar-brand small {
            font-size: .65rem;
            color: rgba(255, 255, 255, .3);
            letter-spacing: .14em;
            text-transform: uppercase;
        }

        /* nav sections */
        .nav-section-label {
            font-size: .62rem;
            letter-spacing: .14em;
            text-transform: uppercase;
            color: rgba(255, 255, 255, .22);
            padding: 18px 16px 8px;
        }

        .sidebar-nav {
            flex: 1;
            overflow-y: auto;
            padding: 6px 12px;
            scrollbar-width: none;
        }

        .sidebar-nav::-webkit-scrollbar {
            display: none;
        }

        .nav-item {
            margin-bottom: 6px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 13px 16px;
            border-radius: 12px;
            color: rgba(255, 255, 255, .55);
            font-size: .9rem;
            font-weight: 400;
            text-decoration: none;
            transition: all var(--transition);
            position: relative;
            border: 1px solid rgba(255, 255, 255, .25);
            /* ភ្លឺជាង */
            background: rgba(255, 255, 255, .04);
        }

        .nav-link .nav-icon {
            width: 34px;
            height: 34px;
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            /* emoji size */
            background: rgba(255, 255, 255, .07);
            transition: background var(--transition);
            flex-shrink: 0;
        }

        .nav-link:hover {
            color: rgba(255, 255, 255, .9);
            background: rgba(255, 255, 255, .08);
            border-color: rgba(255, 255, 255, .45);
            /* hover ភ្លឺជាង */
        }

        .nav-link:hover .nav-icon {
            background: rgba(255, 255, 255, .12);
        }

        .nav-link.active {
            color: #1a2235;
            background: linear-gradient(135deg, #f5a623, #f7c56a);
            border-color: #f7c56a;
            /* golden border ភ្លឺ */
            font-weight: 600;
            box-shadow: 0 4px 16px rgba(245, 166, 35, .45);
        }

        .nav-link.active .nav-icon {
            background: rgba(245, 166, 35, .2);
            color: #f5a623;
        }

        /* sidebar bottom user card */
        .sidebar-footer {
            padding: 14px;
            border-top: 1px solid rgba(255, 255, 255, .06);
        }

        .user-card {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 12px;
            border-radius: 12px;
            background: rgba(245, 166, 35, .1);
            border: 1px solid rgba(245, 166, 35, .2);
        }

        .user-card img {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            border: 2px solid rgba(245, 166, 35, .5);
            object-fit: cover;
        }

        .user-card .user-info {
            flex: 1;
            min-width: 0;
        }

        .user-card .user-name {
            font-size: .84rem;
            font-weight: 600;
            color: #fff;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .user-card .user-role {
            font-size: .7rem;
            color: #f5a623;
            text-transform: capitalize;
        }

        .logout-btn {
            width: 34px;
            height: 34px;
            border-radius: 9px;
            background: rgba(255, 255, 255, .07);
            border: 1px solid rgba(255, 255, 255, .1);
            color: rgba(255, 255, 255, .5);
            font-size: .85rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all var(--transition);
            flex-shrink: 0;
        }

        .logout-btn:hover {
            background: rgba(231, 76, 60, .15);
            border-color: rgba(231, 76, 60, .3);
            color: #e74c3c;
        }

        /* ─── MAIN CONTENT ────────────────────────── */
        #wrapper {
            display: flex;
        }

        #content {
            margin-left: var(--sidebar-w);
            flex: 1;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background: var(--cream);
        }

        /* ─── TOP NAV ─────────────────────────────── */
        .topbar {
            position: sticky;
            top: 0;
            z-index: 50;
            background: rgba(245, 242, 235, .94);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--steam);
            padding: 0 28px;
            height: 68px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .topbar-left .page-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.2rem;
            color: var(--espresso);
        }

        .topbar-left .breadcrumb-text {
            font-size: .75rem;
            color: var(--text-muted);
            margin-top: 1px;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .topbar-btn {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            border: 1px solid var(--steam);
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-muted);
            font-size: .88rem;
            cursor: pointer;
            transition: all var(--transition);
            text-decoration: none;
        }

        .topbar-btn:hover {
            border-color: var(--caramel);
            color: var(--caramel);
        }

        .topbar-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 2px solid var(--caramel);
            object-fit: cover;
            cursor: pointer;
        }

        /* ─── PAGE BODY ───────────────────────────── */
        .page-body {
            flex: 1;
            padding: 28px;
        }

        /* ─── CARDS ───────────────────────────────── */
        .card {
            background: #fff;
            border: 1px solid var(--steam);
            border-radius: var(--radius);
            box-shadow: 0 1px 3px rgba(26, 15, 10, .04);
            margin-bottom: 20px;
        }

        .card-header {
            padding: 16px 20px;
            background: none;
            border-bottom: 1px solid var(--steam);
            font-weight: 500;
            font-size: .95rem;
        }

        .card-body {
            padding: 20px;
        }

        /* ─── ALERTS ──────────────────────────────── */
        .alert {
            border: none;
            border-radius: var(--radius);
            font-size: .875rem;
            padding: 12px 16px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert-success {
            background: #edfaf3;
            color: #1a7a4a;
            border-left: 3px solid #2ecc71;
        }

        .alert-danger {
            background: #fdf0f0;
            color: #922b21;
            border-left: 3px solid #e74c3c;
        }

        /* ─── MOBILE ──────────────────────────────── */
        @media (max-width: 768px) {
            #sidebar {
                transform: translateX(-100%);
                transition: transform var(--transition);
            }

            #sidebar.open {
                transform: translateX(0);
            }

            #content {
                margin-left: 0;
            }
        }

        /* ─── ANIMATIONS ──────────────────────────── */
        @keyframes fadeSlideUp {
            from {
                opacity: 0;
                transform: translateY(12px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .page-body>* {
            animation: fadeSlideUp .3s ease both;
        }

        .page-body>*:nth-child(2) {
            animation-delay: .05s;
        }

        .page-body>*:nth-child(3) {
            animation-delay: .10s;
        }

        /* ─── LANGUAGE SWITCHER ───────────────────── */
        .language-dropdown {
            position: relative;
        }

        .language-toggle {
            transition: all var(--transition);
        }

        .language-toggle:hover {
            border-color: var(--caramel) !important;
            color: var(--caramel) !important;
        }

        .language-menu {
            animation: fadeSlideUp 0.2s ease;
        }

        .language-option {
            transition: background 0.15s !important;
        }

        .language-option:hover {
            background: #f9fafb !important;
        }

        .language-option.active {
            background: #fef3c7 !important;
            color: #92400e !important;
        }

        /* ─── KHMER FONT (Kantumruy Pro) ───────────────────── */
        [lang="km"] body {
            font-family: 'Kantumruy Pro', 'Font Awesome 6 Free', sans-serif !important;
        }

        [lang="km"] *,
        [lang="km"] .sidebar-brand h5,
        [lang="km"] .nav-link,
        [lang="km"] .page-title,
        [lang="km"] .db-title,
        [lang="km"] .stat-label,
        [lang="km"] .card-title,
        [lang="km"] .card-sub,
        [lang="km"] .btn-export,
        [lang="km"] .add-btn,
        [lang="km"] .page-eyebrow,
        [lang="km"] .page-title,
        [lang="km"] .page-sub,
        [lang="km"] .search-wrap input,
        [lang="km"] .cat-pill,
        [lang="km"] .product-name,
        [lang="km"] .prod-name,
        [lang="km"] .cart-title,
        [lang="km"] .field-label,
        [lang="km"] .checkout-btn,
        [lang="km"] .clear-btn,
        [lang="km"] .pos-logo,
        [lang="km"] .order-status,
        [lang="km"] .view-all-btn,
        [lang="km"] .dp-weekday,
        [lang="km"] .dp-today-btn,
        [lang="km"] .alert {
            font-family: 'Kantumruy Pro', sans-serif;
        }

        [lang="km"] .form-heading,
        [lang="km"] .form-desc,
        [lang="km"] .flabel,
        [lang="km"] .btn-submit,
        [lang="km"] .btn-google,
        [lang="km"] .signup-row,
        [lang="km"] .eyebrow,
        [lang="km"] .headline,
        [lang="km"] .sub-text,
        [lang="km"] .feature-list li,
        [lang="km"] .left-bottom blockquote,
        [lang="km"] .tester-name,

        [lang="km"] .fas,
        [lang="km"] .far,
        [lang="km"] .fab,
        [lang="km"] .fa {
            font-family: "Font Awesome 6 Free" !important;
            font-weight: 900;
            /* សំខាន់សម្រាប់ Font Awesome */
        }
    </style>

    @yield('styles')
</head>

<body>

    @guest
        @yield('content')
    @else

        <div id="wrapper">

            {{-- ══════════ SIDEBAR ══════════ --}}
            <nav id="sidebar">

                {{-- Brand --}}
                <div class="sidebar-brand">
                    <div class="brand-icon">
                        <i class="fas fa-mug-hot"></i>
                    </div>
                    <h5>{{ config('') }}ConnerCoffe</h5>
                    <small>Point of Sale</small>
                </div>

                {{-- Navigation --}}
                <div class="sidebar-nav">

                    <div class="nav-section-label">{{ __('main.main') }}</div>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a href="{{ route('dashboard') }}"
                                class="nav-link {{ request()->is('dashboard', '/') ? 'active' : '' }}">
                                <span class="nav-icon">📊</span>
                                {{ __('main.dashboard') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('pos.index') }}" class="nav-link {{ request()->is('pos*') ? 'active' : '' }}">
                                <span class="nav-icon">🧾</span>
                                {{ __('main.order') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('customers.index') }}"
                                class="nav-link {{ request()->is('customers*') ? 'active' : '' }}">
                                <span class="nav-icon">👥</span>
                                {{ __('main.customers') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('orders.index') }}"
                                class="nav-link {{ request()->is('orders*') ? 'active' : '' }}">
                                <span class="nav-icon">📋</span>
                                {{ __('main.order_history') }}
                            </a>
                        </li>
                    </ul>

                    @if(Auth::user()->isAdmin())
                        <div class="nav-section-label">{{ __('main.catalog') }}</div>
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a href="{{ route('categories.index') }}"
                                    class="nav-link {{ request()->is('categories*') ? 'active' : '' }}">
                                    <span class="nav-icon">🏷️</span>
                                    {{ __('main.categories') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('products.index') }}"
                                    class="nav-link {{ request()->is('products*') ? 'active' : '' }}">
                                    <span class="nav-icon">📦</span>
                                    {{ __('main.products') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('reports.index') }}"
                                    class="nav-link {{ request()->is('reports*') ? 'active' : '' }}">
                                    <span class="nav-icon">📈</span>
                                    {{ __('main.reports') }}
                                </a>
                            </li>
                        </ul>
                    @endif

                    <div class="nav-section-label">{{ __('main.system') }}</div>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a href="{{ route('users.index') }}"
                                class="nav-link {{ request()->is('users*') ? 'active' : '' }}">
                                <span class="nav-icon">🛡️</span>
                                {{ __('main.users') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('about') }}" class="nav-link {{ request()->is('about*') ? 'active' : '' }}">
                                <span class="nav-icon">ℹ️</span>
                                {{ __('main.about') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('story') }}" class="nav-link {{ request()->is('story*') ? 'active' : '' }}">
                                <span class="nav-icon">📖</span>
                                {{ __('main.our_story') }}
                            </a>
                        </li>
                    </ul>
                </div>

                {{-- Footer user card --}}
                <div class="sidebar-footer">
                    <div class="user-card">
                        <img src="{{ Auth::user()->image ? asset('storage/' . Auth::user()->image) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&background=2d1a0e&color=e8a54b' }}"
                            alt="{{ Auth::user()->name }}">
                        <div class="user-info">
                            <div class="user-name">{{ Auth::user()->name }}</div>
                            <div class="user-role">{{ Auth::user()->role }}</div>
                        </div>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="logout-btn" title="Logout">
                                <i class="fas fa-sign-out-alt"></i>
                            </button>
                        </form>
                    </div>
                </div>

            </nav>

            {{-- ══════════ MAIN CONTENT ══════════ --}}
            <div id="content">
                {{-- Top bar --}}
                <header class="topbar">
                    <div class="topbar-left">
                        <div class="page-title">@yield('page-title', 'Dashboard')</div>
                        <div class="breadcrumb-text">
                            @yield('breadcrumb', __('main.welcome_back') . ' ☕')
                            <small style="color: #9ca3af; margin-left: 10px;">
                                [Locale: {{ app()->getLocale() }} | Session: {{ Session::get('locale', 'not set') }}]
                            </small>
                        </div>
                    </div>
                    <div class="topbar-right">
                        <button class="topbar-btn d-md-none" id="sidebarToggle">
                            <i class="fas fa-bars"></i>
                        </button>
                        <a href="#" class="topbar-btn">
                            <i class="fas fa-bell"></i>
                        </a>

                        {{-- Language Switcher --}}
                        @php
                            $currentLocale = app()->getLocale();
                            $languages = [
                                'en' => ['name' => 'English', 'flag' => '🇬🇧', 'label' => 'EN'],
                                'km' => ['name' => 'ខ្មែរ', 'flag' => '🇰🇭', 'label' => 'KH'],
                                'ja' => ['name' => '日本語', 'flag' => '🇯🇵', 'label' => 'JA'],
                                'zh-CN' => ['name' => '中文', 'flag' => '🇨🇳', 'label' => 'CN'],
                            ];
                        @endphp

                        <div class="language-dropdown" style="position: relative;">
                            <button class="topbar-btn language-toggle" onclick="toggleLanguageDropdown()"
                                style="cursor: pointer; display: flex; align-items: center; gap: 6px;">
                                <span style="font-size: 16px;">{{ $languages[$currentLocale]['flag'] }}</span>
                                <span
                                    style="font-size: 12px; font-weight: 600;">{{ $languages[$currentLocale]['label'] }}</span>
                                <svg width="10" height="10" viewBox="0 0 20 20" fill="currentColor" style="opacity: 0.6;">
                                    <path d="M5 7l5 5 5-5" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                                </svg>
                            </button>

                            <div class="language-menu" id="languageMenu"
                                style="display: none; position: absolute; top: 100%; right: 0; margin-top: 6px; background: #fff; border: 1px solid var(--steam); border-radius: 12px; box-shadow: 0 10px 40px rgba(0, 0, 0, 0.12); z-index: 1000; min-width: 160px; overflow: hidden;">
                                @foreach($languages as $code => $lang)
                                    <form action="{{ route('language.change') }}" method="POST" style="margin: 0;">
                                        @csrf
                                        <input type="hidden" name="locale" value="{{ $code }}">
                                        <button type="submit"
                                            class="language-option {{ $currentLocale === $code ? 'active' : '' }}"
                                            style="width: 100%; padding: 10px 14px; border: none; background: {{ $currentLocale === $code ? '#fef3c7' : 'none' }}; cursor: pointer; display: flex; align-items: center; gap: 10px; text-align: left; font-size: 13px; color: {{ $currentLocale === $code ? '#92400e' : 'var(--text-muted)' }}; transition: background 0.15s;">
                                            <span style="font-size: 16px;">{{ $lang['flag'] }}</span>
                                            <span
                                                style="font-weight: {{ $currentLocale === $code ? '600' : '400' }};">{{ $lang['name'] }}</span>
                                        </button>
                                    </form>
                                @endforeach
                            </div>
                        </div>

                        <img src="{{ Auth::user()->image ? asset('storage/' . Auth::user()->image) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&background=2d1a0e&color=e8a54b' }}"
                            class="topbar-avatar" alt="{{ Auth::user()->name }}">
                    </div>
                </header>

                {{-- Alerts + Page content --}}
                <main class="page-body">

                    {{-- Debug: Show current locale --}}
                    @if(session('locale_changed'))
                        <div class="alert alert-info"
                            style="background: #dbeafe; color: #1e40af; border-left: 3px solid #3b82f6;">
                            <i class="fas fa-info-circle"></i>
                            Language changed to: <strong>{{ session('locale_changed') }}</strong>
                            @php Session::forget('locale_changed'); @endphp
                        </div>
                    @endif

                    @if(session('success'))
                        <div class="alert alert-success">
                            <i class="fas fa-check-circle"></i>
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ session('error') }}
                        </div>
                    @endif

                    @yield('content')

                </main>
            </div>

        </div>

    @endguest

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Mobile sidebar toggle
        document.getElementById('sidebarToggle')?.addEventListener('click', () => {
            document.getElementById('sidebar').classList.toggle('open');
        });

        // Language dropdown toggle
        function toggleLanguageDropdown() {
            const menu = document.getElementById('languageMenu');
            if (menu) {
                menu.style.display = menu.style.display === 'none' ? 'block' : 'none';
            }
        }

        // Close language dropdown when clicking outside
        document.addEventListener('click', function (event) {
            const dropdown = document.querySelector('.language-dropdown');
            const menu = document.getElementById('languageMenu');
            if (dropdown && menu && !dropdown.contains(event.target)) {
                menu.style.display = 'none';
            }
        });
    </script>
    @yield('scripts')
</body>

</html>