@extends('layouts.app')

@section('page_title', __('main.order_history'))

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

        .txn-page {
            font-family: var(--font-b);
            background: var(--bg);
            min-height: 100vh;
            padding: 32px 28px 48px;
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

        .page-heading {
            line-height: 1;
        }

        .page-eyebrow {
            font-size: 11px;
            font-weight: 500;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: var(--accent);
            margin-bottom: 6px;
        }

        .page-title {
            font-family: var(--font-d);
            font-size: 26px;
            color: var(--text1);
            margin: 0 0 4px;
        }

        .page-sub {
            font-size: 13px;
            color: var(--text3);
            margin: 0;
        }

        .new-txn-btn {
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
            text-decoration: none;
            cursor: pointer;
            transition: opacity 0.15s, transform 0.1s;
            white-space: nowrap;
        }

        .new-txn-btn:hover {
            opacity: 0.88;
            color: #fff;
        }

        .new-txn-btn:active {
            transform: scale(0.98);
        }

        .new-txn-btn svg {
            flex-shrink: 0;
        }

        /* ── STAT CARDS ── */
        .stat-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
            gap: 12px;
            margin-bottom: 24px;
        }

        .stat-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--r);
            padding: 16px 18px;
        }

        .stat-label {
            font-size: 11px;
            font-weight: 500;
            letter-spacing: 0.6px;
            text-transform: uppercase;
            color: var(--text3);
            margin-bottom: 6px;
        }

        .stat-value {
            font-size: 22px;
            font-weight: 600;
            color: var(--text1);
            line-height: 1;
        }

        .stat-value.accent {
            color: var(--accent);
        }

        .stat-value.green {
            color: var(--green);
        }

        /* ── TABLE CARD ── */
        .table-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--r);
            overflow: hidden;
        }

        .table-toolbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px 20px;
            border-bottom: 1px solid var(--border);
            gap: 16px;
            flex-wrap: wrap;
        }

        .toolbar-left {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .record-count {
            font-size: 13px;
            font-weight: 500;
            color: var(--text2);
        }

        .record-badge {
            background: var(--tag-bg);
            color: var(--text2);
            font-size: 11px;
            font-weight: 600;
            padding: 3px 10px;
            border-radius: var(--r-pill);
        }

        /* Search */
        .search-form {
            position: relative;
        }

        .search-form input {
            height: 34px;
            border: 1px solid var(--border2);
            border-radius: var(--r-pill);
            padding: 0 14px 0 34px;
            font-family: var(--font-b);
            font-size: 13px;
            color: var(--text1);
            background: var(--bg);
            outline: none;
            width: 220px;
            transition: border-color 0.15s, width 0.2s;
        }

        .search-form input:focus {
            border-color: var(--accent);
            background: var(--surface);
            width: 270px;
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

        /* Table */
        .txn-table {
            width: 100%;
            border-collapse: collapse;
        }

        .txn-table thead tr {
            background: var(--bg);
            border-bottom: 1px solid var(--border2);
        }

        .txn-table th {
            padding: 11px 16px;
            font-size: 10.5px;
            font-weight: 600;
            letter-spacing: 0.8px;
            text-transform: uppercase;
            color: var(--text3);
            white-space: nowrap;
            text-align: left;
        }

        .txn-table th:first-child {
            padding-left: 20px;
        }

        .txn-table th:last-child {
            padding-right: 20px;
            text-align: right;
        }

        .txn-table tbody tr {
            border-bottom: 1px solid var(--border);
            transition: background 0.1s;
        }

        .txn-table tbody tr:last-child {
            border-bottom: none;
        }

        .txn-table tbody tr:hover {
            background: #FDFCFA;
        }

        .txn-table td {
            padding: 14px 16px;
            font-size: 13px;
            color: var(--text2);
            vertical-align: middle;
        }

        .txn-table td:first-child {
            padding-left: 20px;
        }

        .txn-table td:last-child {
            padding-right: 20px;
            text-align: right;
        }

        /* TXN ID */
        .txn-id {
            font-family: 'DM Mono', 'Courier New', monospace;
            font-size: 12px;
            font-weight: 600;
            color: var(--accent);
            background: var(--accent-lt);
            padding: 3px 9px;
            border-radius: var(--r-sm);
            white-space: nowrap;
        }

        /* Customer cell */
        .customer-cell {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .customer-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: var(--tag-bg);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 600;
            color: var(--text2);
            flex-shrink: 0;
            text-transform: uppercase;
        }

        .customer-name {
            font-size: 13px;
            font-weight: 500;
            color: var(--text1);
        }

        /* Amount cells */
        .amount-total {
            font-size: 13px;
            font-weight: 600;
            color: var(--text1);
        }

        .amount-cash {
            font-size: 12px;
            font-weight: 500;
            color: var(--green);
            background: var(--green-lt);
            padding: 3px 9px;
            border-radius: var(--r-sm);
            display: inline-block;
        }

        .amount-change {
            font-size: 12px;
            font-weight: 500;
            color: var(--gold);
            background: var(--gold-lt);
            padding: 3px 9px;
            border-radius: var(--r-sm);
            display: inline-block;
        }

        /* Date */
        .date-cell {
            white-space: nowrap;
        }

        .date-main {
            font-size: 12px;
            font-weight: 500;
            color: var(--text2);
        }

        .date-time {
            font-size: 11px;
            color: var(--text3);
            margin-top: 1px;
        }

        /* Details button */
        .details-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 14px;
            background: var(--bg);
            border: 1px solid var(--border2);
            border-radius: var(--r-pill);
            font-family: var(--font-b);
            font-size: 12px;
            font-weight: 500;
            color: var(--text2);
            text-decoration: none;
            cursor: pointer;
            transition: border-color 0.15s, color 0.15s, background 0.15s;
            white-space: nowrap;
        }

        .details-btn:hover {
            border-color: var(--accent);
            color: var(--accent);
            background: var(--accent-lt);
        }

        /* Empty state */
        .empty-state {
            text-align: center;
            padding: 64px 24px;
            color: var(--text3);
        }

        .empty-icon {
            width: 52px;
            height: 52px;
            background: var(--tag-bg);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 14px;
            font-size: 22px;
        }

        .empty-state p {
            font-size: 13px;
            margin: 0;
        }

        /* Pagination */
        .pagination-wrap {
            padding: 14px 20px;
            border-top: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: flex-end;
        }

        /* Override Laravel pagination */
        .pagination-wrap nav [aria-label="Pagination Navigation"] {
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .pagination-wrap .page-item .page-link {
            height: 32px;
            min-width: 32px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 1px solid var(--border2);
            border-radius: var(--r-sm);
            font-size: 12px;
            font-weight: 500;
            color: var(--text2);
            background: var(--surface);
            padding: 0 10px;
            text-decoration: none;
            transition: all 0.12s;
        }

        .pagination-wrap .page-item.active .page-link {
            background: var(--accent);
            border-color: var(--accent);
            color: #fff;
        }

        .pagination-wrap .page-item .page-link:hover {
            border-color: var(--accent);
            color: var(--accent);
        }
    </style>
@endsection

@section('content')
    <div class="txn-page">

        {{-- ── PAGE HEADER ── --}}
        <div class="page-header flex flex-col md:flex-row items-start md:items-end">
            <div class="page-heading w-full md:w-auto mb-2 md:mb-0">
                <p class="page-eyebrow">{{ __('main.finance') }}</p>
                <h1 class="page-title">{{ __('main.transaction_history') }}</h1>
                <p class="page-sub">{{ __('main.transaction_history_sub') }}</p>
            </div>
            <a href="{{ route('pos.index') }}" class="new-txn-btn w-full md:w-auto h-[44px] md:h-auto flex justify-center text-[14px] md:text-[13px]">
                <svg width="14" height="14" viewBox="0 0 16 16" fill="none">
                    <path d="M8 2v12M2 8h12" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                </svg>
                    {{ __('main.new_transaction') }}
            </a>
        </div>

        {{-- ── STAT CARDS ── --}}
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 mb-6">
            <div class="stat-card">
                <div class="stat-label">{{ __('main.total_orders') }}</div>
                <div class="stat-value">{{ $orders->total() }}</div>
            </div>
            <div class="stat-card">
                <div class="stat-label">{{ __('main.this_page') }}</div>
                <div class="stat-value">{{ $orders->count() }}</div>
            </div>
            <div class="stat-card">
                <div class="stat-label">{{ __('main.revenue_page') }}</div>
                <div class="stat-value accent">
                    $&thinsp;{{ number_format($orders->sum('total_amount'), 2) }}
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-label">{{ __('main.cash_received') }}</div>
                <div class="stat-value green">
                    $&thinsp;{{ number_format($orders->sum('cash_received'), 2) }}
                </div>
            </div>
        </div>

        {{-- ── TABLE CARD ── --}}
        <div class="table-card">

            {{-- Toolbar --}}
            <div class="table-toolbar flex flex-col md:flex-row items-start md:items-center">
                <div class="toolbar-left w-full md:w-auto flex justify-between md:justify-start mb-2 md:mb-0">
                    <span class="record-count">{{ __('main.records') }}</span>
                    <span class="record-badge">{{ $orders->total() }}</span>
                </div>
                <form action="{{ route('orders.index') }}" method="GET" class="search-form w-full md:w-auto">
                    <span class="search-icon">
                        <svg width="13" height="13" viewBox="0 0 16 16" fill="none">
                            <circle cx="6.5" cy="6.5" r="5" stroke="currentColor" stroke-width="1.6" />
                            <path d="M11 11l3.5 3.5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" />
                        </svg>
                    </span>
                    <input type="text" name="search" placeholder="{{ __('main.search_id_customer') }}" value="{{ request('search') }}" class="w-full md:w-[220px] h-[44px] md:h-[34px] text-[14px] md:text-[13px]">
                </form>
            </div>

            {{-- Table --}}
            <div class="overflow-x-hidden md:overflow-x-auto">
                <table class="txn-table block md:table w-full">
                    <thead class="hidden md:table-header-group">
                        <tr>
                            <th>{{ __('main.trx_id') }}</th>
                            <th>{{ __('main.customer') }}</th>
                            <th>{{ __('main.total') }}</th>
                            <th>{{ __('main.cash_received') }}</th>
                            <th>{{ __('main.change') }}</th>
                            <th>{{ __('main.date_time') }}</th>
                            <th>{{ __('main.action') }}</th>
                        </tr>
                    </thead>
                    <tbody class="block md:table-row-group">
                        @forelse($orders as $order)
                            @php
                                $customerName = $order->customer ? $order->customer->name : __('main.walk_in');
                                $initials = collect(explode(' ', $customerName))
                                    ->take(2)->map(fn($w) => strtoupper($w[0] ?? ''))->implode('');
                                $dt = $order->created_at->timezone('Asia/Phnom_Penh');
                            @endphp
                            <tr class="block md:table-row bg-[var(--surface)] border border-[var(--border)] rounded-xl mb-4 p-4 md:p-0 md:mb-0 md:border-b">
                                {{-- ID --}}
                                <td class="flex md:table-cell justify-between items-center py-2 md:py-3 border-b border-[var(--border)] md:border-0">
                                    <span class="md:hidden font-bold text-xs text-[var(--text3)] uppercase">{{ __('main.trx_id') }}</span>
                                    <span class="txn-id text-[14px] md:text-[12px]">#{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</span>
                                </td>

                                {{-- Customer --}}
                                <td class="block md:table-cell py-3 border-b border-[var(--border)] md:border-0">
                                    <div class="customer-cell justify-end md:justify-start">
                                        <div class="customer-avatar">{{ $initials }}</div>
                                        <span class="customer-name text-[15px] md:text-[13px]">{{ $customerName }}</span>
                                    </div>
                                </td>

                                {{-- Total --}}
                                <td class="flex md:table-cell justify-between items-center py-3 border-b border-[var(--border)] md:border-0">
                                    <span class="md:hidden font-bold text-xs text-[var(--text3)] uppercase">{{ __('main.total') }}</span>
                                    <span class="amount-total text-[15px] md:text-[13px]">$ {{ number_format($order->total_amount, 2) }}</span>
                                </td>

                                {{-- Cash received --}}
                                <td class="flex md:table-cell justify-between items-center py-3 border-b border-[var(--border)] md:border-0">
                                    <span class="md:hidden font-bold text-xs text-[var(--text3)] uppercase">{{ __('main.cash_received') }}</span>
                                    <span class="amount-cash text-[14px] md:text-[12px] px-3 py-1">$ {{ number_format($order->cash_received, 2) }}</span>
                                </td>

                                {{-- Change --}}
                                <td class="flex md:table-cell justify-between items-center py-3 border-b border-[var(--border)] md:border-0">
                                    <span class="md:hidden font-bold text-xs text-[var(--text3)] uppercase">{{ __('main.change') }}</span>
                                    <span class="amount-change text-[14px] md:text-[12px] px-3 py-1">$ {{ number_format($order->change_amount, 2) }}</span>
                                </td>

                                {{-- Date --}}
                                <td class="flex md:table-cell justify-between items-center py-3 border-b border-[var(--border)] md:border-0 date-cell text-right md:text-left">
                                    <span class="md:hidden font-bold text-xs text-[var(--text3)] uppercase">{{ __('main.date_time') }}</span>
                                    <div>
                                        <div class="date-main text-[14px] md:text-[12px]">{{ $dt->format('M d, Y') }}</div>
                                        <div class="date-time text-[12px] md:text-[11px]">{{ $dt->format('H:i') }}</div>
                                    </div>
                                </td>

                                {{-- Action --}}
                                <td class="block md:table-cell py-3 pt-4 md:py-3 md:pt-3">
                                    <a href="{{ route('orders.show', $order->id) }}" class="details-btn w-full md:w-auto h-[44px] md:h-auto flex justify-center text-[14px] md:text-[12px]">
                                        <svg width="12" height="12" viewBox="0 0 16 16" fill="none">
                                            <circle cx="8" cy="8" r="2.5" stroke="currentColor" stroke-width="1.5" />
                                            <path
                                                d="M1.5 8C3 4.5 5.5 2.5 8 2.5S13 4.5 14.5 8C13 11.5 10.5 13.5 8 13.5S3 11.5 1.5 8Z"
                                                stroke="currentColor" stroke-width="1.5" />
                                        </svg>
                                       {{ __('main.details') }}
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7">
                                    <div class="empty-state">
                                        <div class="empty-icon">📋</div>
                                        <p>{{ __('main.no_transactions_found') }}</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if($orders->hasPages())
                <div class="pagination-wrap">
                    {{ $orders->links() }}
                </div>
            @endif

        </div>
    </div>
@endsection