@extends('layouts.app')

@section('page_title', __('main.point_of_sale'))

@section('styles')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600&family=Playfair+Display:wght@600&display=swap"
        rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
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
            --accent-light: #FAEEE8;
            --accent2: #1D4E3A;
            --tag-bg: #EDE9E2;
            --tag-text: #5C5850;
            --font-display: 'Playfair Display', serif;
            --font-body: 'DM Sans', sans-serif;
            --r: 12px;
            --r-sm: 8px;
        }

        body {
            font-family: var(--font-body);
            background: var(--bg);
            color: var(--text1);
            font-size: 14px;
            overflow-x: hidden;
        }

        /* ── POS WRAPPER ── */
        .pos-wrap {
            display: grid;
            grid-template-columns: 1fr 340px;
            grid-template-rows: auto 1fr;
            min-height: calc(100vh - 68px);
            max-width: 100%;
        }

        /* ── HEADER ── */
        .pos-header {
            grid-column: 1 / -1;
            background: var(--surface);
            border-bottom: 1px solid var(--border);
            padding: 0 24px;
            display: flex;
            align-items: center;
            gap: 16px;
            height: 56px;
            position: sticky;
            top: 68px;
            z-index: 40;
        }

        .pos-logo {
            font-family: var(--font-display);
            font-size: 17px;
            color: var(--text1);
            letter-spacing: -0.3px;
            display: flex;
            align-items: center;
            gap: 8px;
            white-space: nowrap;
        }

        .pos-logo-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--accent);
            flex-shrink: 0;
        }

        .pos-header-divider {
            width: 1px;
            height: 24px;
            background: var(--border2);
            flex-shrink: 0;
        }

        .pos-date {
            font-size: 12px;
            color: var(--text3);
            letter-spacing: 0.3px;
            white-space: nowrap;
        }

        .search-wrap {
            flex: 1;
            position: relative;
            max-width: 380px;
            margin-left: auto;
        }

        .search-icon {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text3);
            pointer-events: none;
            display: flex;
        }

        .search-wrap input {
            width: 100%;
            height: 40px;
            border: 1px solid var(--border2);
            border-radius: 100px;
            padding: 0 16px 0 36px;
            font-family: var(--font-body);
            font-size: 14px;
            background: var(--bg);
            color: var(--text1);
            outline: none;
            transition: border-color 0.15s, background 0.15s;
        }

        .search-wrap input:focus {
            border-color: var(--accent);
            background: var(--surface);
        }

        /* Mobile cart toggle button in header */
        .cart-toggle-btn {
            display: none;
            position: relative;
            align-items: center;
            justify-content: center;
            width: 44px;
            height: 44px;
            border-radius: var(--r-sm);
            border: 1px solid var(--border2);
            background: var(--surface);
            color: var(--text2);
            cursor: pointer;
            flex-shrink: 0;
            transition: border-color 0.15s, color 0.15s;
        }

        .cart-toggle-btn:hover {
            border-color: var(--accent);
            color: var(--accent);
        }

        .cart-toggle-badge {
            position: absolute;
            top: -6px;
            right: -6px;
            background: var(--accent);
            color: white;
            font-size: 10px;
            font-weight: 700;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            line-height: 1;
        }

        /* ── LEFT PANEL ── */
        .pos-left {
            background: var(--bg);
            padding: 20px 24px;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            gap: 16px;
            min-width: 0;
        }

        /* Category pills */
        .cat-strip {
            display: flex;
            gap: 8px;
            flex-wrap: nowrap;
            overflow-x: auto;
            padding-bottom: 4px;
            scrollbar-width: none;
            -ms-overflow-style: none;
        }

        .cat-strip::-webkit-scrollbar {
            display: none;
        }

        .cat-pill {
            padding: 8px 16px;
            border-radius: 100px;
            border: 1px solid var(--border2);
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            background: var(--surface);
            color: var(--text2);
            transition: all 0.15s;
            letter-spacing: 0.2px;
            font-family: var(--font-body);
            white-space: nowrap;
            flex-shrink: 0;
            min-height: 36px;
        }

        .cat-pill:hover {
            border-color: var(--accent);
            color: var(--accent);
        }

        .cat-pill.active {
            background: var(--accent);
            border-color: var(--accent);
            color: #fff;
        }

        /* Product grid — responsive columns */
        .product-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
        }

        @media (min-width: 540px) {
            .product-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (min-width: 900px) {
            .product-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (min-width: 1200px) {
            .product-grid {
                grid-template-columns: repeat(4, 1fr);
            }
        }

        .product-card {
            background: var(--surface);
            border-radius: var(--r);
            border: 1px solid var(--border);
            overflow: hidden;
            cursor: pointer;
            transition: transform 0.15s, box-shadow 0.15s, border-color 0.15s;
            position: relative;
            -webkit-tap-highlight-color: transparent;
        }

        .product-card:hover {
            transform: translateY(-2px);
            border-color: var(--border2);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.07);
        }

        .product-card:active {
            transform: scale(0.97);
        }

        .product-card.out-of-stock {
            opacity: 0.5;
            pointer-events: none;
        }

        .product-img {
            width: 100%;
            aspect-ratio: 1;
            background: var(--surface2);
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .product-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .product-img-placeholder {
            font-size: 12px;
            color: var(--text3);
            letter-spacing: 0.3px;
            text-align: center;
            padding: 4px;
        }

        .product-badge {
            position: absolute;
            top: 6px;
            right: 6px;
            background: rgba(255, 255, 255, 0.92);
            border: 1px solid var(--border);
            border-radius: 100px;
            font-size: 9px;
            font-weight: 500;
            padding: 2px 6px;
            color: var(--text2);
        }

        .product-badge.low {
            background: #FEF3C7;
            color: #92400E;
            border-color: rgba(146, 64, 14, 0.15);
        }

        .product-badge.out {
            background: #FEE2E2;
            color: #991B1B;
            border-color: rgba(153, 27, 27, 0.15);
        }

        .product-info {
            padding: 10px 12px 12px;
            border-top: 1px solid var(--border);
        }

        .product-name {
            font-size: 12px;
            font-weight: 500;
            color: var(--text1);
            margin-bottom: 4px;
            line-height: 1.3;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .product-price {
            font-size: 13px;
            font-weight: 600;
            color: var(--accent);
        }

        .add-ripple {
            position: absolute;
            bottom: 8px;
            right: 8px;
            width: 26px;
            height: 26px;
            border-radius: 50%;
            background: var(--accent);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 18px;
            line-height: 1;
            opacity: 0;
            transition: opacity 0.15s;
        }

        .product-card:hover .add-ripple {
            opacity: 1;
        }

        /* Always show add button on touch devices */
        @media (hover: none) {
            .add-ripple {
                opacity: 0.85;
            }
        }

        /* ── RIGHT CART PANEL ── */
        .pos-right {
            background: var(--surface);
            border-left: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            height: calc(100vh - 124px);
            /* topbar + pos-header */
            position: sticky;
            top: 124px;
        }

        .cart-header {
            padding: 16px 20px 14px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-shrink: 0;
        }

        .cart-title {
            font-family: var(--font-display);
            font-size: 16px;
            color: var(--text1);
        }

        .cart-header-right {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .cart-count {
            background: var(--accent);
            color: white;
            font-size: 11px;
            font-weight: 600;
            padding: 2px 8px;
            border-radius: 100px;
            min-width: 22px;
            text-align: center;
        }

        /* Close button for mobile drawer */
        .cart-close-btn {
            display: none;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            border: 1px solid var(--border2);
            background: var(--bg);
            color: var(--text2);
            cursor: pointer;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            transition: background 0.15s, color 0.15s;
            flex-shrink: 0;
        }

        .cart-close-btn:hover {
            background: #FCEBEB;
            color: #E24B4A;
        }

        .cart-items {
            flex: 1;
            overflow-y: auto;
            padding: 0 20px;
            -webkit-overflow-scrolling: touch;
        }

        .cart-empty {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 8px;
            height: 140px;
            color: var(--text3);
            font-size: 13px;
        }

        .cart-empty-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--tag-bg);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
        }

        .cart-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 0;
            border-bottom: 1px solid var(--border);
            animation: slideIn 0.18s ease;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(8px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .cart-item-thumb {
            width: 38px;
            height: 38px;
            background: var(--bg);
            border-radius: var(--r-sm);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            flex-shrink: 0;
            overflow: hidden;
        }

        .cart-item-thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .cart-item-info {
            flex: 1;
            min-width: 0;
        }

        .cart-item-name {
            font-size: 12px;
            font-weight: 500;
            color: var(--text1);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .cart-item-unit {
            font-size: 11px;
            color: var(--text3);
            margin-top: 1px;
        }

        .qty-ctrl {
            display: flex;
            align-items: center;
            gap: 4px;
            background: var(--bg);
            border-radius: 100px;
            padding: 2px 4px;
            flex-shrink: 0;
        }

        .qty-btn {
            width: 28px;
            height: 28px;
            border: none;
            background: none;
            cursor: pointer;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            color: var(--text2);
            line-height: 1;
            transition: background 0.1s;
            font-family: var(--font-body);
            /* Touch-friendly minimum size */
            min-width: 28px;
            min-height: 28px;
        }

        .qty-btn:hover {
            background: rgba(0, 0, 0, 0.08);
        }

        .qty-num {
            font-size: 13px;
            font-weight: 600;
            min-width: 18px;
            text-align: center;
            color: var(--text1);
        }

        .cart-item-total {
            font-size: 13px;
            font-weight: 600;
            color: var(--text1);
            min-width: 48px;
            text-align: right;
            flex-shrink: 0;
        }

        /* Cart footer */
        .cart-footer {
            padding: 14px 20px 20px;
            border-top: 1px solid var(--border);
            flex-shrink: 0;
        }

        .field-label {
            font-size: 11px;
            font-weight: 500;
            color: var(--text3);
            text-transform: uppercase;
            letter-spacing: 0.7px;
            margin-bottom: 5px;
        }

        .customer-row {
            margin-bottom: 12px;
        }

        .styled-select {
            width: 100%;
            height: 40px;
            border: 1px solid var(--border2);
            border-radius: var(--r-sm);
            padding: 0 10px;
            font-family: var(--font-body);
            font-size: 14px;
            color: var(--text1);
            background: var(--bg);
            outline: none;
            cursor: pointer;
            transition: border-color 0.15s;
        }

        .styled-select:focus {
            border-color: var(--accent);
        }

        .totals-block {
            background: var(--bg);
            border-radius: var(--r-sm);
            padding: 12px 14px;
            margin-bottom: 12px;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 12px;
            color: var(--text2);
            margin-bottom: 6px;
        }

        .total-row:last-child {
            margin-bottom: 0;
        }

        .total-row.grand {
            font-size: 15px;
            font-weight: 600;
            color: var(--text1);
            padding-top: 8px;
            margin-top: 4px;
            border-top: 1px solid var(--border2);
        }

        .cash-row {
            margin-bottom: 10px;
        }

        .cash-input-wrap {
            position: relative;
        }

        .cash-symbol {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 13px;
            color: var(--text3);
            font-weight: 500;
            pointer-events: none;
        }

        .cash-input-wrap input {
            width: 100%;
            height: 44px;
            border: 1px solid var(--border2);
            border-radius: var(--r-sm);
            padding: 0 12px 0 28px;
            font-family: var(--font-body);
            font-size: 15px;
            font-weight: 500;
            color: var(--text1);
            background: var(--bg);
            outline: none;
            transition: border-color 0.15s, background 0.15s;
        }

        .cash-input-wrap input:focus {
            border-color: var(--accent);
            background: var(--surface);
        }

        .change-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 12px;
            margin-bottom: 14px;
            padding: 0 2px;
        }

        .change-label {
            color: var(--text3);
        }

        .change-amount {
            font-size: 14px;
            font-weight: 600;
            color: var(--accent2);
            transition: color 0.15s;
        }

        .change-amount.insufficient {
            color: #E24B4A;
        }

        .checkout-btn {
            width: 100%;
            height: 50px;
            background: var(--accent);
            color: white;
            border: none;
            border-radius: var(--r);
            font-family: var(--font-body);
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: opacity 0.15s, transform 0.1s;
            letter-spacing: 0.2px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            min-height: 50px;
        }

        .checkout-btn:hover:not(:disabled) {
            opacity: 0.88;
        }

        .checkout-btn:active:not(:disabled) {
            transform: scale(0.99);
        }

        .checkout-btn:disabled {
            background: var(--tag-bg);
            color: var(--text3);
            cursor: not-allowed;
        }

        .clear-btn {
            width: 100%;
            height: 40px;
            background: none;
            color: var(--text3);
            border: none;
            font-family: var(--font-body);
            font-size: 13px;
            cursor: pointer;
            margin-top: 8px;
            border-radius: var(--r-sm);
            transition: color 0.15s, background 0.15s;
            min-height: 40px;
        }

        .clear-btn:hover {
            color: #E24B4A;
            background: #FCEBEB;
        }

        /* ── MOBILE CART DRAWER OVERLAY ── */
        #cart-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.45);
            z-index: 300;
            backdrop-filter: blur(2px);
            -webkit-backdrop-filter: blur(2px);
        }

        #cart-overlay.active {
            display: block;
        }

        /* ── RESPONSIVE BREAKPOINTS ── */

        /* Tablet: 768px – 1023px */
        @media (max-width: 1023px) {
            .pos-wrap {
                grid-template-columns: 1fr 300px;
            }

            .pos-right {
                height: calc(100vh - 128px);
                top: 128px;
            }
        }

        /* Mobile: < 768px */
        @media (max-width: 767px) {
            /* Full-width single column layout */
            .pos-wrap {
                grid-template-columns: 1fr;
                grid-template-rows: auto 1fr;
                min-height: calc(100vh - 60px);
            }

            /* Header adjustments */
            .pos-header {
                padding: 0 14px;
                height: 52px;
                top: 60px;
                gap: 10px;
            }

            .pos-logo {
                font-size: 14px;
            }

            .pos-header-divider,
            .pos-date {
                display: none;
            }

            .search-wrap {
                margin-left: 0;
                max-width: none;
            }

            .search-wrap input {
                height: 38px;
                font-size: 14px;
            }

            /* Show cart toggle button */
            .cart-toggle-btn {
                display: flex;
            }

            /* Left panel full width */
            .pos-left {
                padding: 14px 14px 100px;
                /* bottom padding for FAB clearance */
                grid-column: 1;
            }

            /* Product grid: 2 columns on mobile */
            .product-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 10px;
            }

            /* Cart panel becomes a bottom drawer on mobile */
            .pos-right {
                position: fixed;
                bottom: 0;
                left: 0;
                right: 0;
                top: auto;
                height: 85vh;
                max-height: 85vh;
                border-left: none;
                border-top: 1px solid var(--border);
                border-radius: 20px 20px 0 0;
                z-index: 350;
                transform: translateY(100%);
                transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                box-shadow: 0 -8px 40px rgba(0, 0, 0, 0.15);
            }

            .pos-right.drawer-open {
                transform: translateY(0);
            }

            /* Show close button in mobile drawer */
            .cart-close-btn {
                display: flex;
            }

            /* Drawer handle indicator */
            .cart-header::before {
                content: '';
                position: absolute;
                top: 8px;
                left: 50%;
                transform: translateX(-50%);
                width: 36px;
                height: 4px;
                background: var(--border2);
                border-radius: 2px;
            }

            .cart-header {
                position: relative;
                padding-top: 22px;
            }

            /* Larger touch targets for qty buttons on mobile */
            .qty-btn {
                width: 36px;
                height: 36px;
                min-width: 36px;
                min-height: 36px;
                font-size: 18px;
            }

            .qty-ctrl {
                padding: 2px 6px;
                gap: 2px;
            }

            /* Larger checkout button */
            .checkout-btn {
                height: 54px;
                font-size: 16px;
            }

            /* Larger select */
            .styled-select {
                height: 44px;
                font-size: 15px;
            }

            /* Cat pills scrollable row */
            .cat-strip {
                flex-wrap: nowrap;
                overflow-x: auto;
            }

            .cat-pill {
                min-height: 38px;
                padding: 8px 16px;
            }
        }

        /* Very small screens: < 375px */
        @media (max-width: 374px) {
            .product-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 8px;
            }

            .pos-left {
                padding: 12px 10px 100px;
            }

            .product-info {
                padding: 8px 10px 10px;
            }

            .product-name {
                font-size: 11px;
            }

            .product-price {
                font-size: 12px;
            }
        }
    </style>
