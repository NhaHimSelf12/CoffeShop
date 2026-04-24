@extends('layouts.app')

@section('page_title', __('main.reports'))

@section('styles')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600&family=DM+Mono:wght@400;500&family=Playfair+Display:wght@600&display=swap"
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
            --gold: #92621A;
            --gold-lt: #FEF3DC;
            --blue: #185FA5;
            --blue-lt: #E6F1FB;
            --tag-bg: #EDE9E2;
            --font-d: 'Playfair Display', serif;
            --font-b: 'DM Sans', sans-serif;
            --font-m: 'DM Mono', monospace;
            --r: 12px;
            --r-sm: 8px;
            --r-pill: 100px;
        }

        .rpt-page {
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

        /* Date form */
        .date-form {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
        }

        .date-field {
            display: flex;
            align-items: center;
            gap: 7px;
            background: var(--surface);
            border: 1px solid var(--border2);
            border-radius: var(--r-pill);
            padding: 0 14px;
            height: 36px;
        }

        .date-lbl {
            font-size: 10px;
            font-weight: 600;
            letter-spacing: 0.7px;
            text-transform: uppercase;
            color: var(--text3);
            white-space: nowrap;
        }

        .date-field input[type="date"] {
            border: none;
            outline: none;
            background: transparent;
            font-family: var(--font-b);
            font-size: 13px;
            font-weight: 500;
            color: var(--text1);
            cursor: pointer;
        }

        .btn-apply {
            height: 36px;
            padding: 0 18px;
            background: var(--accent);
            color: #fff;
            border: none;
            border-radius: var(--r-pill);
            font-family: var(--font-b);
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: opacity 0.15s;
            white-space: nowrap;
            display: inline-flex;
            align-items: center;
            gap: 7px;
        }

        .btn-apply:hover {
            opacity: 0.88;
        }

        .btn-print {
            height: 36px;
            padding: 0 16px;
            background: var(--surface);
            border: 1px solid var(--border2);
            border-radius: var(--r-pill);
            font-family: var(--font-b);
            font-size: 13px;
            font-weight: 500;
            color: var(--text2);
            cursor: pointer;
            transition: border-color 0.15s, color 0.15s;
            display: inline-flex;
            align-items: center;
            gap: 7px;
        }

        .btn-print:hover {
            border-color: var(--accent);
            color: var(--accent);
        }

        /* ── STAT CARDS ── */
        .stat-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 14px;
            margin-bottom: 24px;
        }

        .stat-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--r);
            padding: 20px;
            display: flex;
            flex-direction: column;
            gap: 14px;
            transition: transform 0.15s, box-shadow 0.15s;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.06);
        }

        .stat-card.dark {
            background: var(--text1);
        }

        .stat-top {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 10px;
        }

        .stat-label {
            font-size: 11px;
            font-weight: 500;
            letter-spacing: 0.7px;
            text-transform: uppercase;
            color: var(--text3);
            margin-bottom: 6px;
        }

        .stat-card.dark .stat-label {
            color: rgba(255, 255, 255, 0.45);
        }

        .stat-value {
            font-size: 24px;
            font-weight: 600;
            color: var(--text1);
            line-height: 1;
            font-family: var(--font-m);
        }

        .stat-card.dark .stat-value {
            color: #fff;
        }

        .stat-value.accent {
            color: var(--accent);
        }

        .stat-value.green {
            color: var(--green);
        }

        .stat-icon {
            width: 38px;
            height: 38px;
            border-radius: var(--r-sm);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .stat-icon.warm {
            background: var(--accent-lt);
        }

        .stat-icon.dim {
            background: rgba(255, 255, 255, 0.1);
        }

        .stat-icon.teal {
            background: var(--green-lt);
        }

        .stat-icon.golden {
            background: var(--gold-lt);
        }

        .stat-foot {
            font-size: 12px;
            color: var(--text3);
            padding-top: 10px;
            border-top: 1px solid var(--border);
        }

        .stat-card.dark .stat-foot {
            color: rgba(255, 255, 255, 0.3);
            border-color: rgba(255, 255, 255, 0.08);
        }

        /* ── MID ROW ── */
        .mid-row {
            display: grid;
            grid-template-columns: 1fr 300px;
            gap: 14px;
            margin-bottom: 24px;
            align-items: start;
        }

        @media (max-width: 900px) {
            .mid-row {
                grid-template-columns: 1fr;
            }
        }

        /* Chart card */
        .chart-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--r);
            overflow: hidden;
        }

        .card-header {
            padding: 16px 20px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .card-title {
            font-family: var(--font-d);
            font-size: 15px;
            color: var(--text1);
            margin: 0;
        }

        .chart-tag {
            font-size: 11px;
            font-weight: 600;
            color: var(--text3);
            background: var(--tag-bg);
            padding: 3px 10px;
            border-radius: var(--r-pill);
        }

        .chart-body {
            padding: 20px;
            height: 320px;
            position: relative;
        }

        /* Top products card */
        .top-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--r);
            overflow: hidden;
        }

        .top-list {
            padding: 8px 0;
        }

        .top-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 11px 18px;
            transition: background 0.1s;
        }

        .top-item:hover {
            background: var(--bg);
        }

        .top-rank {
            font-family: var(--font-m);
            font-size: 13px;
            font-weight: 500;
            color: var(--text3);
            width: 22px;
            text-align: center;
            flex-shrink: 0;
        }

        .top-rank.first {
            color: var(--gold);
        }

        .top-info {
            flex: 1;
            min-width: 0;
        }

        .top-name {
            font-size: 12px;
            font-weight: 500;
            color: var(--text1);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            margin-bottom: 5px;
        }

        .top-bar-wrap {
            height: 4px;
            background: var(--surface2);
            border-radius: 2px;
            overflow: hidden;
        }

        .top-bar {
            height: 100%;
            background: var(--accent);
            border-radius: 2px;
            transition: width 0.6s ease;
        }

        .top-item:first-child .top-bar {
            background: var(--gold);
        }

        .top-sold {
            font-size: 11px;
            font-weight: 600;
            color: var(--text3);
            white-space: nowrap;
            flex-shrink: 0;
        }

        .top-empty {
            padding: 40px 18px;
            text-align: center;
            color: var(--text3);
            font-size: 13px;
        }

        /* ── MONTHLY TABLE ── */
        .table-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--r);
            overflow: hidden;
        }

        .rpt-table {
            width: 100%;
            border-collapse: collapse;
        }

        .rpt-table thead tr {
            background: var(--bg);
            border-bottom: 1px solid var(--border2);
        }

        .rpt-table th {
            padding: 11px 16px;
            font-size: 10.5px;
            font-weight: 600;
            letter-spacing: 0.8px;
            text-transform: uppercase;
            color: var(--text3);
            text-align: left;
            white-space: nowrap;
        }

        .rpt-table th:first-child {
            padding-left: 20px;
        }

        .rpt-table th:last-child {
            padding-right: 20px;
            text-align: right;
        }

        .rpt-table tbody tr {
            border-bottom: 1px solid var(--border);
            transition: background 0.1s;
        }

        .rpt-table tbody tr:last-child {
            border-bottom: none;
        }

        .rpt-table tbody tr:hover {
            background: #FDFCFA;
        }

        .rpt-table td {
            padding: 14px 16px;
            font-size: 13px;
            color: var(--text2);
            vertical-align: middle;
        }

        .rpt-table td:first-child {
            padding-left: 20px;
        }

        .rpt-table td:last-child {
            padding-right: 20px;
            text-align: right;
        }

        .month-chip {
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .month-abbr {
            width: 36px;
            height: 28px;
            background: var(--accent-lt);
            color: var(--accent);
            border-radius: var(--r-sm);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            flex-shrink: 0;
        }

        .month-name {
            font-size: 13px;
            font-weight: 500;
            color: var(--text1);
        }

        .orders-pill {
            background: var(--blue-lt);
            color: var(--blue);
            font-size: 11px;
            font-weight: 600;
            padding: 3px 10px;
            border-radius: var(--r-pill);
        }

        .revenue-val {
            font-family: var(--font-m);
            font-size: 13px;
            font-weight: 500;
            color: var(--text1);
        }

        .daily-avg {
            font-size: 12px;
            color: var(--text3);
            font-family: var(--font-m);
        }

        .trend-pill {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 11px;
            font-weight: 600;
            padding: 4px 10px;
            border-radius: var(--r-pill);
            background: var(--green-lt);
            color: var(--green);
        }

        .rpt-empty {
            text-align: center;
            padding: 48px 24px;
            color: var(--text3);
            font-size: 13px;
        }

        /* ── PRINT ── */
        @media print {

            .date-form,
            .btn-print,
            .btn-apply {
                display: none !important;
            }

            .rpt-page {
                padding: 0;
                background: #fff;
            }

            .stat-card,
            .chart-card,
            .top-card,
            .table-card {
                border: 1px solid #ddd;
                box-shadow: none;
            }

            .stat-card.dark {
                background: #1A1814 !important;
                -webkit-print-color-adjust: exact;
            }

            .mid-row {
                grid-template-columns: 1fr 280px;
            }
        }
    </style>
@endsection

@section('content')
    <div class="rpt-page">

        {{-- ── PAGE HEADER ── --}}
        <div class="page-header">
            <div>
                <p class="page-eyebrow">{{ __('main.reports') }}</p>
                <h1 class="page-title">{{ __('main.financial_intelligence') }}</h1>
                <p class="page-sub">{{ __('main.financial_intelligence_sub') }}</p>
            </div>

            <form action="{{ route('reports.index') }}" method="GET" class="date-form">
                <div class="date-field">
                    <span class="date-lbl">{{ __('main.from') }}</span>
                    <input type="date" name="start_date" value="{{ $start_date->format('Y-m-d') }}">
                </div>
                <div class="date-field">
                    <span class="date-lbl">{{ __('main.to') }}</span>
                    <input type="date" name="end_date" value="{{ $end_date->format('Y-m-d') }}">
                </div>
                <button type="submit" class="btn-apply">
                    <svg width="13" height="13" viewBox="0 0 16 16" fill="none">
                        <path d="M2 8a6 6 0 1012 0A6 6 0 002 8z" stroke="currentColor" stroke-width="1.6" />
                        <path d="M13.5 13.5l2 2" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" />
                    </svg>
                    {{ __('main.apply') }}
                </button>
                <button type="button" class="btn-print" onclick="window.print()">
                    <svg width="13" height="13" viewBox="0 0 16 16" fill="none">
                        <rect x="3" y="1" width="10" height="6" rx="1" stroke="currentColor" stroke-width="1.4" />
                        <path d="M3 7v6a1 1 0 001 1h8a1 1 0 001-1V7" stroke="currentColor" stroke-width="1.4" />
                        <path d="M1 5h14v6H1z" stroke="currentColor" stroke-width="1.4" stroke-linejoin="round" />
                        <circle cx="12" cy="7.5" r="0.7" fill="currentColor" />
                    </svg>
                    {{ __('main.print') }}
                </button>
            </form>
        </div>

        {{-- ── STAT CARDS ── --}}
        <div class="stat-row">
            <div class="stat-card">
                <div class="stat-top">
                    <div>
                        <div class="stat-label">{{ __('main.net_revenue') }}</div>
                        <div class="stat-value accent">$ {{ number_format($total_revenue, 2) }}</div>
                    </div>
                    <div class="stat-icon warm">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                            <path
                                d="M12 2v2M12 20v2M6 12H2M22 12h-4M17.66 6.34l-1.41 1.41M7.75 16.25l-1.41 1.41M17.66 17.66l-1.41-1.41M7.75 7.75L6.34 6.34"
                                stroke="#C4501A" stroke-width="1.8" stroke-linecap="round" />
                            <circle cx="12" cy="12" r="4" stroke="#C4501A" stroke-width="1.8" />
                        </svg>
                    </div>
                </div>
                <div class="stat-foot">{{ __('main.total_collected_period') }}</div>
            </div>

            <div class="stat-card dark">
                <div class="stat-top">
                    <div>
                        <div class="stat-label">{{ __('main.total_orders') }}</div>
                        <div class="stat-value">{{ number_format($total_orders) }}</div>
                    </div>
                    <div class="stat-icon dim">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                            <path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2"
                                stroke="rgba(255,255,255,0.6)" stroke-width="1.8" />
                            <rect x="9" y="3" width="6" height="4" rx="1" stroke="rgba(255,255,255,0.6)"
                                stroke-width="1.8" />
                            <path d="M9 12h6M9 16h4" stroke="rgba(255,255,255,0.6)" stroke-width="1.8"
                                stroke-linecap="round" />
                        </svg>
                    </div>
                </div>
                <div class="stat-foot">{{ __('main.processed_transactions') }}</div>
            </div>

            <div class="stat-card">
                <div class="stat-top">
                    <div>
                        <div class="stat-label">{{ __('main.avg_order_value') }}</div>
                        <div class="stat-value green">
                            $ {{ number_format($total_orders > 0 ? $total_revenue / $total_orders : 0, 2) }}
                        </div>
                    </div>
                    <div class="stat-icon teal">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                            <circle cx="9" cy="21" r="1" stroke="#1D4E3A" stroke-width="1.8" />
                            <circle cx="20" cy="21" r="1" stroke="#1D4E3A" stroke-width="1.8" />
                            <path d="M1 1h4l2.68 13.39a2 2 0 002 1.61h9.72a2 2 0 002-1.61L23 6H6" stroke="#1D4E3A"
                                stroke-width="1.8" stroke-linecap="round" />
                        </svg>
                    </div>
                </div>
                <div class="stat-foot">{{ __('main.per_customer_average') }}</div>
            </div>

            <div class="stat-card">
                <div class="stat-top">
                    <div>
                        <div class="stat-label">{{ __('main.period_range') }}</div>
                        <div class="stat-value" style="font-size: 16px; color: var(--gold);">
                            {{ $start_date->format('M d') }} — {{ $end_date->format('M d') }}
                        </div>
                    </div>
                    <div class="stat-icon golden">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                            <rect x="3" y="4" width="18" height="18" rx="2" stroke="#92621A" stroke-width="1.8" />
                            <path d="M3 9h18M8 2v4M16 2v4" stroke="#92621A" stroke-width="1.8" stroke-linecap="round" />
                        </svg>
                    </div>
                </div>
                <div class="stat-foot">{{ $start_date->diffInDays($end_date) + 1 }} {{ __('main.day_window') }}</div>
            </div>
        </div>

        {{-- ── CHART + TOP PRODUCTS ── --}}
        <div class="mid-row">

            {{-- Revenue Chart --}}
            <div class="chart-card">
                <div class="card-header">
                    <h2 class="card-title">{{ __('main.revenue_trend') }}</h2>
                    <span class="chart-tag">{{ __('main.daily_sales') }}</span>
                </div>
                <div class="chart-body">
                    <canvas id="reportingChart"></canvas>
                </div>
            </div>

            {{-- Top Products --}}
            <div class="top-card">
                <div class="card-header">
                    <h2 class="card-title">{{ __('main.top_sellers') }}</h2>
                    <span class="chart-tag">{{ __('main.by_volume') }}</span>
                </div>
                <div class="top-list">
                    @php $maxSold = $top_products->max('total_sold') ?: 1; @endphp
                    @forelse($top_products as $index => $product)
                        <div class="top-item">
                            <span class="top-rank {{ $index === 0 ? 'first' : '' }}">#{{ $index + 1 }}</span>
                            <div class="top-info">
                                <div class="top-name">{{ $product->name }}</div>
                                <div class="top-bar-wrap">
                                    <div class="top-bar" style="width: {{ round(($product->total_sold / $maxSold) * 100) }}%">
                                    </div>
                                </div>
                            </div>
                            <span class="top-sold">{{ $product->total_sold }}</span>
                        </div>
                    @empty
                        <div class="top-empty">{{ __('main.no_sales_data') }}</div>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- ── MONTHLY TABLE ── --}}
        <div class="table-card">
            <div class="card-header">
                <h2 class="card-title">{{ __('main.monthly_performance') }}</h2>
                <span class="chart-tag">{{ $monthly_summary->count() }}
                    {{ Str::plural(__('main.month'), $monthly_summary->count()) }}</span>
            </div>
            <div style="overflow-x: auto;">
                <table class="rpt-table">
                    <thead>
                        <tr>
                            <th>{{ __('main.month') }}</th>
                            <th>{{ __('main.orders') }}</th>
                            <th>{{ __('main.gross_revenue') }}</th>
                            <th>{{ __('main.daily_average') }}</th>
                            <th>{{ __('main.status') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($monthly_summary as $month)
                            <tr>
                                <td>
                                    <div class="month-chip">
                                        <div class="month-abbr">{{ substr($month->month, 0, 3) }}</div>
                                        <span class="month-name">{{ $month->month }}</span>
                                    </div>
                                </td>
                                <td>
                                    <span class="orders-pill">{{ $month->count }} {{ __('main.orders') }}</span>
                                </td>
                                <td>
                                    <span class="revenue-val">$ {{ number_format($month->total, 2) }}</span>
                                </td>
                                <td>
                                    <span class="daily-avg">$ {{ number_format($month->total / 30, 2) }}/{{ __('main.day') }}</span>
                                </td>
                                <td>
                                    <span class="trend-pill">
                                        <svg width="10" height="10" viewBox="0 0 12 12" fill="none">
                                            <path d="M1 9l3.5-4L7 7l4-5" stroke="currentColor" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                                {{ __('main.healthy') }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">
                                    <div class="rpt-empty">{{ __('main.no_monthly_data') }}</div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ctx = document.getElementById('reportingChart').getContext('2d');

            const labels = {!! json_encode($daily_sales->pluck('date')) !!};
            const data = {!! json_encode($daily_sales->pluck('total')) !!};

            const grad = ctx.createLinearGradient(0, 0, 0, 300);
            grad.addColorStop(0, 'rgba(196, 80, 26, 0.18)');
            grad.addColorStop(1, 'rgba(196, 80, 26, 0)');

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels,
                    datasets: [{
                        label: 'Revenue',
                        data,
                        borderColor: '#C4501A',
                        borderWidth: 2.5,
                        fill: true,
                        backgroundColor: grad,
                        tension: 0.42,
                        pointRadius: 3,
                        pointBackgroundColor: '#FFFFFF',
                        pointBorderColor: '#C4501A',
                        pointBorderWidth: 2,
                        pointHoverRadius: 6,
                        pointHoverBackgroundColor: '#C4501A',
                        pointHoverBorderColor: '#fff',
                        pointHoverBorderWidth: 2,
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            mode: 'index',
                            intersect: false,
                            backgroundColor: '#1A1814',
                            padding: 12,
                            cornerRadius: 8,
                            titleColor: 'rgba(255,255,255,0.5)',
                            titleFont: { size: 11, family: "'DM Sans', sans-serif" },
                            bodyColor: '#FFFFFF',
                            bodyFont: { size: 13, weight: '600', family: "'DM Mono', monospace" },
                            callbacks: {
                                label: ctx => '  $' + ctx.parsed.y.toLocaleString(undefined, { minimumFractionDigits: 2 })
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: { color: 'rgba(0,0,0,0.04)' },
                            border: { display: false },
                            ticks: {
                                callback: v => '$' + v.toLocaleString(),
                                font: { size: 11, family: "'DM Sans', sans-serif" },
                                color: '#A8A49E',
                                maxTicksLimit: 6
                            }
                        },
                        x: {
                            grid: { display: false },
                            border: { display: false },
                            ticks: {
                                color: '#A8A49E',
                                font: { size: 10, family: "'DM Sans', sans-serif" },
                                maxTicksLimit: 10
                            }
                        }
                    }
                }
            });
        });
    </script>
@endsection