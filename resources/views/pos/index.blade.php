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
        }

        .pos-wrap {
            display: grid;
            grid-template-columns: 1fr 340px;
            grid-template-rows: auto 1fr;
            min-height: calc(100vh - 56px);
            /* adjust to your navbar height */
        }

        /* ── HEADER ── */
        .pos-header {
            grid-column: 1 / -1;
            background: var(--surface);
            border-bottom: 1px solid var(--border);
            padding: 0 24px;
            display: flex;
            align-items: center;
            gap: 20px;
            height: 58px;
        }

        .pos-logo {
            font-family: var(--font-display);
            font-size: 18px;
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
            height: 36px;
            border: 1px solid var(--border2);
            border-radius: 100px;
            padding: 0 16px 0 36px;
            font-family: var(--font-body);
            font-size: 13px;
            background: var(--bg);
            color: var(--text1);
            outline: none;
            transition: border-color 0.15s, background 0.15s;
        }

        .search-wrap input:focus {
            border-color: var(--accent);
            background: var(--surface);
        }

        /* ── LEFT PANEL ── */
        .pos-left {
            background: var(--bg);
            padding: 20px 24px;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        /* Category pills */
        .cat-strip {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .cat-pill {
            padding: 6px 14px;
            border-radius: 100px;
            border: 1px solid var(--border2);
            font-size: 12px;
            font-weight: 500;
            cursor: pointer;
            background: var(--surface);
            color: var(--text2);
            transition: all 0.15s;
            letter-spacing: 0.2px;
            font-family: var(--font-body);
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

        /* Product grid */
        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 12px;
        }

        .product-card {
            background: var(--surface);
            border-radius: var(--r);
            border: 1px solid var(--border);
            overflow: hidden;
            cursor: pointer;
            transition: transform 0.15s, box-shadow 0.15s, border-color 0.15s;
            position: relative;
        }

        .product-card:hover {
            transform: translateY(-2px);
            border-color: var(--border2);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.07);
        }

        .product-card:active {
            transform: scale(0.98);
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
            font-size: 13px;
            color: var(--text3);
            letter-spacing: 0.3px;
        }

        .product-badge {
            position: absolute;
            top: 8px;
            right: 8px;
            background: rgba(255, 255, 255, 0.92);
            border: 1px solid var(--border);
            border-radius: 100px;
            font-size: 10px;
            font-weight: 500;
            padding: 2px 8px;
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
            font-size: 14px;
            font-weight: 600;
            color: var(--accent);
        }

        .add-ripple {
            position: absolute;
            bottom: 8px;
            right: 8px;
            width: 22px;
            height: 22px;
            border-radius: 50%;
            background: var(--accent);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 16px;
            line-height: 1;
            opacity: 0;
            transition: opacity 0.15s;
        }

        .product-card:hover .add-ripple {
            opacity: 1;
        }

        /* ── RIGHT CART PANEL ── */
        .pos-right {
            background: var(--surface);
            border-left: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            height: calc(100vh - 114px);
            /* pos-header + your nav */
            position: sticky;
            top: 56px;
            /* your navbar height */
        }

        .cart-header {
            padding: 18px 20px 14px;
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

        .cart-items {
            flex: 1;
            overflow-y: auto;
            padding: 0 20px;
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
            gap: 12px;
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
            width: 36px;
            height: 36px;
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
            gap: 6px;
            background: var(--bg);
            border-radius: 100px;
            padding: 3px 6px;
            flex-shrink: 0;
        }

        .qty-btn {
            width: 20px;
            height: 20px;
            border: none;
            background: none;
            cursor: pointer;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 15px;
            color: var(--text2);
            line-height: 1;
            transition: background 0.1s;
            font-family: var(--font-body);
        }

        .qty-btn:hover {
            background: rgba(0, 0, 0, 0.08);
        }

        .qty-num {
            font-size: 12px;
            font-weight: 600;
            min-width: 16px;
            text-align: center;
            color: var(--text1);
        }

        .cart-item-total {
            font-size: 13px;
            font-weight: 600;
            color: var(--text1);
            min-width: 52px;
            text-align: right;
            flex-shrink: 0;
        }

        /* Cart footer */
        .cart-footer {
            padding: 16px 20px 20px;
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
            margin-bottom: 14px;
        }

        .styled-select {
            width: 100%;
            height: 34px;
            border: 1px solid var(--border2);
            border-radius: var(--r-sm);
            padding: 0 10px;
            font-family: var(--font-body);
            font-size: 13px;
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
            height: 38px;
            border: 1px solid var(--border2);
            border-radius: var(--r-sm);
            padding: 0 12px 0 28px;
            font-family: var(--font-body);
            font-size: 14px;
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
            height: 46px;
            background: var(--accent);
            color: white;
            border: none;
            border-radius: var(--r);
            font-family: var(--font-body);
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: opacity 0.15s, transform 0.1s;
            letter-spacing: 0.2px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
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
            height: 34px;
            background: none;
            color: var(--text3);
            border: none;
            font-family: var(--font-body);
            font-size: 12px;
            cursor: pointer;
            margin-top: 8px;
            border-radius: var(--r-sm);
            transition: color 0.15s, background 0.15s;
        }

        .clear-btn:hover {
            color: #E24B4A;
            background: #FCEBEB;
        }
    </style>
@endsection

@section('content')
    <div class="pos-wrap">

        {{-- ── HEADER ── --}}
        <div class="pos-header">
            <div class="pos-logo">
                <div class="pos-logo-dot"></div>
                {{ __('main.point_of_sale') }}
            </div>
            <div class="pos-header-divider"></div>
            <span class="pos-date" id="pos-date"></span>
            <div class="search-wrap">
                <span class="search-icon">
                    <svg width="14" height="14" viewBox="0 0 16 16" fill="none">
                        <circle cx="6.5" cy="6.5" r="5" stroke="currentColor" stroke-width="1.5" />
                        <path d="M11 11l3.5 3.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                    </svg>
                </span>
                <input type="text" id="search-product" placeholder="{{ __('main.search_products') }}">
            </div>
        </div>

        {{-- ── LEFT: PRODUCTS ── --}}
        <div class="pos-left">

            {{-- Category filter --}}
            <div class="cat-strip">
                <button class="cat-pill active filter-cat" data-cat="all">{{ __('main.all_items') }}</button>
                @foreach($categories as $cat)
                    <button class="cat-pill filter-cat" data-cat="{{ $cat->id }}">{{ $cat->name }}</button>
                @endforeach
            </div>

            {{-- Product grid --}}
            <div class="product-grid" id="product-grid">
                @foreach($products as $product)
                    <div class="product-card product-item {{ $product->stock <= 0 ? 'out-of-stock' : '' }}"
                        data-cat="{{ $product->category_id }}" data-name="{{ strtolower($product->name) }}"
                        onclick="addToCart({{ $product->id }}, '{{ addslashes($product->name) }}', {{ $product->price }}, {{ $product->stock }}, '{{ $product->image ? asset('storage/' . $product->image) : '' }}')">

                        <div class="product-img">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
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
        <div class="pos-right">

            <div class="cart-header">
                <span class="cart-title">{{ __('main.current_order') }}</span>
                <span class="cart-count" id="cart-count">0</span>
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
                        <input type="number" step="0.01" id="cash-received" placeholder="0.00">
                    </div>
                </div>

                <div class="change-row">
                    <span class="change-label">{{ __('main.change_due') }}</span>
                    <span class="change-amount" id="val-change">$ 0.00</span>
                </div>

                <button class="checkout-btn" id="checkout-btn" disabled>
                    <svg width="15" height="15" viewBox="0 0 16 16" fill="none">
                        <path d="M2 8h12M9 4l4 4-4 4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                    {{ __('main.process_checkout') }}
                </button>
                <button class="clear-btn" onclick="clearCart()">{{ __('main.clear_order') }}</button>

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
            // Use locale-appropriate date format
            const localeMap = {
                'en': 'en-US',
                'km': 'km-KH',
                'ja': 'ja-JP',
                'zh-CN': 'zh-CN'
            };
            const locale = localeMap[currentLocale] || 'en-US';
            document.getElementById('pos-date').textContent = new Date().toLocaleDateString(locale, dateOptions);
        }
        updatePOSDate();

        /* ── Text translations ── */
        const posTranslations = {
            maxStockReached: '{{ __('main.max_stock_reached') }}',
            noImage: '{{ __('main.no_image') }}',
            each: '{{ __('main.each') }}'
        };

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
            const list = document.getElementById('cart-list');
            const empty = document.getElementById('empty-cart-msg');
            const countEl = document.getElementById('cart-count');

            const totalItems = cart.reduce((s, i) => s + i.quantity, 0);
            countEl.textContent = totalItems;

            /* remove old rows */
            list.querySelectorAll('.cart-item').forEach(el => el.remove());

            if (cart.length === 0) {
                empty.style.display = 'flex';
                document.getElementById('checkout-btn').disabled = true;
                document.getElementById('val-subtotal').textContent = '$ 0.00';
                document.getElementById('val-tax').textContent = '$ 0.00';
                document.getElementById('val-total').textContent = '$ 0.00';
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
                                        <div class="cart-item-unit">$${item.price.toFixed(2)} ${posTranslations.each}</div>
                                    </div>
                                    <div class="qty-ctrl">
                                        <button class="qty-btn" onclick="changeQty(${item.id}, -1)">−</button>
                                        <span class="qty-num">${item.quantity}</span>
                                        <button class="qty-btn" onclick="changeQty(${item.id}, 1)">+</button>
                                    </div>
                                    <div class="cart-item-total">$${itemTotal.toFixed(2)}</div>
                                `;
                list.insertBefore(div, empty);
            });

            const tax = subtotal * TAX_RATE;
            const total = subtotal + tax;

            document.getElementById('val-subtotal').textContent = '$ ' + subtotal.toFixed(2);
            document.getElementById('val-tax').textContent = '$ ' + tax.toFixed(2);
            document.getElementById('val-total').textContent = '$ ' + total.toFixed(2);

            updateChange();
        }

        /* ── Change calculation ── */
        function updateChange() {
            const total = parseFloat(document.getElementById('val-total').textContent.replace('$ ', '')) || 0;
            const received = parseFloat(document.getElementById('cash-received').value) || 0;
            const change = received - total;
            const el = document.getElementById('val-change');
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
            const total = parseFloat(document.getElementById('val-total').textContent.replace('$ ', '')) || 0;
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
                                    Process Checkout`;
                });
        });
    </script>
@endsection