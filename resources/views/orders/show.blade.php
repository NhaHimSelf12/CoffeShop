@extends('layouts.app')

@section('page_title', 'Order Details')

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
            --border2: rgba(0, 0, 0, 0.13);
            --text1: #1A1814;
            --text2: #6B6760;
            --text3: #A8A49E;
            --accent: #C4501A;
            --accent-lt: #FAEEE8;
            --green: #1D4E3A;
            --green-lt: #E3EFE9;
            --gold: #92621A;
            --gold-lt: #FEF3DC;
            --tag-bg: #EDE9E2;
            --font-d: 'Playfair Display', serif;
            --font-b: 'DM Sans', sans-serif;
            --r: 12px;
            --r-sm: 8px;
            --r-pill: 100px;
        }

        .detail-page {
            font-family: var(--font-b);
            background: var(--bg);
            min-height: 100vh;
            padding: 32px 28px 56px;
            color: var(--text1);
        }

        /* ── PAGE HEADER ── */
        .page-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            margin-bottom: 28px;
            gap: 16px;
            flex-wrap: wrap;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 12px;
            font-weight: 500;
            color: var(--text3);
            text-decoration: none;
            margin-bottom: 10px;
            transition: color 0.15s;
        }

        .back-link:hover {
            color: var(--accent);
        }

        .page-eyebrow {
            font-size: 11px;
            font-weight: 500;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: var(--accent);
            margin-bottom: 4px;
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

        .header-actions {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-shrink: 0;
            padding-top: 4px;
        }

        .btn-print {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 9px 18px;
            background: var(--surface);
            border: 1px solid var(--border2);
            border-radius: var(--r);
            font-family: var(--font-b);
            font-size: 13px;
            font-weight: 500;
            color: var(--text2);
            cursor: pointer;
            text-decoration: none;
            transition: border-color 0.15s, color 0.15s;
        }

        .btn-print:hover {
            border-color: var(--accent);
            color: var(--accent);
        }

        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 9px 18px;
            background: var(--accent);
            border: none;
            border-radius: var(--r);
            font-family: var(--font-b);
            font-size: 13px;
            font-weight: 600;
            color: #fff;
            text-decoration: none;
            cursor: pointer;
            transition: opacity 0.15s;
        }

        .btn-back:hover {
            opacity: 0.88;
            color: #fff;
        }

        /* ── LAYOUT ── */
        .detail-layout {
            display: grid;
            grid-template-columns: 1fr 320px;
            gap: 16px;
            align-items: start;
        }

        @media (max-width: 768px) {
            .detail-layout {
                grid-template-columns: 1fr;
            }
        }

        /* ── CARDS ── */
        .d-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--r);
            overflow: hidden;
            margin-bottom: 16px;
        }

        .d-card:last-child {
            margin-bottom: 0;
        }

        .d-card-header {
            padding: 14px 20px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .d-card-title {
            font-family: var(--font-d);
            font-size: 15px;
            color: var(--text1);
            margin: 0;
        }

        .item-count-badge {
            background: var(--tag-bg);
            color: var(--text2);
            font-size: 11px;
            font-weight: 600;
            padding: 3px 9px;
            border-radius: var(--r-pill);
        }

        /* ── ITEMS TABLE ── */
        .items-table {
            width: 100%;
            border-collapse: collapse;
        }

        .items-table thead tr {
            background: var(--bg);
            border-bottom: 1px solid var(--border2);
        }

        .items-table th {
            padding: 10px 16px;
            font-size: 10.5px;
            font-weight: 600;
            letter-spacing: 0.8px;
            text-transform: uppercase;
            color: var(--text3);
            text-align: left;
        }

        .items-table th.right {
            text-align: right;
        }

        .items-table th.center {
            text-align: center;
        }

        .items-table th:first-child {
            padding-left: 20px;
        }

        .items-table th:last-child {
            padding-right: 20px;
        }

        .items-table tbody tr {
            border-bottom: 1px solid var(--border);
            transition: background 0.1s;
        }

        .items-table tbody tr:last-child {
            border-bottom: none;
        }

        .items-table tbody tr:hover {
            background: #FDFCFA;
        }

        .items-table td {
            padding: 14px 16px;
            font-size: 13px;
            color: var(--text2);
            vertical-align: middle;
        }

        .items-table td:first-child {
            padding-left: 20px;
        }

        .items-table td:last-child {
            padding-right: 20px;
        }

        .item-name-wrap {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .item-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--accent-lt);
            border: 2px solid var(--accent);
            flex-shrink: 0;
        }

        .item-name {
            font-size: 13px;
            font-weight: 500;
            color: var(--text1);
        }

        .item-deleted {
            font-size: 12px;
            color: var(--text3);
            font-style: italic;
        }

        .qty-pill {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 28px;
            height: 24px;
            background: var(--tag-bg);
            border-radius: var(--r-pill);
            font-size: 12px;
            font-weight: 600;
            color: var(--text2);
            padding: 0 8px;
        }

        .price-cell {
            text-align: right;
            font-size: 13px;
            color: var(--text2);
        }

        .subtotal-cell {
            text-align: right;
            font-size: 13px;
            font-weight: 600;
            color: var(--text1);
        }

        /* ── SUMMARY CARD ── */
        .summary-body {
            padding: 16px 20px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 13px;
            color: var(--text2);
            margin-bottom: 10px;
        }

        .summary-row:last-child {
            margin-bottom: 0;
        }

        .summary-divider {
            height: 1px;
            background: var(--border2);
            margin: 12px 0;
        }

        .summary-total {
            display: flex;
            justify-content: space-between;
            align-items: baseline;
            margin-top: 4px;
        }

        .summary-total-label {
            font-family: var(--font-d);
            font-size: 15px;
            color: var(--text1);
        }

        .summary-total-value {
            font-size: 20px;
            font-weight: 600;
            color: var(--accent);
        }

        /* ── TXN INFO CARD ── */
        .txn-info-body {
            padding: 4px 0;
        }

        .txn-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 13px 20px;
            border-bottom: 1px solid var(--border);
        }

        .txn-row:last-child {
            border-bottom: none;
        }

        .txn-row-label {
            font-size: 11px;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.6px;
            color: var(--text3);
        }

        .txn-row-value {
            font-size: 13px;
            font-weight: 600;
            color: var(--text1);
        }

        .customer-chip {
            display: inline-flex;
            align-items: center;
            gap: 7px;
        }

        .customer-avatar-sm {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background: var(--tag-bg);
            font-size: 10px;
            font-weight: 700;
            color: var(--text2);
            display: flex;
            align-items: center;
            justify-content: center;
            text-transform: uppercase;
            flex-shrink: 0;
        }

        .cash-value {
            color: var(--green);
            background: var(--green-lt);
            padding: 3px 10px;
            border-radius: var(--r-sm);
            font-size: 13px;
        }

        .change-value {
            color: var(--gold);
            background: var(--gold-lt);
            padding: 3px 10px;
            border-radius: var(--r-sm);
            font-size: 13px;
        }

        /* ── PRINT ── */
        @media print {

            .header-actions,
            .back-link {
                display: none !important;
            }

            .detail-page {
                padding: 0;
                background: #fff;
            }

            .d-card {
                border: 1px solid #ddd;
                box-shadow: none;
            }

            .detail-layout {
                grid-template-columns: 1fr 280px;
            }
        }
    </style>
