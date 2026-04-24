@extends('layouts.app')

@section('page_title', __('main.dashboard'))

@section('content')

    <div class="db-header">
        <div>
            <h1 class="db-title">{{ __('main.dashboard') }}</h1>
            <p class="db-sub">{{ now()->format('l, d F Y') }} — {{ __('main.welcome_back') }} 👋</p>
        </div>
        <div class="db-header-right">
            <button class="btn-export" onclick="exportDashboard()">
                <svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 20 20">
                    <path d="M10 3v10m0 0l-3-3m3 3l3-3M4 14v2a2 2 0 002 2h8a2 2 0 002-2v-2" stroke-linecap="round" />
                </svg>
                {{ __('main.export') }}
            </button>
        </div>
    </div>

    {{-- ── Stat Cards ── --}}
    <div class="stats-grid">

        <div class="stat-card sc-sales">
            <div class="stat-icon si-sales">
                <svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 20 20">
                    <path d="M10 2v16M6 6h6a2 2 0 010 4H7a2 2 0 000 4h7" stroke-linecap="round" />
                </svg>
            </div>
            <div class="stat-label">{{ __('main.total_sales') }}</div>
            <div class="stat-value" id="stat-sales">${{ number_format($total_sales, 2) }}</div>
            <span class="stat-badge badge-up">↑ {{ __('main.vs_last_period') }}</span>
        </div>

        <div class="stat-card sc-orders">
            <div class="stat-icon si-orders">
                <svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 20 20">
                    <path d="M3 4h2l2.5 8h7l2-6H7" />
                    <circle cx="9" cy="16" r="1.2" fill="currentColor" />
                    <circle cx="14" cy="16" r="1.2" fill="currentColor" />
                </svg>
            </div>
            <div class="stat-label">{{ __('main.total_orders') }}</div>
            <div class="stat-value" id="stat-orders">{{ number_format($total_orders) }}</div>
            <span class="stat-badge badge-up">↑ {{ __('main.vs_last_period') }}</span>
        </div>

        <div class="stat-card sc-customers">
            <div class="stat-icon si-customers">
                <svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 20 20">
                    <circle cx="8" cy="7" r="2.5" />
                    <path d="M2 17c0-3 2.5-5 6-5s6 2 6 5" />
                    <circle cx="15" cy="7" r="2" />
                    <path d="M18 17c0-2-1.5-3.5-4-4" stroke-linecap="round" />
                </svg>
            </div>
            <div class="stat-label">{{ __('main.total_customers') }}</div>
            <div class="stat-value" id="stat-customers">{{ number_format($customers_count) }}</div>
            <span class="stat-badge badge-neu">→ {{ __('main.stable') }}</span>
        </div>

        <div class="stat-card sc-products">
            <div class="stat-icon si-products">
                <svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 20 20">
                    <rect x="3" y="8" width="14" height="9" rx="1.5" />
                    <path d="M7 8V6a3 3 0 016 0v2" />
                </svg>
            </div>
            <div class="stat-label">{{ __('main.total_products') }}</div>
            <div class="stat-value" id="stat-products">{{ number_format($products_count) }}</div>
            <span class="stat-badge badge-up">↑ {{ __('main.new') }}</span>
        </div>

    </div>

    {{-- ── Bottom Row ── --}}
    <div class="bottom-row">

        {{-- Chart --}}
        <div class="chart-card">
            <div class="card-header-row">
                <div>
                    <div class="card-title">{{ __('main.sales_overview') }}</div>
                    <div class="card-sub">{{ __('main.revenue_trend') }}</div>
                </div>
                <div class="date-filter-wrapper">
                    <button class="date-filter-btn" id="dateFilterBtn" onclick="toggleDatepicker()">
                        <svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 20 20">
                            <rect x="3" y="4" width="14" height="13" rx="2" />
                            <path d="M8 2v3M12 2v3M3 9h14" stroke-linecap="round" />
                        </svg>
                        <span id="selectedDateLabel">{{ now()->format('M d, Y') }}</span>
                        <svg class="dropdown-arrow" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 20 20">
                            <path d="M5 7l5 5 5-5" stroke-linecap="round" />
                        </svg>
                    </button>

                    <div class="datepicker-dropdown" id="datepickerDropdown">
                        <div class="datepicker-header">
                            <button class="dp-nav-btn" onclick="dpPrevMonth()">
                                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 20 20">
                                    <path d="M12 15l-5-5 5-5" stroke-linecap="round" />
                                </svg>
                            </button>
                            <span class="dp-month-year" id="dpMonthYear">{{ now()->format('F Y') }}</span>
                            <button class="dp-nav-btn" onclick="dpNextMonth()">
                                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 20 20">
                                    <path d="M8 5l5 5-5 5" stroke-linecap="round" />
                                </svg>
                            </button>
                        </div>
                        <div class="dp-grid">
                            <div class="dp-weekday">{{ __('main.sunday') }}</div>
                            <div class="dp-weekday">{{ __('main.monday') }}</div>
                            <div class="dp-weekday">{{ __('main.tuesday') }}</div>
                            <div class="dp-weekday">{{ __('main.wednesday') }}</div>
                            <div class="dp-weekday">{{ __('main.thursday') }}</div>
                            <div class="dp-weekday">{{ __('main.friday') }}</div>
                            <div class="dp-weekday">{{ __('main.saturday') }}</div>
                        </div>
                        <div class="dp-days" id="dpDays"></div>
                        <div class="datepicker-footer">
                            <button class="dp-today-btn" onclick="selectToday()">{{ __('main.today') }}</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="chart-area">
                <div class="chart-loading" id="chartLoading">
                    <div class="spinner"></div>
                </div>
                <canvas id="salesChart"></canvas>
            </div>
        </div>

        {{-- Recent Orders --}}
        <div class="orders-card">
            <div class="card-header-row">
                <div>
                    <div class="card-title">{{ __('main.recent_orders') }}</div>
                    <div class="card-sub">{{ __('main.latest_transactions') }}</div>
                </div>
            </div>

            @foreach($recent_orders as $order)
                @php
                    $name = $order->customer ? $order->customer->name : 'Guest';
                    $initials = collect(explode(' ', $name))->map(fn($w) => strtoupper($w[0]))->take(2)->join('');
                    $colors = [
                        ['bg' => '#fef3c7', 'text' => '#b45309'],
                        ['bg' => '#dbeafe', 'text' => '#1d4ed8'],
                        ['bg' => '#ede9fe', 'text' => '#6d28d9'],
                        ['bg' => '#d1fae5', 'text' => '#065f46'],
                        ['bg' => '#fce7f3', 'text' => '#9d174d'],
                    ];
                    $color = $colors[$loop->index % 5];
                @endphp
                <div class="order-item">
                    <div class="order-left">
                        <div class="order-avatar" style="background:{{ $color['bg'] }};color:{{ $color['text'] }}">
                            {{ $initials }}
                        </div>
                        <div>
                            <div class="order-name">{{ $name }}</div>
                            <div class="order-time">{{ $order->created_at->format('d M · H:i') }}</div>
                        </div>
                    </div>
                    <div class="order-right">
                        <div class="order-amount">${{ number_format($order->total_amount, 2) }}</div>
                        <div class="order-status st-paid">{{ __('main.paid') }}</div>
                    </div>
                </div>
            @endforeach

            <a href="{{ route('orders.index') }}" class="view-all-btn">{{ __('main.view_all_orders') }} →</a>
        </div>

    </div>