@endsection

@section('content')
    {{-- Mobile cart overlay --}}
    <div id="cart-overlay"></div>

    <div class="pos-wrap">

        {{-- ── HEADER ── --}}
        <div class="pos-header">
            <div class="pos-logo">
                <div class="pos-logo-dot"></div>
                {{ __('main.point_of_sale') }}
            </div>
            <div class="pos-header-divider"></div>
            <span class="pos-date" id="pos-date"></span>
            <div class="search-wrap max-sm:w-full">
                <span class="search-icon">
                    <svg width="14" height="14" viewBox="0 0 16 16" fill="none">
                        <circle cx="6.5" cy="6.5" r="5" stroke="currentColor" stroke-width="1.5" />
                        <path d="M11 11l3.5 3.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                    </svg>
                </span>
                <input type="text" id="search-product" placeholder="{{ __('main.search_products') }}">
            </div>
            {{-- Mobile cart toggle button --}}
            <button class="cart-toggle-btn max-sm:min-h-[44px]" id="cart-toggle-btn" aria-label="View order">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                    <path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                    <line x1="3" y1="6" x2="21" y2="6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                    <path d="M16 10a4 4 0 01-8 0" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <span class="cart-toggle-badge" id="cart-toggle-badge">0</span>
            </button>
        </div>

        {{-- ── LEFT: PRODUCTS ── --}}
        <div class="pos-left">

            {{-- Category filter --}}
            <div class="cat-strip">
                <button class="cat-pill active filter-cat max-sm:min-h-[44px]" data-cat="all">{{ __('main.all_items') }}</button>
                @foreach($categories as $cat)
                    <button class="cat-pill filter-cat max-sm:min-h-[44px]" data-cat="{{ $cat->id }}">{{ $cat->name }}</button>
                @endforeach
            </div>

            {{-- Product grid --}}
            <div class="product-grid max-sm:grid-cols-2" id="product-grid">
                @foreach($products as $product)
                    <div class="product-card product-item {{ $product->stock <= 0 ? 'out-of-stock' : '' }}"
                        data-cat="{{ $product->category_id }}" data-name="{{ strtolower($product->name) }}"
                        onclick="addToCart({{ $product->id }}, '{{ addslashes($product->name) }}', {{ $product->price }}, {{ $product->stock }}, '{{ $product->image ? asset('storage/' . $product->image) : '' }}')">

                        <div class="product-img">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" loading="lazy">
                            @else
                                <span class="product-img-placeholder">{{ __('main.no_image') }}</span>
                            @endif

                            @if($product->stock <= 0)
                                <span class="product-badge out">{{ __('main.out_of_stock') }}</span>
                            @elseif($product->stock <= 5)
                                <span class="product-badge low">{{ __('main.only_left', ['count' => $product->stock]) }}</span>
                            @endif
                        </div>

                        <div class="product-info">
                            <div class="product-name">{{ $product->name }}</div>
                            <div class="product-price">$ {{ number_format($product->price, 2) }}</div>
                        </div>

                        <div class="add-ripple">+</div>
                    </div>
                @endforeach
            </div>

        </div>

        {{-- ── RIGHT: CART ── --}}
        <div class="pos-right max-sm:fixed max-sm:bottom-0 max-sm:w-full max-sm:h-[85vh] max-sm:rounded-t-2xl max-sm:z-[350] max-sm:translate-y-full" id="pos-right">

            <div class="cart-header">
                <span class="cart-title">{{ __('main.current_order') }}</span>
                <div class="cart-header-right">
                    <span class="cart-count" id="cart-count">0</span>
                    <button class="cart-close-btn max-sm:min-h-[44px]" id="cart-close-btn" aria-label="Close order panel">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>

            <div class="cart-items" id="cart-list">
                <div class="cart-empty" id="empty-cart-msg">
                    <div class="cart-empty-icon">🛒</div>
                    <span>{{ __('main.add_items_start') }}</span>
                </div>
            </div>

            <div class="cart-footer">

                <div class="customer-row">
                    <div class="field-label">{{ __('main.customer') }}</div>
                    <select id="select-customer" class="styled-select">
                        <option value="">{{ __('main.walk_in_guest') }}</option>
                        @foreach($customers as $cust)
                            <option value="{{ $cust->id }}">{{ $cust->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="totals-block">
                    <div class="total-row">
                        <span>{{ __('main.subtotal') }}</span>
                        <span id="val-subtotal">$ 0.00</span>
                    </div>
                    <div class="total-row">
                        <span>{{ __('main.tax') }} (10%)</span>
                        <span id="val-tax">$ 0.00</span>
                    </div>
                    <div class="total-row grand">
                        <span>{{ __('main.total') }}</span>
                        <span id="val-total">$ 0.00</span>
                    </div>
                </div>

                <div class="cash-row">
                    <div class="field-label">{{ __('main.cash_received') }}</div>
                    <div class="cash-input-wrap">
                        <span class="cash-symbol">$</span>
                        <input type="number" step="0.01" id="cash-received" placeholder="0.00" inputmode="decimal">
                    </div>
                </div>

                <div class="change-row">
                    <span class="change-label">{{ __('main.change_due') }}</span>
                    <span class="change-amount" id="val-change">$ 0.00</span>
                </div>

                <button class="checkout-btn max-sm:min-h-[44px]" id="checkout-btn" disabled>
                    <svg width="15" height="15" viewBox="0 0 16 16" fill="none">
                        <path d="M2 8h12M9 4l4 4-4 4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                    {{ __('main.process_checkout') }}
                </button>
                <button class="clear-btn max-sm:min-h-[44px]" onclick="clearCart()">{{ __('main.clear_order') }}</button>

            </div>
        </div>

    </div>
@endsection

@section('scripts')
    <script>
        let cart = [];
        const TAX_RATE = 0.1;
        const currentLocale = '{{ app()->getLocale() }}';

        /* ── Date ── */
        function updatePOSDate() {
            const dateOptions = {
                weekday: 'short',
                month: 'short',
                day: 'numeric',
                year: 'numeric'
            };
            const localeMap = {
                'en': 'en-US',
                'km': 'km-KH',
                'ja': 'ja-JP',
                'zh-CN': 'zh-CN'
            };
            const locale = localeMap[currentLocale] || 'en-US';
            const dateEl = document.getElementById('pos-date');
            if (dateEl) dateEl.textContent = new Date().toLocaleDateString(locale, dateOptions);
        }
        updatePOSDate();

        /* ── Text translations ── */
        const posTranslations = {
            maxStockReached: '{{ __('main.max_stock_reached') }}',
            noImage: '{{ __('main.no_image') }}',
            each: '{{ __('main.each') }}'
        };

        /* ── Mobile cart drawer ── */
        const cartPanel   = document.getElementById('pos-right');
        const cartOverlay = document.getElementById('cart-overlay');
        const cartToggle  = document.getElementById('cart-toggle-btn');
        const cartClose   = document.getElementById('cart-close-btn');

        function isMobile() {
            return window.innerWidth < 768;
        }

        function openCartDrawer() {
            if (!isMobile()) return;
            cartPanel.classList.add('drawer-open');
            cartOverlay.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeCartDrawer() {
            cartPanel.classList.remove('drawer-open');
            cartOverlay.classList.remove('active');
            document.body.style.overflow = '';
        }

        cartToggle?.addEventListener('click', openCartDrawer);
        cartClose?.addEventListener('click', closeCartDrawer);
        cartOverlay?.addEventListener('click', closeCartDrawer);

        // Close drawer on resize to desktop
        window.addEventListener('resize', () => {
            if (!isMobile()) {
                closeCartDrawer();
            }
        });

        /* ── Add to cart ── */
        function addToCart(id, name, price, stock, image) {
            if (stock <= 0) return;
            const existing = cart.find(i => i.id === id);
            if (existing) {
                if (existing.quantity < stock) existing.quantity++;
                else { alert(posTranslations.maxStockReached); return; }
            } else {
                cart.push({ id, name, price, quantity: 1, maxStock: stock, image });
            }
            renderCart();
            // On mobile, briefly flash the cart badge to indicate item added
            if (isMobile()) {
                const badge = document.getElementById('cart-toggle-badge');
                if (badge) {
                    badge.style.transform = 'scale(1.4)';
                    setTimeout(() => { badge.style.transform = ''; }, 200);
                }
            }
        }

        /* ── Qty change ── */
        function changeQty(id, delta) {
            const idx = cart.findIndex(i => i.id === id);
            if (idx === -1) return;
            cart[idx].quantity += delta;
            if (cart[idx].quantity <= 0) cart.splice(idx, 1);
            renderCart();
        }

        /* ── Render cart ── */
        function renderCart() {
            const list     = document.getElementById('cart-list');
            const empty    = document.getElementById('empty-cart-msg');
            const countEl  = document.getElementById('cart-count');
            const badgeEl  = document.getElementById('cart-toggle-badge');

            const totalItems = cart.reduce((s, i) => s + i.quantity, 0);
            countEl.textContent = totalItems;
            if (badgeEl) badgeEl.textContent = totalItems;

            /* remove old rows */
            list.querySelectorAll('.cart-item').forEach(el => el.remove());

            if (cart.length === 0) {
                empty.style.display = 'flex';
                document.getElementById('checkout-btn').disabled = true;
                document.getElementById('val-subtotal').textContent = '$ 0.00';
                document.getElementById('val-tax').textContent      = '$ 0.00';
                document.getElementById('val-total').textContent    = '$ 0.00';
                updateChange();
                return;
            }

            empty.style.display = 'none';
            document.getElementById('checkout-btn').disabled = false;

            let subtotal = 0;

            cart.forEach(item => {
                const itemTotal = item.price * item.quantity;
                subtotal += itemTotal;

                const thumb = item.image
                    ? `<img src="${item.image}" alt="${item.name}">`
                    : `<span style="font-size:18px">📦</span>`;

                const div = document.createElement('div');
                div.className = 'cart-item';
                div.innerHTML = `
                    <div class="cart-item-thumb">${thumb}</div>
                    <div class="cart-item-info">
                        <div class="cart-item-name">${item.name}</div>
                        <div class="cart-item-unit">${item.price.toFixed(2)} ${posTranslations.each}</div>
                    </div>
                    <div class="qty-ctrl">
                        <button class="qty-btn max-sm:min-h-[44px]" onclick="changeQty(${item.id}, -1)" aria-label="Decrease">−</button>
                        <span class="qty-num">${item.quantity}</span>
                        <button class="qty-btn max-sm:min-h-[44px]" onclick="changeQty(${item.id}, 1)" aria-label="Increase">+</button>
                    </div>
                    <div class="cart-item-total">${itemTotal.toFixed(2)}</div>
                `;
                list.insertBefore(div, empty);
            });

            const tax   = subtotal * TAX_RATE;
            const total = subtotal + tax;

            document.getElementById('val-subtotal').textContent = '$ ' + subtotal.toFixed(2);
            document.getElementById('val-tax').textContent      = '$ ' + tax.toFixed(2);
            document.getElementById('val-total').textContent    = '$ ' + total.toFixed(2);

            updateChange();
        }

        /* ── Change calculation ── */
        function updateChange() {
            const total    = parseFloat(document.getElementById('val-total').textContent.replace('$ ', '')) || 0;
            const received = parseFloat(document.getElementById('cash-received').value) || 0;
            const change   = received - total;
            const el       = document.getElementById('val-change');
            el.textContent = '$ ' + Math.max(0, change).toFixed(2);
            el.classList.toggle('insufficient', received > 0 && change < 0);
        }

        document.getElementById('cash-received').addEventListener('input', updateChange);

        /* ── Clear cart ── */
        function clearCart() {
            if (!confirm('Clear the current order?')) return;
            cart = [];
            document.getElementById('cash-received').value = '';
            renderCart();
            closeCartDrawer();
        }

        /* ── Category filter ── */
        document.querySelectorAll('.filter-cat').forEach(btn => {
            btn.addEventListener('click', function () {
                document.querySelectorAll('.filter-cat').forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                const cat = this.dataset.cat;
                document.querySelectorAll('.product-item').forEach(card => {
                    card.style.display = (cat === 'all' || card.dataset.cat === cat) ? '' : 'none';
                });
            });
        });

        /* ── Search ── */
        document.getElementById('search-product').addEventListener('input', function () {
            const term = this.value.toLowerCase();
            document.querySelectorAll('.product-item').forEach(card => {
                card.style.display = card.dataset.name.includes(term) ? '' : 'none';
            });
        });

        /* ── Checkout ── */
        document.getElementById('checkout-btn').addEventListener('click', function () {
            const total    = parseFloat(document.getElementById('val-total').textContent.replace('$ ', '')) || 0;
            const received = parseFloat(document.getElementById('cash-received').value) || 0;

            if (received < total) {
                alert('Cash received is less than the total amount.');
                return;
            }

            const btn = this;
            btn.disabled = true;
            btn.textContent = 'Processing…';

            fetch("{{ route('pos.order') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    customer_id: document.getElementById('select-customer').value,
                    items: cart,
                    total_amount: total,
                    cash_received: received
                })
            })
            .then(res => {
                if (!res.ok) throw new Error('Server error');
                return res.json();
            })
            .then(() => {
                window.location.href = "{{ route('orders.index') }}";
            })
            .catch(() => {
                alert('Something went wrong. Please try again.');
                btn.disabled = false;
                btn.innerHTML = `
                    <svg width="15" height="15" viewBox="0 0 16 16" fill="none">
                        <path d="M2 8h12M9 4l4 4-4 4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    {{ __('main.process_checkout') }}`;
            });
        });
    </script>
@endsection