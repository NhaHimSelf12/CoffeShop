@extends('layouts.app')

@section('page_title', __('main.categories'))

@section('styles')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600&family=Playfair+Display:wght@600&display=swap"
        rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
        }

        :root {
            --bg: #F7F5F0;
            --surface: #FFFFFF;
            --surface2: #F0EDE7;
            --border: rgba(0, 0, 0, 0.08);
            --border2: rgba(0, 0, 0, 0.14);
            --text1: #1A1814;
            --text2: #6B6760;
            --text3: #A8A49E;
            --accent: #C4501A;
            --accent-lt: #FAEEE8;
            --green: #1D4E3A;
            --green-lt: #E3EFE9;
            --tag-bg: #EDE9E2;
            --font-d: 'Playfair Display', serif;
            --font-b: 'DM Sans', sans-serif;
            --r: 12px;
            --r-sm: 8px;
            --r-pill: 100px;
        }

        .cat-page {
            font-family: var(--font-b);
            background: var(--bg);
            min-height: 100vh;
            padding: 32px 28px 56px;
            color: var(--text1);
        }

        /* ── PAGE HEADER ── */
        .page-header {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            margin-bottom: 28px;
            gap: 16px;
            flex-wrap: wrap;
        }

        .page-eyebrow {
            font-size: 11px;
            font-weight: 500;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: var(--accent);
            margin-bottom: 5px;
        }

        .page-title {
            font-family: var(--font-d);
            font-size: 26px;
            color: var(--text1);
            margin: 0 0 4px;
            line-height: 1.1;
        }

        .page-sub {
            font-size: 13px;
            color: var(--text3);
            margin: 0;
        }

        .create-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            background: var(--accent);
            color: #fff;
            border: none;
            border-radius: var(--r);
            font-family: var(--font-b);
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            transition: opacity 0.15s, transform 0.1s;
            white-space: nowrap;
            flex-shrink: 0;
        }

        .create-btn:hover {
            opacity: 0.88;
            color: #fff;
        }

        .create-btn:active {
            transform: scale(0.98);
        }

        /* ── ALERT ── */
        .alert-error {
            background: #FCEBEB;
            border: 1px solid rgba(226, 75, 74, 0.25);
            border-radius: var(--r);
            padding: 12px 16px;
            font-size: 13px;
            color: #A32D2D;
            margin-bottom: 20px;
        }

        /* ── CATEGORY GRID ── */
        .cat-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
            gap: 16px;
            margin-bottom: 40px;
        }

        /* ── CATEGORY CARD ── */
        .cat-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--r);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            transition: transform 0.15s, box-shadow 0.15s;
            position: relative;
        }

        .cat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 28px rgba(0, 0, 0, 0.07);
        }

        /* Image area */
        .cat-img {
            height: 250px;
            background: var(--surface2);
            position: relative;
            overflow: hidden;
            flex-shrink: 0;
        }

        .cat-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .cat-card:hover .cat-img img {
            transform: scale(1.03);
        }

        .cat-img-placeholder {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            gap: 8px;
            color: var(--text3);
            font-size: 12px;
            letter-spacing: 0.3px;
        }

        .cat-img-placeholder svg {
            opacity: 0.35;
        }

        /* Overlay gradient on image */
        .cat-img::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(26, 24, 20, 0.35) 0%, transparent 55%);
            pointer-events: none;
        }

        /* 3-dot menu */
        .cat-menu-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            z-index: 10;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.92);
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.15s;
        }

        .cat-menu-btn:hover {
            background: #fff;
        }

        .cat-dropdown {
            position: absolute;
            top: 44px;
            right: 10px;
            z-index: 20;
            background: var(--surface);
            border: 1px solid var(--border2);
            border-radius: var(--r-sm);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
            min-width: 160px;
            overflow: hidden;
            display: none;
        }

        .cat-dropdown.open {
            display: block;
        }

        .cat-dropdown a,
        .cat-dropdown button {
            display: flex;
            align-items: center;
            gap: 8px;
            width: 100%;
            padding: 10px 14px;
            font-family: var(--font-b);
            font-size: 13px;
            color: var(--text2);
            background: none;
            border: none;
            cursor: pointer;
            text-decoration: none;
            transition: background 0.1s;
            text-align: left;
        }

        .cat-dropdown a:hover,
        .cat-dropdown button:hover {
            background: var(--bg);
            color: var(--text1);
        }

        .cat-dropdown .divider {
            height: 1px;
            background: var(--border);
            margin: 2px 0;
        }

        .cat-dropdown .delete-btn {
            color: #E24B4A;
        }

        .cat-dropdown .delete-btn:hover {
            background: #FCEBEB;
            color: #A32D2D;
        }

        /* Card body */
        .cat-body {
            padding: 14px 16px 16px;
            display: flex;
            flex-direction: column;
            gap: 12px;
            flex: 1;
        }

        .cat-name {
            font-size: 15px;
            font-weight: 600;
            color: var(--text1);
            margin: 0;
            line-height: 1.2;
        }

        .cat-count {
            font-size: 12px;
            color: var(--text3);
        }

        .cat-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-top: 12px;
            border-top: 1px solid var(--border);
        }

        .active-badge {
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 0.3px;
            color: var(--green);
            background: var(--green-lt);
            padding: 4px 10px;
            border-radius: var(--r-pill);
        }

        .open-link {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 12px;
            font-weight: 500;
            color: var(--accent);
            text-decoration: none;
            transition: gap 0.15s;
        }

        .open-link:hover {
            gap: 8px;
            color: var(--accent);
        }

        /* ── EMPTY STATE ── */
        .empty-state {
            grid-column: 1 / -1;
            text-align: center;
            padding: 72px 24px;
        }

        .empty-icon {
            width: 60px;
            height: 60px;
            background: var(--tag-bg);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 16px;
        }

        .empty-state h3 {
            font-family: var(--font-d);
            font-size: 18px;
            color: var(--text1);
            margin-bottom: 6px;
        }

        .empty-state p {
            font-size: 13px;
            color: var(--text3);
            margin: 0;
        }

        /* ── MODAL ── */
        .modal-backdrop {
            display: none !important;
        }

        .m-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(26, 24, 20, 0.45);
            z-index: 1040;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .m-overlay.open {
            display: flex;
        }

        .m-box {
            background: var(--surface);
            border-radius: var(--r);
            width: 100%;
            max-width: 440px;
            overflow: hidden;
            animation: modalIn 0.18s ease;
        }

        @keyframes modalIn {
            from {
                opacity: 0;
                transform: translateY(12px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .m-header {
            padding: 20px 24px 0;
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 12px;
        }

        .m-title {
            font-family: var(--font-d);
            font-size: 18px;
            color: var(--text1);
            margin: 0;
        }

        .m-close {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background: var(--tag-bg);
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text2);
            flex-shrink: 0;
            transition: background 0.15s;
            margin-top: 2px;
        }

        .m-close:hover {
            background: var(--border2);
        }

        .m-body {
            padding: 20px 24px;
        }

        .m-field {
            margin-bottom: 16px;
        }

        .m-field:last-child {
            margin-bottom: 0;
        }

        .m-label {
            display: block;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 0.7px;
            text-transform: uppercase;
            color: var(--text3);
            margin-bottom: 6px;
        }

        .m-input {
            width: 100%;
            height: 38px;
            border: 1px solid var(--border2);
            border-radius: var(--r-sm);
            padding: 0 12px;
            font-family: var(--font-b);
            font-size: 13px;
            color: var(--text1);
            background: var(--bg);
            outline: none;
            transition: border-color 0.15s, background 0.15s;
        }

        .m-input:focus {
            border-color: var(--accent);
            background: var(--surface);
        }

        .m-file {
            width: 100%;
            border: 1px dashed var(--border2);
            border-radius: var(--r-sm);
            padding: 14px 12px;
            font-family: var(--font-b);
            font-size: 13px;
            color: var(--text2);
            background: var(--bg);
            cursor: pointer;
            outline: none;
            transition: border-color 0.15s;
        }

        .m-file:hover {
            border-color: var(--accent);
        }

        .m-hint {
            font-size: 11px;
            color: var(--text3);
            margin-top: 5px;
        }

        .m-footer {
            padding: 0 24px 20px;
            display: flex;
            justify-content: flex-end;
            gap: 8px;
        }

        .m-cancel {
            padding: 9px 18px;
            background: var(--bg);
            border: 1px solid var(--border2);
            border-radius: var(--r);
            font-family: var(--font-b);
            font-size: 13px;
            font-weight: 500;
            color: var(--text2);
            cursor: pointer;
            transition: border-color 0.15s;
        }

        .m-cancel:hover {
            border-color: var(--text2);
        }

        .m-submit {
            padding: 9px 20px;
            background: var(--accent);
            border: none;
            border-radius: var(--r);
            font-family: var(--font-b);
            font-size: 13px;
            font-weight: 600;
            color: #fff;
            cursor: pointer;
            transition: opacity 0.15s;
        }

        .m-submit:hover {
            opacity: 0.88;
        }
    </style>
@endsection

@section('content')
    <div class="cat-page">

        {{-- ── PAGE HEADER ── --}}
        <div class="page-header">
            <div>
                <p class="page-eyebrow">{{ __('main.catalog') }}</p>
                <h1 class="page-title">{{ __('main.product_groups') }}</h1>
                <p class="page-sub">{{ __('main.product_groups_sub') }}</p>
            </div>
            <button class="create-btn" onclick="openModal('addModal')">
                <svg width="13" height="13" viewBox="0 0 16 16" fill="none">
                    <path d="M8 2v12M2 8h12" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                </svg>
                {{ __('main.create_category') }}
            </button>
        </div>

        {{-- ── ERRORS ── --}}
        @if($errors->any())
            <div class="alert-error">{{ $errors->first() }}</div>
        @endif

        {{-- ── CATEGORY GRID ── --}}
        <div class="cat-grid">
            @forelse($categories as $cat)
                <div class="cat-card">

                    {{-- Image --}}
                    <div class="cat-img">
                        @if($cat->image)
                            <img src="{{ asset('storage/' . $cat->image) }}" alt="{{ $cat->name }}">
                        @else
                            <div class="cat-img-placeholder">
                                <svg width="36" height="36" viewBox="0 0 24 24" fill="none">
                                    <rect x="3" y="3" width="18" height="18" rx="2" stroke="currentColor" stroke-width="1.5" />
                                    <circle cx="8.5" cy="8.5" r="1.5" stroke="currentColor" stroke-width="1.5" />
                                    <path d="M3 15l5-5 4 4 3-3 6 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                                <span>{{ __('main.no_image') }}</span>
                            </div>
                        @endif

                        {{-- 3-dot menu --}}
                        <button class="cat-menu-btn" onclick="toggleDropdown(event, 'drop-{{ $cat->id }}')">
                            <svg width="14" height="14" viewBox="0 0 16 16" fill="none">
                                <circle cx="8" cy="3" r="1.2" fill="#6B6760" />
                                <circle cx="8" cy="8" r="1.2" fill="#6B6760" />
                                <circle cx="8" cy="13" r="1.2" fill="#6B6760" />
                            </svg>
                        </button>

                        <div class="cat-dropdown" id="drop-{{ $cat->id }}">
                            <a href="#"
                                onclick="event.preventDefault(); closeAllDropdowns(); openModal('editModal{{ $cat->id }}')">
                                <svg width="13" height="13" viewBox="0 0 16 16" fill="none">
                                    <path d="M11.5 2.5l2 2L5 13H3v-2L11.5 2.5z" stroke="currentColor" stroke-width="1.4"
                                        stroke-linejoin="round" />
                                </svg>
                                {{ __('main.edit_details') }}
                            </a>
                            <div class="divider"></div>
                            <form action="{{ route('categories.destroy', $cat->id) }}" method="POST"
                                onsubmit="return confirm('{{ __('main.confirm_delete_category') }}')">
                                @csrf @method('DELETE')
                                <button type="submit" class="delete-btn">
                                    <svg width="13" height="13" viewBox="0 0 16 16" fill="none">
                                        <path d="M3 5h10M6 5V3h4v2M6 8v5M10 8v5" stroke="currentColor" stroke-width="1.4"
                                            stroke-linecap="round" />
                                        <path d="M4 5l.5 9h7L12 5" stroke="currentColor" stroke-width="1.4"
                                            stroke-linejoin="round" />
                                    </svg>
                                    {{ __('main.remove') }}
                                </button>
                            </form>
                        </div>
                    </div>

                    {{-- Body --}}
                    <div class="cat-body">
                        <div>
                            <h3 class="cat-name">{{ $cat->name }}</h3>
                            <p class="cat-count">{{ $cat->products_count }}
                                {{ Str::plural(__('main.product'), $cat->products_count) }}
                            </p>
                        </div>
                        <div class="cat-footer">
                            <span class="active-badge">{{ __('main.active') }}</span>
                            <a href="{{ route('products.index', ['category' => $cat->id]) }}" class="open-link">
                                {{ __('main.view_items') }}
                                <svg width="12" height="12" viewBox="0 0 16 16" fill="none">
                                    <path d="M3 8h10M9 4l4 4-4 4" stroke="currentColor" stroke-width="1.6"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Edit Modal --}}
                <div class="m-overlay" id="editModal{{ $cat->id }}">
                    <div class="m-box">
                        <div class="m-header">
                            <h2 class="m-title">{{ __('main.update_category') }}</h2>
                            <button class="m-close" onclick="closeModal('editModal{{ $cat->id }}')">
                                <svg width="12" height="12" viewBox="0 0 16 16" fill="none">
                                    <path d="M2 2l12 12M14 2L2 14" stroke="currentColor" stroke-width="1.8"
                                        stroke-linecap="round" />
                                </svg>
                            </button>
                        </div>
                        <form action="{{ route('categories.update', $cat->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf @method('PUT')
                            <div class="m-body">
                                <div class="m-field">
                                    <label class="m-label">{{ __('main.category_name') }}</label>
                                    <input type="text" name="name" class="m-input" value="{{ $cat->name }}" required>
                                </div>
                                <div class="m-field">
                                    <label class="m-label">{{ __('main.cover_image') }}</label>
                                    <input type="file" name="image" class="m-file" accept="image/*">
                                    <p class="m-hint">
                                        {{ $cat->image ? __('main.current_image_kept') : __('main.no_image_uploaded') }}
                                    </p>
                                </div>
                            </div>
                            <div class="m-footer">
                                <button type="button" class="m-cancel"
                                    onclick="closeModal('editModal{{ $cat->id }}')">{{ __('main.cancel') }}</button>
                                <button type="submit" class="m-submit">{{ __('main.save_changes') }}</button>
                            </div>
                        </form>
                    </div>
                </div>

            @empty
                <div class="empty-state">
                    <div class="empty-icon">
                        <svg width="26" height="26" viewBox="0 0 24 24" fill="none">
                            <path d="M3 7a2 2 0 012-2h3l2 3h9a2 2 0 012 2v7a2 2 0 01-2 2H5a2 2 0 01-2-2V7z" stroke="#A8A49E"
                                stroke-width="1.5" stroke-linejoin="round" />
                        </svg>
                    </div>
                    <h3>{{ __('main.no_categories_yet') }}</h3>
                    <p>{{ __('main.create_first_category') }}</p>
                </div>
            @endforelse
        </div>

    </div>

    {{-- ── ADD MODAL ── --}}
    <div class="m-overlay" id="addModal">
        <div class="m-box">
            <div class="m-header">
                <h2 class="m-title">{{ __('main.new_category') }}</h2>
                <button class="m-close" onclick="closeModal('addModal')">
                    <svg width="12" height="12" viewBox="0 0 16 16" fill="none">
                        <path d="M2 2l12 12M14 2L2 14" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                    </svg>
                </button>
            </div>
            <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="m-body">
                    <div class="m-field">
                        <label class="m-label">{{ __('main.category_name') }}</label>
                        <input type="text" name="name" class="m-input"
                            placeholder="{{ __('main.example_signature_coffee') }}" required autofocus>
                    </div>
                    <div class="m-field">
                        <label class="m-label">{{ __('main.cover_image') }}</label>
                        <input type="file" name="image" class="m-file" accept="image/*">
                        <p class="m-hint">{{ __('main.optional_jpg_png') }}</p>
                    </div>
                </div>
                <div class="m-footer">
                    <button type="button" class="m-cancel" onclick="closeModal('addModal')">{{ __('main.cancel') }}</button>
                    <button type="submit" class="m-submit">{{ __('main.create_category') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function openModal(id) {
            document.getElementById(id).classList.add('open');
            document.body.style.overflow = 'hidden';
        }

        function closeModal(id) {
            document.getElementById(id).classList.remove('open');
            document.body.style.overflow = '';
        }

        /* Close on overlay click */
        document.querySelectorAll('.m-overlay').forEach(overlay => {
            overlay.addEventListener('click', e => {
                if (e.target === overlay) closeModal(overlay.id);
            });
        });

        /* Close on Escape */
        document.addEventListener('keydown', e => {
            if (e.key === 'Escape') {
                document.querySelectorAll('.m-overlay.open').forEach(el => closeModal(el.id));
                closeAllDropdowns();
            }
        });

        /* Dropdown toggles */
        function toggleDropdown(e, id) {
            e.stopPropagation();
            const el = document.getElementById(id);
            const isOpen = el.classList.contains('open');
            closeAllDropdowns();
            if (!isOpen) el.classList.add('open');
        }

        function closeAllDropdowns() {
            document.querySelectorAll('.cat-dropdown').forEach(d => d.classList.remove('open'));
        }

        document.addEventListener('click', closeAllDropdowns);

        /* Auto-open add modal on validation error */
        @if($errors->any())
            openModal('addModal');
        @endif
    </script>
@endsection