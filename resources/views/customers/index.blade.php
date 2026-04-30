@extends('layouts.app')

@section('page_title', __('main.customers'))

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
            --blue: #185FA5;
            --blue-lt: #E6F1FB;
            --rose: #8B2252;
            --rose-lt: #FAEAF2;
            --red: #A32D2D;
            --red-lt: #FCEBEB;
            --tag-bg: #EDE9E2;
            --font-d: 'Playfair Display', serif;
            --font-b: 'DM Sans', sans-serif;
            --r: 12px;
            --r-sm: 8px;
            --r-pill: 100px;
        }

        .cust-page {
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

        .header-right {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        /* Search */
        .search-form {
            position: relative;
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

        .search-form input {
            height: 36px;
            border: 1px solid var(--border2);
            border-radius: var(--r-pill);
            padding: 0 14px 0 34px;
            font-family: var(--font-b);
            font-size: 13px;
            color: var(--text1);
            background: var(--surface);
            outline: none;
            width: 220px;
            transition: border-color 0.15s, width 0.2s;
        }

        .search-form input:focus {
            border-color: var(--accent);
            width: 270px;
        }

        .search-submit {
            position: absolute;
            right: 8px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: var(--text3);
            display: flex;
            padding: 0;
        }

        /* Add button */
        .add-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 9px 18px;
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
        }

        .add-btn:hover {
            opacity: 0.88;
            color: #fff;
        }

        .add-btn:active {
            transform: scale(0.98);
        }

        /* ── TABLE CARD ── */
        .table-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--r);
            overflow: hidden;
        }

        /* ── TABLE ── */
        .cust-table {
            width: 100%;
            border-collapse: collapse;
        }

        .cust-table thead tr {
            background: var(--bg);
            border-bottom: 1px solid var(--border2);
        }

        .cust-table th {
            padding: 11px 16px;
            font-size: 10.5px;
            font-weight: 600;
            letter-spacing: 0.8px;
            text-transform: uppercase;
            color: var(--text3);
            text-align: left;
            white-space: nowrap;
        }

        .cust-table th:first-child {
            padding-left: 20px;
        }

        .cust-table th:last-child {
            padding-right: 20px;
            text-align: right;
        }

        .cust-table tbody tr {
            border-bottom: 1px solid var(--border);
            transition: background 0.1s;
        }

        .cust-table tbody tr:last-child {
            border-bottom: none;
        }

        .cust-table tbody tr:hover {
            background: #FDFCFA;
        }

        .cust-table td {
            padding: 13px 16px;
            font-size: 13px;
            color: var(--text2);
            vertical-align: middle;
        }

        .cust-table td:first-child {
            padding-left: 20px;
        }

        .cust-table td:last-child {
            padding-right: 20px;
        }

        /* ID cell */
        .id-cell {
            font-size: 11px;
            font-weight: 600;
            color: var(--text3);
            font-family: 'DM Mono', monospace;
            white-space: nowrap;
        }

        /* Identity cell */
        .identity-cell {
            display: flex;
            align-items: center;
            gap: 11px;
        }

        .cust-avatar {
            width: 38px;
            height: 38px;
            border-radius: var(--r-sm);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            font-weight: 700;
            color: var(--text2);
            background: var(--tag-bg);
            flex-shrink: 0;
            text-transform: uppercase;
        }

        .cust-name {
            font-size: 13px;
            font-weight: 600;
            color: var(--text1);
            margin-bottom: 2px;
            white-space: nowrap;
        }

        .cust-phone {
            font-size: 11px;
            color: var(--text3);
            display: flex;
            align-items: center;
            gap: 4px;
        }

        /* Gender pill */
        .gender-pill {
            font-size: 11px;
            font-weight: 600;
            padding: 4px 11px;
            border-radius: var(--r-pill);
        }

        .gender-pill.male {
            background: var(--blue-lt);
            color: var(--blue);
        }

        .gender-pill.female {
            background: var(--rose-lt);
            color: var(--rose);
        }

        .gender-pill.other {
            background: var(--tag-bg);
            color: var(--text3);
        }

        /* Date cell */
        .date-cell {
            font-size: 12px;
            color: var(--text3);
            white-space: nowrap;
        }

        /* Action cell */
        /* Action cell */
        .action-cell {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 6px;
        }

        .act-btn {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 6px 12px;
            font-family: var(--font-b);
            font-size: 12px;
            font-weight: 600;
            border-radius: var(--r-sm);
            border: none;
            cursor: pointer;
            transition: all 0.15s;
            white-space: nowrap;
        }

        .act-btn:active {
            transform: scale(0.97);
        }

        .act-btn.edit {
            background: var(--blue-lt);
            color: var(--blue);
            font-family: 'Kantumruy Pro', sans-serif;
        }

        .act-btn.edit:hover {
            background: #B5D4F4;
            color: #0C447C;
        }

        .act-btn.delete {
            background: var(--red-lt);
            color: var(--red);
            font-family: 'Kantumruy Pro', sans-serif;
        }

        .act-btn.delete:hover {
            background: #F7C1C1;
            color: #501313;
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
        }

        .empty-state h3 {
            font-family: var(--font-d);
            font-size: 17px;
            color: var(--text1);
            margin-bottom: 5px;
        }

        .empty-state p {
            font-size: 13px;
            margin: 0;
        }

        /* Pagination */
        .pagination-wrap {
            padding: 12px 20px;
            border-top: 1px solid var(--border);
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
            max-width: 440px;
            overflow: hidden;
            animation: modalIn 0.18s ease;
        }

        @keyframes modalIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .m-header {
            padding: 20px 24px 16px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 12px;
        }

        .m-title {
            font-family: var(--font-d);
            font-size: 17px;
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
            margin-top: 2px;
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

        .m-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
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
            padding: 9px 22px;
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

        .m-submit.is-edit {
            background: var(--blue);
        }
    </style>
@endsection

@section('content')
    <div class="cust-page">

        {{-- ── PAGE HEADER ── --}}
        <div class="page-header">
            <div>
                <p class="page-eyebrow">CRM</p>
                <h1 class="page-title">{{ __('main.customer_management') }}</h1>
                <p class="page-sub">{{ __('main.manage_customer_database') }}</p>
            </div>

            <div class="header-right">
                <form action="{{ route('customers.index') }}" method="GET" class="search-form max-sm:w-full">
                    <span class="search-icon">
                        <svg width="13" height="13" viewBox="0 0 16 16" fill="none">
                            <circle cx="6.5" cy="6.5" r="5" stroke="currentColor" stroke-width="1.6" />
                            <path d="M11 11l3.5 3.5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" />
                        </svg>
                    </span>
                    <input type="text" name="search" class="max-sm:w-full" placeholder="{{ __('main.search_by_name_phone') }}"
                        value="{{ request('search') }}">
                    <button type="submit" class="search-submit max-sm:min-h-[44px]">
                        <svg width="12" height="12" viewBox="0 0 16 16" fill="none">
                            <path d="M3 8h10M9 4l4 4-4 4" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </button>
                </form>

                <button class="add-btn max-sm:min-h-[44px]" onclick="prepareModal('add')">
                    <svg width="13" height="13" viewBox="0 0 16 16" fill="none">
                        <path d="M8 2v12M2 8h12" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                    </svg>
                    {{ __('main.add_new') }}
                </button>
            </div>
        </div>

        {{-- ── TABLE CARD ── --}}
        <div class="table-card">
            <div style="overflow-x: auto;" class="max-sm:overflow-x-auto">
                <table class="cust-table">
                    <thead>
                        <tr>
                            <th>{{ __('main.id') }}</th>
                            <th>{{ __('main.identity_contact') }}</th>
                            <th>{{ __('main.gender') }}</th>
                            <th>{{ __('main.registration_date') }}</th>
                            <th>{{ __('main.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($customers as $customer)
                            @php
                                $initial = strtoupper(substr($customer->name, 0, 1));
                                $genderCls = match ($customer->gender) {
                                    'Male' => 'male',
                                    'Female' => 'female',
                                    default => 'other',
                                };
                            @endphp
                            <tr>
                                {{-- ID --}}
                                <td><span class="id-cell">#{{ str_pad($customer->id, 5, '0', STR_PAD_LEFT) }}</span></td>

                                {{-- Identity --}}
                                <td>
                                    <div class="identity-cell">
                                        <div class="cust-avatar">{{ $initial }}</div>
                                        <div>
                                            <div class="cust-name">{{ $customer->name }}</div>
                                            <div class="cust-phone">
                                                <svg width="10" height="10" viewBox="0 0 16 16" fill="none">
                                                    <path
                                                        d="M3 3a1 1 0 011-1h2l1.5 3.5-1.5 1a9 9 0 004.5 4.5l1-1.5L15 11v2a1 1 0 01-1 1A13 13 0 012 3"
                                                        stroke="currentColor" stroke-width="1.4" stroke-linecap="round" />
                                                </svg>
                                                {{ $customer->phone ?? __('main.no_phone') }}
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                {{-- Gender --}}
                                <td>
                                    <span class="gender-pill {{ $genderCls }}">{{ $customer->gender }}</span>
                                </td>

                                {{-- Date --}}
                                <td class="date-cell">{{ $customer->created_at->format('d M Y') }}</td>

                                {{-- Actions --}}
                                <td>
                                    <div class="action-cell">
                                        <button class="act-btn edit max-sm:min-h-[44px]"
                                            onclick="prepareModal('edit', {{ json_encode($customer) }})">
                                            <svg width="12" height="12" viewBox="0 0 16 16" fill="none">
                                                <path d="M11.5 2.5l2 2L5 13H3v-2L11.5 2.5z" stroke="currentColor"
                                                    stroke-width="1.4" stroke-linejoin="round" />
                                            </svg>
                                            {{ __('main.edit') }}
                                        </button>

                                        <form action="{{ route('customers.destroy', $customer->id) }}" method="POST"
                                            style="display:inline;"
                                            onsubmit="return confirm('{{ __('main.confirm_delete_customer') }}')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="act-btn delete max-sm:min-h-[44px]">
                                                <svg width="12" height="12" viewBox="0 0 16 16" fill="none">
                                                    <path d="M3 5h10M6 5V3h4v2M6 8v5M10 8v5" stroke="currentColor"
                                                        stroke-width="1.4" stroke-linecap="round" />
                                                    <path d="M4 5l.5 9h7L12 5" stroke="currentColor" stroke-width="1.4"
                                                        stroke-linejoin="round" />
                                                </svg>
                                                {{ __('main.delete') }}
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">
                                    <div class="empty-state">
                                        <div class="empty-icon">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2" stroke="#A8A49E"
                                                    stroke-width="1.5" stroke-linecap="round" />
                                                <circle cx="9" cy="7" r="4" stroke="#A8A49E" stroke-width="1.5" />
                                                <path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75" stroke="#A8A49E"
                                                    stroke-width="1.5" stroke-linecap="round" />
                                            </svg>
                                        </div>
                                        <h3>{{ __('main.no_customers_found') }}</h3>
                                        <p>Add your first customer to get started.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($customers->hasPages())
                <div class="pagination-wrap">
                    {{ $customers->links() }}
                </div>
            @endif
        </div>

    </div>

    {{-- ── CUSTOMER MODAL ── --}}
    <div class="m-overlay" id="customerModal">
        <div class="m-box">
            <div class="m-header">
                <h2 class="m-title" id="modalTitle">{{ __('main.customer_information') }}</h2>
                <button class="m-close max-sm:min-h-[44px]" onclick="closeModal()">
                    <svg width="12" height="12" viewBox="0 0 16 16" fill="none">
                        <path d="M2 2l12 12M14 2L2 14" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                    </svg>
                </button>
            </div>

            <form id="customerForm" method="POST">
                @csrf
                <div id="methodField"></div>

                <div class="m-body">
                    <div class="m-field">
                        <label class="m-label">{{ __('main.full_name') }}</label>
                        <input type="text" class="m-input" name="name" id="inputName"
                            placeholder="{{ __('main.enter_customer_name') }}" required>
                    </div>

                    <div class="m-row">
                        <div class="m-field">
                            <label class="m-label">{{ __('main.gender') }}</label>
                            <select class="m-select" name="gender" id="inputGender">
                                <option value="Male">{{ __('main.male') }}</option>
                                <option value="Female">{{ __('main.female') }}</option>
                                <option value="-">—</option>
                            </select>
                        </div>
                        <div class="m-field">
                            <label class="m-label">{{ __('main.phone_number') }}</label>
                            <input type="text" class="m-input" name="phone" id="inputPhone"
                                placeholder="{{ __('main.enter_phone_number') }}">
                        </div>
                    </div>
                </div>

                <div class="m-footer">
                    <button type="button" class="m-cancel max-sm:min-h-[44px]" onclick="closeModal()">{{ __('main.cancel') }}</button>
                    <button type="submit" class="m-submit max-sm:min-h-[44px]" id="btnSubmit">{{ __('main.save_record') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        const T = {
            editRecord: '{{ __('main.edit_customer_record') }}',
            newRegistration: '{{ __('main.new_customer_registration') }}',
            updateChanges: '{{ __('main.update_changes') }}',
            registerCustomer: '{{ __('main.register_customer') }}'
        };

        function openModal() {
            document.getElementById('customerModal').classList.add('open');
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            document.getElementById('customerModal').classList.remove('open');
            document.body.style.overflow = '';
        }

        document.getElementById('customerModal').addEventListener('click', e => {
            if (e.target === document.getElementById('customerModal')) closeModal();
        });

        document.addEventListener('keydown', e => {
            if (e.key === 'Escape') closeModal();
        });

        function prepareModal(mode, data = null) {
            const form = document.getElementById('customerForm');
            const title = document.getElementById('modalTitle');
            const methodField = document.getElementById('methodField');
            const btnSubmit = document.getElementById('btnSubmit');

            if (mode === 'edit' && data) {
                title.textContent = T.editRecord;
                form.action = `/customers/${data.id}`;
                methodField.innerHTML = '<input type="hidden" name="_method" value="PUT">';
                btnSubmit.textContent = T.updateChanges;
                btnSubmit.className = 'm-submit is-edit';
                document.getElementById('inputName').value = data.name;
                document.getElementById('inputGender').value = data.gender;
                document.getElementById('inputPhone').value = data.phone ?? '';
            } else {
                title.textContent = T.newRegistration;
                form.action = "{{ route('customers.store') }}";
                methodField.innerHTML = '';
                btnSubmit.textContent = T.registerCustomer;
                btnSubmit.className = 'm-submit';
                form.reset();
            }

            openModal();
        }
    </script>
@endsection