@endsection

@section('content')
    @php
        $customerName = $order->customer ? $order->customer->name : 'Walk-in Guest';
        $initials = collect(explode(' ', $customerName))->take(2)->map(fn($w) => strtoupper($w[0] ?? ''))->implode('');
        $subtotal = $order->total_amount / 1.1;
        $tax = $order->total_amount - $subtotal;
        $dt = $order->created_at->timezone('Asia/Phnom_Penh');
    @endphp

    <div class="detail-page">

        {{-- ── PAGE HEADER ── --}}
        <div class="page-header">
            <div>
                <a href="{{ route('orders.index') }}" class="back-link">
                    <svg width="12" height="12" viewBox="0 0 16 16" fill="none">
                        <path d="M10 3L5 8l5 5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                    Back to orders
                </a>
                <p class="page-eyebrow">Transaction</p>
                <h1 class="page-title">Order #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</h1>
                <p class="page-sub">{{ $dt->format('l, F d, Y — H:i') }}</p>
            </div>

            <div class="header-actions">
                <button class="btn-print" onclick="window.print()">
                    <svg width="14" height="14" viewBox="0 0 16 16" fill="none">
                        <rect x="3" y="1" width="10" height="7" rx="1" stroke="currentColor" stroke-width="1.5" />
                        <path d="M3 8v5a1 1 0 001 1h8a1 1 0 001-1V8" stroke="currentColor" stroke-width="1.5" />
                        <path d="M1 6h14v5H1z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round" />
                        <circle cx="12" cy="8.5" r="0.75" fill="currentColor" />
                    </svg>
                    Print
                </button>
                <a href="{{ route('orders.index') }}" class="btn-back">
                    <svg width="13" height="13" viewBox="0 0 16 16" fill="none">
                        <path d="M10 3L5 8l5 5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                    All Orders
                </a>
            </div>
        </div>

        {{-- ── CONTENT LAYOUT ── --}}
        <div class="detail-layout">

            {{-- LEFT: Items table --}}
            <div>
                <div class="d-card">
                    <div class="d-card-header">
                        <h2 class="d-card-title">Items Ordered</h2>
                        <span class="item-count-badge">{{ $order->items->count() }}
                            {{ Str::plural('item', $order->items->count()) }}</span>
                    </div>
                    <div style="overflow-x: auto;">
                        <table class="items-table">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th class="center">Qty</th>
                                    <th class="right">Unit Price</th>
                                    <th class="right">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->items as $item)
                                    <tr>
                                        <td>
                                            <div class="item-name-wrap">
                                                <div class="item-dot"></div>
                                                @if($item->product)
                                                    <span class="item-name">{{ $item->product->name }}</span>
                                                @else
                                                    <span class="item-deleted">Deleted item</span>
                                                @endif
                                            </div>
                                        </td>
                                        <td style="text-align: center;">
                                            <span class="qty-pill">{{ $item->quantity }}</span>
                                        </td>
                                        <td class="price-cell">$ {{ number_format($item->unit_price, 2) }}</td>
                                        <td class="subtotal-cell">$ {{ number_format($item->subtotal, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- RIGHT: Summary + Txn Info --}}
            <div>

                {{-- Order Summary --}}
                <div class="d-card">
                    <div class="d-card-header">
                        <h2 class="d-card-title">Summary</h2>
                    </div>
                    <div class="summary-body">
                        <div class="summary-row">
                            <span>Subtotal</span>
                            <span>$ {{ number_format($subtotal, 2) }}</span>
                        </div>
                        <div class="summary-row">
                            <span>Tax (10%)</span>
                            <span>$ {{ number_format($tax, 2) }}</span>
                        </div>
                        <div class="summary-divider"></div>
                        <div class="summary-total">
                            <span class="summary-total-label">Total</span>
                            <span class="summary-total-value">$ {{ number_format($order->total_amount, 2) }}</span>
                        </div>
                    </div>
                </div>

                {{-- Transaction Info --}}
                <div class="d-card">
                    <div class="d-card-header">
                        <h2 class="d-card-title">Transaction Info</h2>
                    </div>
                    <div class="txn-info-body">
                        <div class="txn-row">
                            <span class="txn-row-label">Customer</span>
                            <div class="customer-chip">
                                <div class="customer-avatar-sm">{{ $initials }}</div>
                                <span class="txn-row-value">{{ $customerName }}</span>
                            </div>
                        </div>
                        <div class="txn-row">
                            <span class="txn-row-label">Date</span>
                            <span class="txn-row-value">{{ $dt->format('M d, Y') }}</span>
                        </div>
                        <div class="txn-row">
                            <span class="txn-row-label">Time</span>
                            <span class="txn-row-value">{{ $dt->format('H:i') }}</span>
                        </div>
                        <div class="txn-row">
                            <span class="txn-row-label">Cash Received</span>
                            <span class="cash-value">$ {{ number_format($order->cash_received, 2) }}</span>
                        </div>
                        <div class="txn-row">
                            <span class="txn-row-label">Change</span>
                            <span class="change-value">$ {{ number_format($order->change_amount, 2) }}</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
@endsection