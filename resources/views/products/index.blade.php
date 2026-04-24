@extends('layouts.app')

@section('page_title', __('main.master_inventory'))

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
            --red: #A32D2D;
            --red-lt: #FCEBEB;
            --gold: #92621A;
            --gold-lt: #FEF3DC;
            --tag-bg: #EDE9E2;
            --font-d: 'Playfair Display', serif;
            --font-b: 'DM Sans', sans-serif;
            --r: 12px;
            --r-sm: 8px;
            --r-pill: 100px;
        }

        .inv-page {
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
            margin-bottom: 24px;
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

        .add-btn {
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
            transition: opacity 0.15s, transform 0.1s;
            white-space: nowrap;
            flex-shrink: 0;
        }

        .add-btn:hover {
            opacity: 0.88;
            color: #fff;
        }

        .add-btn:active {
            transform: scale(0.98);
        }

        /* ── TOOLBAR ── */
        .toolbar {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--r);
            padding: 14px 18px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        .search-wrap {
            position: relative;
            flex: 1;
            min-width: 180px;
            max-width: 320px;
        }

        .search-icon {
            position: absolute;
            left: 11px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text3);
            pointer-events: none;
            display: flex;
        }

        .search-wrap input {
            width: 100%;
            height: 36px;
            border: 1px solid var(--border2);
            border-radius: var(--r-pill);
            padding: 0 14px 0 34px;
            font-family: var(--font-b);
            font-size: 13px;
            color: var(--text1);
            background: var(--bg);
            outline: none;
            transition: border-color 0.15s, background 0.15s;
        }

        .search-wrap input:focus {
            border-color: var(--accent);
            background: var(--surface);
        }

        .cat-select {
            height: 36px;
            border: 1px solid var(--border2);
            border-radius: var(--r-pill);
            padding: 0 14px;
            font-family: var(--font-b);
            font-size: 13px;
            color: var(--text2);
            background: var(--bg);
            outline: none;
            cursor: pointer;
            transition: border-color 0.15s;
            min-width: 160px;
        }

        .cat-select:focus {
            border-color: var(--accent);
        }

        .search-btn {
            height: 36px;
            padding: 0 18px;
            background: var(--accent);
            color: #fff;
            border: none;
            border-radius: var(--r-pill);
            font-family: var(--font-b);
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            transition: opacity 0.15s;
            white-space: nowrap;
        }

        .search-btn:hover {
            opacity: 0.88;
        }

        .toolbar-right {
            margin-left: auto;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .result-count {
            font-size: 12px;
            color: var(--text3);
            white-space: nowrap;
        }

        /* ── PRODUCT GRID ── */
        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(210px, 1fr));
            gap: 14px;
            margin-bottom: 20px;
        }

        /* ── PRODUCT CARD ── */
        .prod-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--r);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            position: relative;
            transition: transform 0.18s ease, box-shadow 0.18s ease, border-color 0.18s;
            cursor: default;
        }

        .prod-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 28px rgba(0, 0, 0, 0.08);
            border-color: var(--border2);
        }

        /* Image */
        .prod-img {
            height: 180px;
            background: var(--surface2);
            position: relative;
            overflow: hidden;
            flex-shrink: 0;
        }

        .prod-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .prod-card:hover .prod-img img {
            transform: scale(1.04);
        }

        .prod-img-placeholder {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Stock badge on image */
        .stock-badge {
            position: absolute;
            bottom: 8px;
            left: 8px;
            font-size: 11px;
            font-weight: 600;
            padding: 3px 9px;
            border-radius: var(--r-pill);
        }

        .stock-badge.ok {
            background: var(--green-lt);
            color: var(--green);
        }

        .stock-badge.low {
            background: var(--gold-lt);
            color: var(--gold);
        }

        .stock-badge.out {
            background: var(--red-lt);
            color: var(--red);
        }

        /* 3-dot menu */
        .prod-menu-btn {
            position: absolute;
            top: 8px;
            right: 8px;
            z-index: 10;
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.9);
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.15s;
        }

        .prod-menu-btn:hover {
            background: #fff;
        }

        .prod-dropdown {
            position: absolute;
            top: 40px;
            right: 8px;
            z-index: 20;
            background: var(--surface);
            border: 1px solid var(--border2);
            border-radius: var(--r-sm);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
            min-width: 155px;
            overflow: hidden;
            display: none;
        }

        .prod-dropdown.open {
            display: block;
        }

        .prod-dropdown a,
        .prod-dropdown button {
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

        .prod-dropdown a:hover,
        .prod-dropdown button:hover {
            background: var(--bg);
            color: var(--text1);
        }

        .prod-dropdown .dd-divider {
            height: 1px;
            background: var(--border);
            margin: 2px 0;
        }

        .prod-dropdown .del-btn {
            color: var(--red);
        }

        .prod-dropdown .del-btn:hover {
            background: var(--red-lt);
            color: var(--red);
        }

        /* Card body */
        .prod-body {
            padding: 12px 14px 14px;
        }

        .prod-cat {
            display: inline-block;
            font-size: 10.5px;
            font-weight: 600;
            letter-spacing: 0.4px;
            color: var(--accent);
            background: var(--accent-lt);
            padding: 2px 8px;
            border-radius: var(--r-pill);
            margin-bottom: 7px;
            text-transform: uppercase;
        }

        .prod-name {
            font-size: 14px;
            font-weight: 600;
            color: var(--text1);
            margin: 0 0 6px;
            line-height: 1.25;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .prod-price {
            font-size: 16px;
            font-weight: 600;
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

        /* ── PAGINATION ── */
        .pagination-wrap {
            background: var(--surface);
            border: 1px solid var(--border);
            border-top: none;
            border-radius: 0 0 var(--r) var(--r);
            padding: 12px 18px;
            display: flex;
            justify-content: flex-end;
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
            max-width: 480px;
            max-height: 90vh;
            overflow-y: auto;
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
            position: sticky;
            top: 0;
            background: var(--surface);
            padding-bottom: 16px;
            border-bottom: 1px solid var(--border);
            z-index: 2;
        }

        .m-title {
            font-family: var(--font-d);
            font-size: 17px;
            color: var(--text1);
            margin: 0;
            padding-top: 2px;
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

        .m-input,
        .m-select {
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

        .m-input:focus,
        .m-select:focus {
            border-color: var(--accent);
            background: var(--surface);
        }

        .m-file {
            width: 100%;
            border: 1px dashed var(--border2);
            border-radius: var(--r-sm);
            padding: 12px;
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

        .m-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
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
    <div class="inv-page">

        {{-- ── PAGE HEADER ── --}}
        <div class="page-header">
            <div>
                <p class="page-eyebrow">{{ __('main.inventory') }}</p>
                <h1 class="page-title">{{ __('main.product_catalog') }}</h1>
                <p class="page-sub">{{ __('main.product_catalog_sub') }}</p>
            </div>
            <button class="add-btn" onclick="openModal('addProductModal')">
                <svg width="13" height="13" viewBox="0 0 16 16" fill="none">
                    <path d="M8 2v12M2 8h12" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                </svg>
                    {{ __('main.add_new_item') }}
            </button>
        </div>

        {{-- ── TOOLBAR ── --}}
        <form action="{{ route('products.index') }}" method="GET">
            <div class="toolbar">
                <div class="search-wrap">
                    <span class="search-icon">
                        <svg width="13" height="13" viewBox="0 0 16 16" fill="none">
                            <circle cx="6.5" cy="6.5" r="5" stroke="currentColor" stroke-width="1.6" />
                            <path d="M11 11l3.5 3.5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" />
                        </svg>
                    </span>
                    <input type="text" name="search" placeholder="{{ __('main.search_by_name') }}"
                        value="{{ request('search') }}">
                </div>

                <select name="category" class="cat-select" onchange="this.form.submit()">
                    <option value="">{{ __('main.all_categories') }}</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>

                <button type="submit" class="search-btn">{{ __('main.search') }}</button>

                <div class="toolbar-right">
                    <span class="result-count">{{ $products->total() }}
                        {{ Str::plural(__('main.item'), $products->total()) }}</span>
                </div>
            </div>
        </form>

        {{-- ── PRODUCT GRID ── --}}
        <div class="product-grid">
            @forelse($products as $product)
                @php
                    $stockClass = $product->stock <= 0 ? 'out' : ($product->stock < 10 ? 'low' : 'ok');
                    $stockLabel = $product->stock <= 0 ? __('main.out_of_stock') : ($product->stock < 10 ? __('main.low_stock') . ': ' . $product->stock : $product->stock . ' ' . __('main.in_stock'));
                @endphp

                <div class="prod-card">
                    {{-- Image --}}
                    <div class="prod-img">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                        @else
                            <div class="prod-img-placeholder">
                                <svg width="36" height="36" viewBox="0 0 24 24" fill="none" opacity=".25">
                                    <rect x="3" y="3" width="18" height="18" rx="2" stroke="#6B6760" stroke-width="1.5" />
                                    <circle cx="8.5" cy="8.5" r="1.5" stroke="#6B6760" stroke-width="1.5" />
                                    <path d="M3 15l5-5 4 4 3-3 6 6" stroke="#6B6760" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </div>
                        @endif

                        <span class="stock-badge {{ $stockClass }}">{{ $stockLabel }}</span>

                        {{-- 3-dot menu --}}
                        <button class="prod-menu-btn" onclick="toggleDropdown(event, 'pdrop-{{ $product->id }}')">
                            <svg width="13" height="13" viewBox="0 0 16 16" fill="none">
                                <circle cx="8" cy="3" r="1.2" fill="#6B6760" />
                                <circle cx="8" cy="8" r="1.2" fill="#6B6760" />
                                <circle cx="8" cy="13" r="1.2" fill="#6B6760" />
                            </svg>
                        </button>

                        <div class="prod-dropdown" id="pdrop-{{ $product->id }}">
                            <a href="#"
                                onclick="event.preventDefault(); closeAllDropdowns(); openModal('editModal{{ $product->id }}')">
                                <svg width="13" height="13" viewBox="0 0 16 16" fill="none">
                                    <path d="M11.5 2.5l2 2L5 13H3v-2L11.5 2.5z" stroke="currentColor" stroke-width="1.4"
                                        stroke-linejoin="round" />
                                </svg>
                                {{ __('main.edit') }}
                            </a>
                            <div class="dd-divider"></div>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                onsubmit="return confirm('{{ __('main.confirm_archive') }}')">
                                @csrf @method('DELETE')
                                <button type="submit" class="del-btn">
                                    <svg width="13" height="13" viewBox="0 0 16 16" fill="none">
                                        <path d="M3 5h10M6 5V3h4v2M6 8v5M10 8v5" stroke="currentColor" stroke-width="1.4"
                                            stroke-linecap="round" />
                                        <path d="M4 5l.5 9h7L12 5" stroke="currentColor" stroke-width="1.4"
                                            stroke-linejoin="round" />
                                    </svg>
                                    {{ __('main.archive') }}
                                </button>
                            </form>
                        </div>
                    </div>

                    {{-- Body --}}
                    <div class="prod-body">
                        <span class="prod-cat">{{ $product->category->name }}</span>
                        <h3 class="prod-name">{{ $product->name }}</h3>
                        <div class="prod-price">$ {{ number_format($product->price, 2) }}</div>
                    </div>
                </div>

            @empty
                <div class="empty-state">
                    <div class="empty-icon">
                        <svg width="26" height="26" viewBox="0 0 24 24" fill="none">
                            <path d="M5 8h14l-1.5 10H6.5L5 8z" stroke="#A8A49E" stroke-width="1.5" stroke-linejoin="round" />
                            <path d="M3 5h18" stroke="#A8A49E" stroke-width="1.5" stroke-linecap="round" />
                            <path d="M10 12v4M14 12v4" stroke="#A8A49E" stroke-width="1.5" stroke-linecap="round" />
                        </svg>
                    </div>
                    <h3>{{ __('main.no_products_found') }}</h3>
                    <p>{{ __('main.no_products_message') }}</p>
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if($products->hasPages())
            <div class="pagination-wrap">
                {{ $products->links() }}
            </div>
        @endif

    </div>

    {{-- ── EDIT MODALS ── --}}
    @foreach($products as $product)
        <div class="m-overlay" id="editModal{{ $product->id }}">
            <div class="m-box">
                <div class="m-header">
                    <h2 class="m-title">{{ __('main.edit_product') }}</h2>
                    <button class="m-close" onclick="closeModal('editModal{{ $product->id }}')">
                        <svg width="12" height="12" viewBox="0 0 16 16" fill="none">
                            <path d="M2 2l12 12M14 2L2 14" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                        </svg>
                    </button>
                </div>
                <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')
                    <div class="m-body">
                        <div class="m-field">
                            <label class="m-label">{{ __('main.product_name') }}</label>
                            <input type="text" name="name" class="m-input" value="{{ $product->name }}" required>
                        </div>
                        <div class="m-row">
                            <div class="m-field">
                                <label class="m-label">{{ __('main.unit_price') }}</label>
                                <input type="number" step="0.01" name="price" class="m-input" value="{{ $product->price }}"
                                    required>
                            </div>
                            <div class="m-field">
                                <label class="m-label">{{ __('main.stock_quantity') }}</label>
                                <input type="number" name="stock" class="m-input" value="{{ $product->stock }}" required>
                            </div>
                        </div>
                        <div class="m-field">
                            <label class="m-label">{{ __('main.category') }}</label>
                            <select name="category_id" class="m-select">
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ $product->category_id == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="m-field">
                            <label class="m-label">{{ __('main.product_image') }}</label>
                            <input type="file" name="image" class="m-file" accept="image/*">
                            <p class="m-hint">{{ __('main.leave_empty_keep_image') }}</p>
                        </div>
                    </div>
                    <div class="m-footer">
                        <button type="button" class="m-cancel"
                            onclick="closeModal('editModal{{ $product->id }}')">{{ __('main.cancel') }}</button>
                        <button type="submit" class="m-submit">{{ __('main.save_changes') }}</button>
                    </div>
                </form>
            </div>
        </div>
    @endforeach

    {{-- ── ADD MODAL ── --}}
    <div class="m-overlay" id="addProductModal">
        <div class="m-box">
            <div class="m-header">
                <h2 class="m-title">{{ __('main.add_product') }}</h2>
                <button class="m-close" onclick="closeModal('addProductModal')">
                    <svg width="12" height="12" viewBox="0 0 16 16" fill="none">
                        <path d="M2 2l12 12M14 2L2 14" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                    </svg>
                </button>
            </div>
            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="m-body">
                    <div class="m-field">
                        <label class="m-label">{{ __('main.product_name') }}</label>
                        <input type="text" name="name" class="m-input"
                            placeholder="{{ __('main.example_colombian_roast') }}" required autofocus>
                    </div>
                    <div class="m-row">
                        <div class="m-field">
                            <label class="m-label">{{ __('main.unit_price') }}</label>
                            <input type="number" step="0.01" name="price" class="m-input" placeholder="0.00" required>
                        </div>
                        <div class="m-field">
                            <label class="m-label">{{ __('main.initial_stock') }}</label>
                            <input type="number" name="stock" class="m-input" placeholder="0" required>
                        </div>
                    </div>
                    <div class="m-field">
                        <label class="m-label">{{ __('main.category') }}</label>
                        <select name="category_id" class="m-select" required>
                            <option value="" disabled selected>{{ __('main.select_category') }}</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="m-field">
                        <label class="m-label">Product image</label>
                        <input type="file" name="image" class="m-file" accept="image/*">
                        <p class="m-hint">Optional — JPG or PNG recommended.</p>
                    </div>
                </div>
                <div class="m-footer">
                    <button type="button" class="m-cancel" onclick="closeModal('addProductModal')">Cancel</button>
                    <button type="submit" class="m-submit">Add product</button>
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

        document.querySelectorAll('.m-overlay').forEach(overlay => {
            overlay.addEventListener('click', e => {
                if (e.target === overlay) closeModal(overlay.id);
            });
        });

        document.addEventListener('keydown', e => {
            if (e.key === 'Escape') {
                document.querySelectorAll('.m-overlay.open').forEach(el => closeModal(el.id));
                closeAllDropdowns();
            }
        });

        function toggleDropdown(e, id) {
            e.stopPropagation();
            const el = document.getElementById(id);
            const isOpen = el.classList.contains('open');
            closeAllDropdowns();
            if (!isOpen) el.classList.add('open');
        }

        function closeAllDropdowns() {
            document.querySelectorAll('.prod-dropdown').forEach(d => d.classList.remove('open'));
        }

        document.addEventListener('click', closeAllDropdowns);

        @if($errors->any())
            openModal('addProductModal');
        @endif
    </script>
@endsection