@endsection

@section('styles')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');

        :root {
            --dark: #0c1117;
            --dark2: #1e293b;
            --amber: #d97706;
            --border: #e5e7eb;
            --surf: #f8f9fb;
            --card: #ffffff;
            --sans: 'Plus Jakarta Sans', system-ui, sans-serif;
        }

        body {
            font-family: var(--sans);
            background: var(--surf);
        }

        /* ── Page Header ── */
        .db-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            margin-bottom: 28px;
        }

        .db-title {
            font-size: 20px;
            font-weight: 700;
            color: var(--dark);
            letter-spacing: -.02em;
            margin-bottom: 3px;
        }

        .db-sub {
            font-size: 12.5px;
            color: #9ca3af;
        }

        .db-header-right {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .btn-export {
            background: var(--dark);
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 8px 16px;
            font-size: 12.5px;
            font-weight: 600;
            cursor: pointer;
            font-family: var(--sans);
            display: flex;
            align-items: center;
            gap: 6px;
            transition: background .15s;
        }

        .btn-export:hover {
            background: var(--dark2);
        }

        .btn-export svg {
            width: 14px;
            height: 14px;
        }

        /* ── Stat Cards ── */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
            margin-bottom: 24px;
        }

        .stat-card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 20px;
            position: relative;
            overflow: hidden;
        }

        .stat-icon {
            width: 38px;
            height: 38px;
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 14px;
        }

        .si-sales {
            background: #fef3c7;
        }

        .si-sales svg {
            color: #d97706;
        }

        .si-orders {
            background: #dbeafe;
        }

        .si-orders svg {
            color: #3b82f6;
        }

        .si-customers {
            background: #ede9fe;
        }

        .si-customers svg {
            color: #8b5cf6;
        }

        .si-products {
            background: #d1fae5;
        }

        .si-products svg {
            color: #10b981;
        }

        .stat-icon svg {
            width: 18px;
            height: 18px;
        }

        .stat-label {
            font-size: 11.5px;
            font-weight: 600;
            color: #9ca3af;
            letter-spacing: .04em;
            text-transform: uppercase;
            margin-bottom: 6px;
        }

        .stat-value {
            font-size: 24px;
            font-weight: 700;
            color: var(--dark);
            letter-spacing: -.03em;
            margin-bottom: 6px;
        }

        .stat-badge {
            display: inline-flex;
            align-items: center;
            gap: 3px;
            font-size: 11px;
            font-weight: 600;
            padding: 2px 7px;
            border-radius: 20px;
        }

        .badge-up {
            background: #d1fae5;
            color: #065f46;
        }

        .badge-dn {
            background: #fee2e2;
            color: #991b1b;
        }

        .badge-neu {
            background: #f3f4f6;
            color: #6b7280;
        }

        /* ── Bottom Row ── */
        .bottom-row {
            display: grid;
            grid-template-columns: 1fr 340px;
            gap: 16px;
        }

        .chart-card,
        .orders-card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 24px;
        }

        .card-header-row {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .card-title {
            font-size: 14px;
            font-weight: 700;
            color: var(--dark);
            letter-spacing: -.01em;
        }

        .card-sub {
            font-size: 11.5px;
            color: #9ca3af;
            margin-top: 2px;
        }

        /* Date Filter */
        .date-filter-wrapper {
            position: relative;
        }

        .date-filter-btn {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 7px 12px;
            font-size: 12px;
            font-weight: 600;
            color: #6b7280;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 7px;
            transition: all .15s;
            font-family: var(--sans);
        }

        .date-filter-btn:hover {
            border-color: #d1d5db;
            background: #f9fafb;
        }

        .date-filter-btn svg {
            width: 14px;
            height: 14px;
        }

        .date-filter-btn .dropdown-arrow {
            width: 12px;
            height: 12px;
            opacity: 0.6;
        }

        .datepicker-dropdown {
            position: absolute;
            top: 100%;
            right: 0;
            margin-top: 8px;
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 16px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.12);
            z-index: 100;
            display: none;
            min-width: 280px;
        }

        .datepicker-dropdown.show {
            display: block;
        }

        .datepicker-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 14px;
        }

        .dp-nav-btn {
            background: #f3f4f6;
            border: none;
            border-radius: 6px;
            width: 28px;
            height: 28px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background .15s;
        }

        .dp-nav-btn:hover {
            background: #e5e7eb;
        }

        .dp-nav-btn svg {
            width: 16px;
            height: 16px;
            color: var(--dark);
        }

        .dp-month-year {
            font-size: 13px;
            font-weight: 600;
            color: var(--dark);
            min-width: 120px;
            text-align: center;
        }

        .dp-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 2px;
            margin-bottom: 6px;
        }

        .dp-weekday {
            font-size: 9.5px;
            font-weight: 600;
            color: #9ca3af;
            text-align: center;
            padding: 6px 0;
            text-transform: uppercase;
        }

        .dp-days {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 2px;
        }

        .dp-day {
            aspect-ratio: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 500;
            color: var(--dark);
            border-radius: 8px;
            cursor: pointer;
            transition: all .12s;
            border: none;
            background: none;
            font-family: var(--sans);
        }

        .dp-day:hover:not(.other-month) {
            background: #f3f4f6;
        }

        .dp-day.selected {
            background: var(--dark);
            color: #fff;
            font-weight: 600;
        }

        .dp-day.today {
            border: 2px solid var(--amber);
        }

        .dp-day.today.selected {
            border-color: var(--dark);
        }

        .dp-day.other-month {
            color: #e5e7eb;
            cursor: default;
        }

        .datepicker-footer {
            margin-top: 12px;
            padding-top: 12px;
            border-top: 1px solid #f3f4f6;
            display: flex;
            justify-content: center;
        }

        .dp-today-btn {
            background: var(--amber);
            color: #fff;
            border: none;
            border-radius: 6px;
            padding: 6px 16px;
            font-size: 11.5px;
            font-weight: 600;
            cursor: pointer;
            font-family: var(--sans);
            transition: background .15s;
        }

        .dp-today-btn:hover {
            background: #b45309;
        }

        /* Chart */
        .chart-area {
            height: 240px;
            position: relative;
        }

        /* Orders */
        .order-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 11px 0;
            border-bottom: 1px solid #f3f4f6;
        }

        .order-item:last-of-type {
            border-bottom: none;
        }

        .order-left {
            display: flex;
            align-items: center;
        }

        .order-right {
            text-align: right;
        }

        .order-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            font-weight: 700;
            flex-shrink: 0;
            margin-right: 10px;
        }

        .order-name {
            font-size: 13px;
            font-weight: 600;
            color: var(--dark);
        }

        .order-time {
            font-size: 11px;
            color: #9ca3af;
            margin-top: 1px;
        }

        .order-amount {
            font-size: 13px;
            font-weight: 700;
            color: var(--dark);
        }

        .order-status {
            font-size: 10.5px;
            font-weight: 600;
            padding: 2px 8px;
            border-radius: 20px;
            margin-top: 2px;
            display: inline-block;
        }

        .st-paid {
            background: #d1fae5;
            color: #065f46;
        }

        .st-pend {
            background: #fef3c7;
            color: #92400e;
        }

        .view-all-btn {
            display: block;
            width: 100%;
            margin-top: 14px;
            background: none;
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 9px;
            font-family: var(--sans);
            font-size: 12px;
            font-weight: 600;
            color: #6b7280;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            transition: background .15s;
        }

        .view-all-btn:hover {
            background: #f9fafb;
            color: var(--dark);
        }

        /* Loading overlay */
        .chart-loading {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.8);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 10;
            display: none;
        }

        .chart-loading.show {
            display: flex;
        }

        .spinner {
            width: 32px;
            height: 32px;
            border: 3px solid #f3f4f6;
            border-top-color: var(--amber);
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        @media (max-width: 1100px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .bottom-row {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 640px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }

            .db-header {
                flex-direction: column;
                gap: 12px;
            }
        }
    </style>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <script>
        // Store initial data from server
        const initialData = {
            labels: {!! json_encode($chart_labels) !!},
            data: {!! json_encode($chart_data) !!},
            stats: {
                sales: {{ $total_sales }},
                orders: {{ $total_orders }},
                customers: {{ $customers_count }},
                products: {{ $products_count }}
                                                        }
        };

        var ctx = document.getElementById('salesChart').getContext('2d');
        var grad = ctx.createLinearGradient(0, 0, 0, 240);
        grad.addColorStop(0, 'rgba(217,119,6,.18)');
        grad.addColorStop(1, 'rgba(217,119,6,0)');

        var chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: initialData.labels,
                datasets: [{
                    label: 'Sales ($)',
                    data: initialData.data,
                    borderColor: '#d97706',
                    borderWidth: 2,
                    pointBackgroundColor: '#d97706',
                    pointRadius: 3,
                    pointHoverRadius: 5,
                    tension: 0.4,
                    fill: true,
                    backgroundColor: grad
                }]
            },
            options: {
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#0c1117',
                        titleColor: '#9ca3af',
                        bodyColor: '#ffffff',
                        bodyFont: { size: 13, weight: '600', family: "'Plus Jakarta Sans',system-ui" },
                        padding: 10,
                        cornerRadius: 8,
                        displayColors: false,
                        callbacks: {
                            label: function (c) { return '$ ' + c.parsed.y.toLocaleString(); }
                        }
                    }
                },
                scales: {
                    x: {
                        grid: { display: false },
                        border: { display: false },
                        ticks: { font: { size: 11, family: "'Plus Jakarta Sans',system-ui" }, color: '#9ca3af' }
                    },
                    y: {
                        grid: { color: '#f3f4f6' },
                        border: { display: false },
                        ticks: {
                            font: { size: 11, family: "'Plus Jakarta Sans',system-ui" },
                            color: '#9ca3af',
                            callback: function (v) { return '$' + v.toLocaleString(); }
                        }
                    }
                }
            }
        });

        // Datepicker state
        let dpCurrentDate = new Date();
        let selectedDate = new Date();

        // Toggle datepicker
        function toggleDatepicker() {
            const dropdown = document.getElementById('datepickerDropdown');
            dropdown.classList.toggle('show');
        }

        // Close datepicker when clicking outside
        document.addEventListener('click', function (e) {
            const wrapper = document.querySelector('.date-filter-wrapper');
            const dropdown = document.getElementById('datepickerDropdown');
            if (!wrapper.contains(e.target)) {
                dropdown.classList.remove('show');
            }
        });

        // Render datepicker
        function renderDatepicker() {
            const year = dpCurrentDate.getFullYear();
            const month = dpCurrentDate.getMonth();

            const monthNames = ['January', 'February', 'March', 'April', 'May', 'June',
                'July', 'August', 'September', 'October', 'November', 'December'];
            document.getElementById('dpMonthYear').textContent = monthNames[month] + ' ' + year;

            const firstDay = new Date(year, month, 1).getDay();
            const daysInMonth = new Date(year, month + 1, 0).getDate();
            const daysInPrevMonth = new Date(year, month, 0).getDate();

            const today = new Date();
            const daysContainer = document.getElementById('dpDays');
            daysContainer.innerHTML = '';

            // Previous month days
            for (let i = firstDay - 1; i >= 0; i--) {
                const day = daysInPrevMonth - i;
                const dayEl = document.createElement('div');
                dayEl.className = 'dp-day other-month';
                dayEl.textContent = day;
                daysContainer.appendChild(dayEl);
            }

            // Current month days
            for (let day = 1; day <= daysInMonth; day++) {
                const dayEl = document.createElement('button');
                dayEl.className = 'dp-day';
                dayEl.textContent = day;
                dayEl.type = 'button';

                const isToday = year === today.getFullYear() && month === today.getMonth() && day === today.getDate();
                const isSelected = year === selectedDate.getFullYear() &&
                    month === selectedDate.getMonth() &&
                    day === selectedDate.getDate();

                if (isToday) dayEl.classList.add('today');
                if (isSelected) dayEl.classList.add('selected');

                dayEl.onclick = () => selectDate(year, month, day);
                daysContainer.appendChild(dayEl);
            }

            // Next month days
            const totalCells = firstDay + daysInMonth;
            const remainingCells = totalCells % 7 === 0 ? 0 : 7 - (totalCells % 7);
            for (let day = 1; day <= remainingCells; day++) {
                const dayEl = document.createElement('div');
                dayEl.className = 'dp-day other-month';
                dayEl.textContent = day;
                daysContainer.appendChild(dayEl);
            }
        }

        function dpPrevMonth() {
            dpCurrentDate.setMonth(dpCurrentDate.getMonth() - 1);
            renderDatepicker();
        }

        function dpNextMonth() {
            dpCurrentDate.setMonth(dpCurrentDate.getMonth() + 1);
            renderDatepicker();
        }

        function selectToday() {
            const today = new Date();
            selectedDate = new Date(today);
            dpCurrentDate = new Date(today);
            updateDashboardForDate(today);
            renderDatepicker();
            document.getElementById('datepickerDropdown').classList.remove('show');
        }

        function selectDate(year, month, day) {
            selectedDate = new Date(year, month, day);
            updateDashboardForDate(selectedDate);
            renderDatepicker();
            document.getElementById('datepickerDropdown').classList.remove('show');
        }

        function updateDashboardForDate(date) {
            // Show loading
            document.querySelector('.chart-loading').classList.add('show');

            // Update date label
            const monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
            const label = monthNames[date.getMonth()] + ' ' +
                String(date.getDate()).padStart(2, '0') + ', ' +
                date.getFullYear();
            document.getElementById('selectedDateLabel').textContent = label;

            // Fetch new data from server
            const year = date.getFullYear();
            const month = date.getMonth() + 1;
            const day = date.getDate();
            const dateStr = `${year}-${String(month).padStart(2, '0')}-${String(day).padStart(2, '0')}`;

            fetch(`/api/dashboard-data?date=${dateStr}`)
                .then(res => res.json())
                .then(data => {
                    // Update chart
                    chart.data.labels = data.labels;
                    chart.data.datasets[0].data = data.data;
                    chart.update();

                    // Update stats
                    document.getElementById('stat-sales').textContent = '$' + Number(data.stats.sales).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
                    document.getElementById('stat-orders').textContent = Number(data.stats.orders).toLocaleString();
                    document.getElementById('stat-customers').textContent = Number(data.stats.customers).toLocaleString();
                    document.getElementById('stat-products').textContent = Number(data.stats.products).toLocaleString();
                })
                .catch(err => {
                    console.error('Error fetching dashboard data:', err);
                })
                .finally(() => {
                    document.querySelector('.chart-loading').classList.remove('show');
                });
        }

        // Export functionality
        function exportDashboard() {
            try {
                const salesText = document.getElementById('stat-sales').textContent;
                const ordersText = document.getElementById('stat-orders').textContent;
                const customersText = document.getElementById('stat-customers').textContent;
                const productsText = document.getElementById('stat-products').textContent;

                const data = {
                    export_date: new Date().toISOString().split('T')[0],
                    export_time: new Date().toLocaleTimeString(),
                    dashboard_stats: {
                        total_sales: parseFloat(salesText.replace('$', '').replace(/,/g, '')) || 0,
                        total_orders: parseInt(ordersText.replace(/,/g, '')) || 0,
                        customers: parseInt(customersText.replace(/,/g, '')) || 0,
                        products: parseInt(productsText.replace(/,/g, '')) || 0
                    },
                    chart_data: {
                        labels: chart.data.labels,
                        values: chart.data.datasets[0].data
                    }
                };

                // Create CSV content
                let csvContent = 'Dashboard Export\n';
                csvContent += 'Date: ' + data.export_date + ' ' + data.export_time + '\n\n';
                csvContent += 'Metric,Value\n';
                csvContent += 'Total Sales,$' + data.dashboard_stats.total_sales.toFixed(2) + '\n';
                csvContent += 'Total Orders,' + data.dashboard_stats.total_orders + '\n';
                csvContent += 'Customers,' + data.dashboard_stats.customers + '\n';
                csvContent += 'Products,' + data.dashboard_stats.products + '\n\n';
                csvContent += 'Daily Sales Data\n';
                csvContent += 'Day,Sales ($)\n';
                data.chart_data.labels.forEach((label, index) => {
                    csvContent += label + ',' + data.chart_data.values[index] + '\n';
                });

                // Create and download CSV file
                const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
                const url = URL.createObjectURL(blob);
                const link = document.createElement('a');
                link.href = url;
                link.setAttribute('download', 'dashboard-export-' + new Date().toISOString().split('T')[0] + '.csv');
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
                URL.revokeObjectURL(url);
            } catch (error) {
                console.error('Export error:', error);
                alert('Export failed. Please try again.');
            }
        }

        // Initialize datepicker
        renderDatepicker();
    </script>
@endsection