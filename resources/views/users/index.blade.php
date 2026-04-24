@extends('layouts.app')

@section('page_title', 'Member Access & Control')

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
            --blue: #185FA5;
            --blue-lt: #E6F1FB;
            --gold: #92621A;
            --gold-lt: #FEF3DC;
            --tag-bg: #EDE9E2;
            --font-d: 'Playfair Display', serif;
            --font-b: 'DM Sans', sans-serif;
            --r: 12px;
            --r-sm: 8px;
            --r-pill: 100px;
        }

        .usr-page {
            font-family: var(--font-b);
            background: var(--bg);
            min-height: 100vh;
            padding: 32px 28px 56px;
            color: var(--text1);
        }

        /* ── TOAST ── */
        .flash-toast {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            min-width: 280px;
            background: var(--surface);
            border: 1px solid var(--border2);
            border-radius: var(--r);
            padding: 14px 18px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 13px;
            font-weight: 500;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
            animation: toastIn 0.3s ease;
            font-family: var(--font-b);
        }

        .flash-toast.success {
            border-left: 3px solid var(--green);
            color: var(--green);
        }

        .flash-toast.error {
            border-left: 3px solid var(--red);
            color: var(--red);
        }

        .toast-close {
            margin-left: auto;
            background: none;
            border: none;
            cursor: pointer;
            color: var(--text3);
            font-size: 16px;
            line-height: 1;
            padding: 0;
        }

        @keyframes toastIn {
            from {
                opacity: 0;
                transform: translateX(32px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
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
            flex-wrap: wrap;
            gap: 12px;
        }

        .toolbar-left {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .record-label {
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

        /* ── TABLE ── */
        .usr-table {
            width: 100%;
            border-collapse: collapse;
        }

        .usr-table thead tr {
            background: var(--bg);
            border-bottom: 1px solid var(--border2);
        }

        .usr-table th {
            padding: 11px 16px;
            font-size: 10.5px;
            font-weight: 600;
            letter-spacing: 0.8px;
            text-transform: uppercase;
            color: var(--text3);
            text-align: left;
            white-space: nowrap;
        }

        .usr-table th:first-child {
            padding-left: 20px;
        }

        .usr-table th:last-child {
            padding-right: 20px;
            text-align: right;
        }

        .usr-table tbody tr {
            border-bottom: 1px solid var(--border);
            transition: background 0.1s;
        }

        .usr-table tbody tr:last-child {
            border-bottom: none;
        }

        .usr-table tbody tr:hover {
            background: #FDFCFA;
        }

        .usr-table td {
            padding: 14px 16px;
            font-size: 13px;
            color: var(--text2);
            vertical-align: middle;
        }

        .usr-table td:first-child {
            padding-left: 20px;
        }

        .usr-table td:last-child {
            padding-right: 20px;
        }

        /* Member cell */
        .member-cell {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .avatar-wrap {
            position: relative;
            flex-shrink: 0;
            cursor: pointer;
        }

        .avatar-img {
            width: 40px;
            height: 40px;
            border-radius: var(--r-sm);
            object-fit: cover;
            display: block;
            transition: transform 0.15s;
        }

        .avatar-wrap:hover .avatar-img {
            transform: scale(1.05);
        }

        .avatar-placeholder {
            width: 40px;
            height: 40px;
            border-radius: var(--r-sm);
            background: var(--tag-bg);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            font-weight: 700;
            color: var(--text2);
            text-transform: uppercase;
            transition: transform 0.15s;
        }

        .avatar-wrap:hover .avatar-placeholder {
            transform: scale(1.05);
        }

        .avatar-cam {
            position: absolute;
            bottom: -4px;
            right: -4px;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            background: var(--accent);
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid var(--surface);
        }

        .member-name {
            font-size: 13px;
            font-weight: 600;
            color: var(--text1);
            margin-bottom: 2px;
        }

        .you-badge {
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 0.5px;
            color: var(--accent);
            background: var(--accent-lt);
            padding: 1px 7px;
            border-radius: var(--r-pill);
        }

        .email-cell {
            font-size: 12px;
            color: var(--text3);
        }

        /* Role badge */
        .role-pill {
            font-size: 11px;
            font-weight: 600;
            padding: 4px 12px;
            border-radius: var(--r-pill);
        }

        .role-pill.admin {
            background: var(--accent-lt);
            color: var(--accent);
        }

        .role-pill.staff {
            background: var(--green-lt);
            color: var(--green);
        }

        .date-cell {
            font-size: 12px;
            color: var(--text3);
            white-space: nowrap;
        }

        /* Action buttons */
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
            font-weight: 500;
            border-radius: var(--r-pill);
            border: 1px solid var(--border2);
            background: var(--bg);
            color: var(--text2);
            cursor: pointer;
            transition: all 0.15s;
            white-space: nowrap;
            text-decoration: none;
        }

        .act-btn:hover {
            border-color: var(--accent);
            color: var(--accent);
            background: var(--accent-lt);
        }

        .act-btn.promote:hover {
            border-color: var(--blue);
            color: var(--blue);
            background: var(--blue-lt);
        }

        .act-btn.demote:hover {
            border-color: var(--gold);
            color: var(--gold);
            background: var(--gold-lt);
        }

        .act-btn.remove:hover {
            border-color: var(--red);
            color: var(--red);
            background: var(--red-lt);
        }

        /* Pagination */
        .pagination-wrap {
            padding: 12px 20px;
            border-top: 1px solid var(--border);
            display: flex;
            justify-content: flex-end;
        }

        /* ── MODAL ── */
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
            max-width: 420px;
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
            margin: 0 0 3px;
        }

        .m-subtitle {
            font-size: 12px;
            color: var(--text3);
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

        /* Avatar preview in modal */
        .m-avatar-preview {
            text-align: center;
            margin-bottom: 20px;
        }

        .m-avatar-img {
            width: 90px;
            height: 90px;
            border-radius: var(--r);
            object-fit: cover;
            border: 3px solid var(--surface2);
            transition: all 0.25s;
        }

        .m-avatar-name {
            font-size: 13px;
            font-weight: 500;
            color: var(--text2);
            margin-top: 8px;
        }

        /* Drop zone */
        .drop-zone {
            border: 1.5px dashed var(--border2);
            border-radius: var(--r);
            background: var(--bg);
            padding: 22px 16px;
            text-align: center;
            cursor: pointer;
            transition: border-color 0.15s, background 0.15s;
            margin-bottom: 14px;
        }

        .drop-zone:hover,
        .drop-zone.dragging {
            border-color: var(--accent);
            background: var(--accent-lt);
        }

        .drop-zone input[type="file"] {
            display: none;
        }

        .dz-icon {
            width: 36px;
            height: 36px;
            background: var(--surface2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 8px;
        }

        .dz-title {
            font-size: 13px;
            font-weight: 500;
            color: var(--text1);
            margin-bottom: 3px;
        }

        .dz-hint {
            font-size: 11px;
            color: var(--text3);
        }

        .dz-selected {
            display: none;
        }

        .dz-selected.show {
            display: block;
        }

        .dz-default.hide {
            display: none;
        }

        .dz-filename {
            font-size: 12px;
            font-weight: 600;
            color: var(--green);
            margin-bottom: 2px;
        }

        .m-actions {
            display: flex;
            gap: 8px;
        }

        .m-upload-btn {
            flex: 1;
            height: 40px;
            background: var(--accent);
            color: #fff;
            border: none;
            border-radius: var(--r);
            font-family: var(--font-b);
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: opacity 0.15s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
        }

        .m-upload-btn:hover {
            opacity: 0.88;
        }

        .m-delete-btn {
            height: 40px;
            width: 40px;
            background: var(--bg);
            border: 1px solid var(--border2);
            border-radius: var(--r);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: var(--text3);
            transition: all 0.15s;
        }

        .m-delete-btn:hover {
            border-color: var(--red);
            color: var(--red);
            background: var(--red-lt);
        }

        .m-delete-btn.hidden {
            display: none;
        }
    </style>
@endsection

@section('content')
    <div class="usr-page">

        {{-- ── FLASH TOASTS ── --}}
        @if(session('success'))
            <div class="flash-toast success" id="flash-toast">
                <svg width="15" height="15" viewBox="0 0 16 16" fill="none">
                    <circle cx="8" cy="8" r="7" stroke="currentColor" stroke-width="1.5" />
                    <path d="M5 8l2 2 4-4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
                {{ session('success') }}
                <button class="toast-close" onclick="this.parentElement.remove()">×</button>
            </div>
        @endif

        @if(session('error'))
            <div class="flash-toast error" id="flash-toast">
                <svg width="15" height="15" viewBox="0 0 16 16" fill="none">
                    <circle cx="8" cy="8" r="7" stroke="currentColor" stroke-width="1.5" />
                    <path d="M8 5v4M8 11v.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                </svg>
                {{ session('error') }}
                <button class="toast-close" onclick="this.parentElement.remove()">×</button>
            </div>
        @endif

        {{-- ── PAGE HEADER ── --}}
        <div class="page-header">
            <div>
                <p class="page-eyebrow">Administration</p>
                <h1 class="page-title">Team Members</h1>
                <p class="page-sub">Manage access levels, roles, and profile photos for your team.</p>
            </div>
        </div>

        {{-- ── TABLE CARD ── --}}
        <div class="table-card">
            <div class="table-toolbar">
                <div class="toolbar-left">
                    <span class="record-label">Members</span>
                    <span class="record-badge">{{ $users->total() }}</span>
                </div>
            </div>

            <div style="overflow-x: auto;">
                <table class="usr-table">
                    <thead>
                        <tr>
                            <th>Team member</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Joined</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            @php
                                $initials = collect(explode(' ', $user->name))->take(2)->map(fn($w) => strtoupper($w[0] ?? ''))->implode('');
                            @endphp
                            <tr>
                                {{-- Member --}}
                                <td>
                                    <div class="member-cell">
                                        <div class="avatar-wrap" title="Upload photo"
                                            onclick="openUploadModal({{ $user->id }}, '{{ addslashes($user->name) }}', '{{ $user->image ? asset('storage/' . $user->image) : '' }}', {{ $user->image ? 'true' : 'false' }})">
                                            @if($user->image)
                                                <img class="avatar-img" src="{{ asset('storage/' . $user->image) }}"
                                                    alt="{{ $user->name }}">
                                            @else
                                                <div class="avatar-placeholder">{{ $initials }}</div>
                                            @endif
                                            <div class="avatar-cam">
                                                <svg width="9" height="9" viewBox="0 0 16 16" fill="none">
                                                    <path
                                                        d="M6 2l1.5-1.5h1L10 2h3a1 1 0 011 1v9a1 1 0 01-1 1H3a1 1 0 01-1-1V3a1 1 0 011-1h3z"
                                                        stroke="white" stroke-width="1.4" />
                                                    <circle cx="8" cy="7.5" r="2" stroke="white" stroke-width="1.4" />
                                                </svg>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="member-name">{{ $user->name }}</div>
                                            @if($user->id === auth()->id())
                                                <span class="you-badge">YOU</span>
                                            @endif
                                        </div>
                                    </div>
                                </td>

                                {{-- Email --}}
                                <td class="email-cell">{{ $user->email }}</td>

                                {{-- Role --}}
                                <td>
                                    <span class="role-pill {{ $user->role === 'admin' ? 'admin' : 'staff' }}">
                                        {{ ucfirst($user->role) }}
                                    </span>
                                </td>

                                {{-- Joined --}}
                                <td class="date-cell">{{ $user->created_at->format('M d, Y') }}</td>

                                {{-- Actions --}}
                                <td>
                                    <div class="action-cell">
                                        <button class="act-btn"
                                            onclick="openUploadModal({{ $user->id }}, '{{ addslashes($user->name) }}', '{{ $user->image ? asset('storage/' . $user->image) : '' }}', {{ $user->image ? 'true' : 'false' }})">
                                            <svg width="12" height="12" viewBox="0 0 16 16" fill="none">
                                                <path
                                                    d="M6 2l1.5-1.5h1L10 2h3a1 1 0 011 1v9a1 1 0 01-1 1H3a1 1 0 01-1-1V3a1 1 0 011-1h3z"
                                                    stroke="currentColor" stroke-width="1.4" />
                                                <circle cx="8" cy="7.5" r="2" stroke="currentColor" stroke-width="1.4" />
                                            </svg>
                                            Photo
                                        </button>

                                        @if($user->id !== auth()->id())
                                            <form action="{{ route('users.toggle', $user->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf @method('PATCH')
                                                <button type="submit"
                                                    class="act-btn {{ $user->role === 'admin' ? 'demote' : 'promote' }}">
                                                    <svg width="12" height="12" viewBox="0 0 16 16" fill="none">
                                                        <path d="M2 10l4-4 4 4" stroke="currentColor" stroke-width="1.5"
                                                            stroke-linecap="round" stroke-linejoin="round" />
                                                        <path d="M14 6l-4 4-4-4" stroke="currentColor" stroke-width="1.5"
                                                            stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg>
                                                    {{ $user->role === 'admin' ? 'Demote' : 'Promote' }}
                                                </button>
                                            </form>

                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                                style="display:inline;"
                                                onsubmit="return confirm('Remove this member permanently?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="act-btn remove">
                                                    <svg width="12" height="12" viewBox="0 0 16 16" fill="none">
                                                        <path d="M3 5h10M6 5V3h4v2M6 8v5M10 8v5" stroke="currentColor"
                                                            stroke-width="1.4" stroke-linecap="round" />
                                                        <path d="M4 5l.5 9h7L12 5" stroke="currentColor" stroke-width="1.4"
                                                            stroke-linejoin="round" />
                                                    </svg>
                                                    Remove
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if($users->hasPages())
                <div class="pagination-wrap">
                    {{ $users->links() }}
                </div>
            @endif
        </div>

    </div>

    {{-- ── UPLOAD PHOTO MODAL ── --}}
    <div class="m-overlay" id="uploadModal">
        <div class="m-box">
            <div class="m-header">
                <div>
                    <h2 class="m-title">Profile Photo</h2>
                    <p class="m-subtitle" id="modal-subtitle">—</p>
                </div>
                <button class="m-close" onclick="closeModal()">
                    <svg width="12" height="12" viewBox="0 0 16 16" fill="none">
                        <path d="M2 2l12 12M14 2L2 14" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                    </svg>
                </button>
            </div>

            <div class="m-body">
                {{-- Avatar preview --}}
                <div class="m-avatar-preview">
                    <img id="modal-avatar-preview" class="m-avatar-img" src="" alt="Preview">
                    <div class="m-avatar-name" id="modal-username-label">—</div>
                </div>

                {{-- Upload form --}}
                <form id="upload-form" method="POST" enctype="multipart/form-data" action="">
                    @csrf
                    <div class="drop-zone" id="drop-zone" onclick="document.getElementById('modal-file-input').click()">
                        <input type="file" id="modal-file-input" name="image"
                            accept="image/jpeg,image/png,image/jpg,image/gif,image/webp">

                        <div class="dz-default" id="dz-default">
                            <div class="dz-icon">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                                    <path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4M17 8l-5-5-5 5M12 3v12" stroke="#A8A49E"
                                        stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                            <div class="dz-title">Click or drag to upload</div>
                            <div class="dz-hint">JPG, PNG, WEBP · max 2MB</div>
                        </div>

                        <div class="dz-selected" id="dz-selected">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                style="margin: 0 auto 6px; display:block;">
                                <circle cx="12" cy="12" r="10" stroke="#1D4E3A" stroke-width="1.8" />
                                <path d="M8 12l3 3 5-5" stroke="#1D4E3A" stroke-width="1.8" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                            <div class="dz-filename" id="dz-filename">file.jpg</div>
                            <div class="dz-hint">Ready to upload</div>
                        </div>
                    </div>

                    <div class="m-actions">
                        <button type="submit" class="m-upload-btn">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none">
                                <path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4M17 8l-5-5-5 5M12 3v12"
                                    stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                            Upload photo
                        </button>
                        <button type="button" class="m-delete-btn hidden" id="btn-delete-photo" title="Remove photo"
                            onclick="deletePhoto()">
                            <svg width="14" height="14" viewBox="0 0 16 16" fill="none">
                                <path d="M3 5h10M6 5V3h4v2M6 8v5M10 8v5" stroke="currentColor" stroke-width="1.4"
                                    stroke-linecap="round" />
                                <path d="M4 5l.5 9h7L12 5" stroke="currentColor" stroke-width="1.4"
                                    stroke-linejoin="round" />
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Hidden delete form --}}
    <form id="delete-photo-form" method="POST" action="" style="display:none;">
        @csrf @method('DELETE')
    </form>

@endsection

@section('scripts')
    <script>
        const DEFAULT_AVATAR = name =>
            `https://ui-avatars.com/api/?background=EDE9E2&color=6B6760&size=200&name=${encodeURIComponent(name)}`;

        function openModal(id) {
            document.getElementById(id).classList.add('open');
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            document.getElementById('uploadModal').classList.remove('open');
            document.body.style.overflow = '';
        }

        document.getElementById('uploadModal').addEventListener('click', e => {
            if (e.target === document.getElementById('uploadModal')) closeModal();
        });

        document.addEventListener('keydown', e => {
            if (e.key === 'Escape') closeModal();
        });

        function openUploadModal(userId, userName, currentImageUrl, hasImage) {
            document.getElementById('modal-subtitle').textContent = userName + "'s profile photo";
            document.getElementById('modal-username-label').textContent = userName;
            document.getElementById('modal-avatar-preview').src = currentImageUrl || DEFAULT_AVATAR(userName);
            document.getElementById('upload-form').action = '/users/' + userId + '/image';
            document.getElementById('delete-photo-form').action = '/users/' + userId + '/image';

            const delBtn = document.getElementById('btn-delete-photo');
            hasImage ? delBtn.classList.remove('hidden') : delBtn.classList.add('hidden');

            // Reset drop zone
            document.getElementById('modal-file-input').value = '';
            document.getElementById('dz-default').classList.remove('hide');
            document.getElementById('dz-selected').classList.remove('show');

            openModal('uploadModal');
        }

        // File select preview
        document.getElementById('modal-file-input').addEventListener('change', function () {
            const file = this.files[0];
            if (!file) return;

            document.getElementById('dz-filename').textContent = file.name;
            document.getElementById('dz-default').classList.add('hide');
            document.getElementById('dz-selected').classList.add('show');

            const reader = new FileReader();
            reader.onload = e => { document.getElementById('modal-avatar-preview').src = e.target.result; };
            reader.readAsDataURL(file);
        });

        // Drag & drop
        const dropZone = document.getElementById('drop-zone');
        ['dragenter', 'dragover'].forEach(evt => {
            dropZone.addEventListener(evt, e => { e.preventDefault(); dropZone.classList.add('dragging'); });
        });
        ['dragleave', 'drop'].forEach(evt => {
            dropZone.addEventListener(evt, () => dropZone.classList.remove('dragging'));
        });
        dropZone.addEventListener('drop', e => {
            e.preventDefault();
            const file = e.dataTransfer.files[0];
            if (!file) return;
            const dt = new DataTransfer();
            dt.items.add(file);
            const input = document.getElementById('modal-file-input');
            input.files = dt.files;
            input.dispatchEvent(new Event('change'));
        });

        function deletePhoto() {
            if (confirm('Remove this profile photo permanently?')) {
                document.getElementById('delete-photo-form').submit();
            }
        }

        // Auto-dismiss toast after 4s
        const toast = document.getElementById('flash-toast');
        if (toast) setTimeout(() => toast.remove(), 4000);
    </script>
@endsection