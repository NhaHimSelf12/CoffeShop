@extends('layouts.app')

@section('page_title', __('main.our_story'))

@section('styles')
    <style>
        /* ── Page header ── */
        .story-header {
            background: linear-gradient(135deg, #1a0f0a 0%, #3d2410 100%);
            border-radius: 20px;
            padding: 40px 40px;
            margin-bottom: 36px;
            color: #fff;
            position: relative;
            overflow: hidden;
        }

        .story-header::after {
            content: '';
            position: absolute;
            top: -40px;
            right: -40px;
            width: 220px;
            height: 220px;
            border-radius: 50%;
            background: rgba(232, 165, 75, .12);
        }

        .story-header h2 {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
        }

        /* ── Member card ── */
        .member-card {
            border: 0;
            border-radius: 20px;
            box-shadow: 0 4px 20px rgba(26, 15, 10, .08);
            overflow: hidden;
            transition: transform .25s, box-shadow .25s;
            background: #fff;
        }

        .member-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 14px 36px rgba(26, 15, 10, .13);
        }

        /* photo area */
        .member-photo {
            position: relative;
            height: 230px;
            overflow: hidden;
            cursor: pointer;
        }

        .member-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform .35s ease;
        }

        .member-card:hover .member-photo img {
            transform: scale(1.06);
        }

        /* hover overlay */
        .photo-hover {
            position: absolute;
            inset: 0;
            background: rgba(26, 15, 10, .58);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 6px;
            opacity: 0;
            transition: opacity .22s ease;
        }

        .member-card:hover .photo-hover {
            opacity: 1;
        }

        .photo-hover .cam-btn {
            width: 54px;
            height: 54px;
            border-radius: 50%;
            background: rgba(232, 165, 75, .92);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            color: #1a0f0a;
            box-shadow: 0 4px 16px rgba(0, 0, 0, .3);
            transform: translateY(6px);
            transition: transform .22s ease;
        }

        .member-card:hover .cam-btn {
            transform: translateY(0);
        }

        .photo-hover p {
            color: #fff;
            font-size: .8rem;
            font-weight: 600;
            margin: 0;
            letter-spacing: .04em;
        }

        /* role badge */
        .role-badge {
            display: inline-block;
            font-size: .68rem;
            font-weight: 700;
            letter-spacing: .07em;
            text-transform: uppercase;
            padding: 3px 12px;
            border-radius: 20px;
            background: rgba(192, 119, 54, .12);
            color: #c07736;
            margin-bottom: 6px;
        }

        /* action buttons */
        .card-actions .btn-upload {
            background: rgba(192, 119, 54, .1);
            color: #c07736;
            border: 1.5px dashed #c07736;
            border-radius: 30px;
            font-size: .8rem;
            font-weight: 600;
            padding: 6px 14px;
            transition: background .2s;
        }

        .card-actions .btn-upload:hover {
            background: rgba(192, 119, 54, .2);
        }

        .card-actions .btn-edit {
            background: rgba(99, 102, 241, .08);
            color: #6366f1;
            border: 1.5px dashed #6366f1;
            border-radius: 30px;
            font-size: .8rem;
            font-weight: 600;
            padding: 6px 14px;
            transition: background .2s;
        }

        .card-actions .btn-edit:hover {
            background: rgba(99, 102, 241, .18);
        }

        /* ── Modals ── */
        .modal-content {
            border: 0;
            border-radius: 22px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(26, 15, 10, .18);
        }

        .modal-top-bar {
            background: linear-gradient(135deg, #1a0f0a, #3d2410);
            padding: 24px 24px 18px;
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .modal-top-bar img {
            width: 68px;
            height: 68px;
            object-fit: cover;
            border-radius: 14px;
            border: 2px solid rgba(232, 165, 75, .5);
        }

        .modal-top-bar h5 {
            color: #fff;
            font-weight: 700;
            margin: 0 0 2px;
        }

        .modal-top-bar small {
            color: rgba(255, 255, 255, .5);
            font-size: .78rem;
        }

        /* drop zone */
        .dz-box {
            border: 2px dashed #d4c5b5;
            border-radius: 14px;
            background: #fdf6ee;
            padding: 26px 16px;
            text-align: center;
            cursor: pointer;
            transition: border-color .2s, background .2s;
        }

        .dz-box:hover,
        .dz-box.over {
            border-color: #c07736;
            background: rgba(192, 119, 54, .05);
        }

        .dz-box input[type=file] {
            display: none;
        }

        /* flash toast */
        .flash-toast {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            min-width: 280px;
            animation: toastIn .3s ease;
        }

        @keyframes toastIn {
            from {
                opacity: 0;
                transform: translateX(50px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
    </style>
@endsection

@section('content')

    {{-- Flash --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible flash-toast shadow rounded-3 border-0">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible flash-toast shadow rounded-3 border-0">
            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Page header --}}
    <div class="story-header">
        <h2 class="fw-bold mb-2">{{ __('main.faces_behind_counnercoffe') }}</h2>
        <p class="mb-0" style="opacity:.65; max-width:520px;">
            {{ __('main.meet_team_description') }}
        </p>
    </div>

    {{-- 5 Member Cards Grid --}}
    <div class="row g-4 row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-5" id="member-grid">
        @foreach($members as $member)
            <div class="col">
                <div class="member-card card h-100">

                    {{-- Photo (click = upload modal) --}}
                    <div class="member-photo" style="cursor: pointer; position: relative;"
                        onclick="openUpload({{ $member->id }}, '{{ addslashes($member->name) }}', '{{ $member->image ? asset($member->image) : '' }}')">

                        @if($member->image)
                            <img src="{{ asset($member->image) }}" alt="{{ $member->name }}" class="card-img-top"
                                style="object-fit: cover; height: 200px; width: 100%;">
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($member->name) }}&background=2d1a0e&color=e8a54b&size=400"
                                alt="{{ $member->name }}" class="card-img-top">
                        @endif

                        <div class="photo-hover">
                            <div class="cam-btn"><i class="fas fa-camera"></i></div>
                            <p>{{ __('main.change_photo') }}</p>
                        </div>
                    </div>

                    {{-- Info --}}
                    <div class="card-body p-3 pb-2">
                        <div class="role-badge mb-2" style="font-size: 0.75rem;">{{ $member->role }}</div>
                        <h5 class="fw-bold mb-1" style="color:#1a0f0a; font-size:1rem;">{{ $member->name }}</h5>
                        <p class="text-muted small mb-0"
                            style="line-height:1.4; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                            {{ $member->bio }}
                        </p>
                    </div>

                    {{-- Actions --}}
                    <div class="card-footer bg-transparent border-0 px-3 pb-3 pt-2">
                        <div class="d-flex gap-1 card-actions">
                            <button class="btn btn-sm btn-upload flex-grow-1"
                                onclick="openUpload({{ $member->id }}, '{{ addslashes($member->name) }}', '{{ $member->image ? asset($member->image) : '' }}')">
                                <i class="fas fa-camera"></i>
                            </button>
                            <button class="btn btn-sm btn-edit flex-grow-1"
                                onclick="openEdit({{ $member->id }}, '{{ addslashes($member->name) }}', '{{ addslashes($member->role) }}', '{{ addslashes($member->bio) }}', '{{ $member->image ? asset($member->image) : '' }}')">
                                <i class="fas fa-pen"></i> {{ __('main.edit') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    {{-- ═══════════════════════════════════════ --}}
    {{-- MODAL 1 — Upload Photo --}}
    {{-- ═══════════════════════════════════════ --}}
    <div class="modal fade" id="modalUpload" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width:420px;">
            <div class="modal-content">

                <div class="modal-top-bar">
                    <img id="up-preview-img"
                        src="https://ui-avatars.com/api/?background=2d1a0e&color=e8a54b&size=200&name=M" alt="preview"
                        id="up-preview-img">
                    <div class="flex-grow-1">
                        <h5 id="up-member-name">{{ __('main.member') }}</h5>
                        <small>{{ __('main.upload_new_photo') }}</small>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body p-4">
                    <form id="form-upload" method="POST" enctype="multipart/form-data" action="">
                        @csrf

                        {{-- Drop zone --}}
                        <div class="dz-box mb-3" id="dz" onclick="document.getElementById('file-input').click()">
                            <input type="file" id="file-input" name="image"
                                accept="image/jpeg,image/png,image/jpg,image/gif,image/webp">
                            <div id="dz-idle">
                                <i class="fas fa-cloud-upload-alt fa-2x mb-2" style="color:#c07736;opacity:.8;"></i>
                                <p class="fw-bold small mb-1" style="color:#1a0f0a;">{{ __('main.click_or_drag_here') }}</p>
                                <p class="text-muted mb-0" style="font-size:.75rem;">{{ __('main.file_formats') }}</p>
                            </div>
                            <div id="dz-ready" class="d-none">
                                <i class="fas fa-check-circle fa-2x text-success mb-2"></i>
                                <p class="fw-bold small text-success mb-1" id="file-name">—</p>
                                <p class="text-muted mb-0" style="font-size:.75rem;">{{ __('main.ready_to_upload') }}</p>
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn fw-bold rounded-pill flex-grow-1 py-2"
                                style="background:linear-gradient(135deg,#c07736,#e8a54b);color:#fff;border:0;">
                                <i class="fas fa-upload me-2"></i>{{ __('main.upload_photo') }}
                            </button>
                            <button type="button" id="btn-del-photo"
                                class="btn btn-outline-danger rounded-pill px-3 py-2 d-none" onclick="deletePhoto()">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </div>
                    </form>

                    {{-- hidden delete form --}}
                    <form id="form-delete" method="POST" action="" class="d-none">
                        @csrf @method('DELETE')
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════════════════════════════════════ --}}
    {{-- MODAL 2 — Edit Info --}}
    {{-- ═══════════════════════════════════════ --}}
    <div class="modal fade" id="modalEdit" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width:440px;">
            <div class="modal-content">

                <div class="modal-top-bar">
                    <img id="edit-preview-img" src="https://ui-avatars.com/api/?background=6366f1&color=fff&size=200&name=M"
                        alt="preview">
                    <div class="flex-grow-1">
                        <h5 id="edit-display-name" style="color:#fff; font-weight:700; margin:0 0 2px;">
                            {{ __('main.member') }}
                        </h5>
                        <small
                            style="color:rgba(255,255,255,.5); font-size:.78rem;">{{ __('main.edit_member_info') }}</small>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body p-4">
                    <form id="form-edit" method="POST" action="">
                        @csrf @method('PATCH')

                        {{-- Name --}}
                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold text-uppercase"
                                style="font-size:.72rem;">{{ __('main.full_name') }}</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0 py-3 px-3"><i
                                        class="fas fa-user text-muted"></i></span>
                                <input type="text" name="name" id="edit-name" class="form-control bg-light border-0 py-3"
                                    placeholder="{{ __('main.member_name') }}" required>
                            </div>
                        </div>

                        {{-- Role --}}
                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold text-uppercase"
                                style="font-size:.72rem;">{{ __('main.role_position') }}</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0 py-3 px-3"><i
                                        class="fas fa-briefcase text-muted"></i></span>
                                <input type="text" name="role" id="edit-role" class="form-control bg-light border-0 py-3"
                                    placeholder="{{ __('main.example_head_barista') }}" required>
                            </div>
                        </div>

                        {{-- Bio --}}
                        <div class="mb-4">
                            <label class="form-label text-muted small fw-bold text-uppercase"
                                style="font-size:.72rem;">{{ __('main.short_bio') }}</label>
                            <textarea name="bio" id="edit-bio" class="form-control bg-light border-0 py-3" rows="3"
                                placeholder="{{ __('main.short_description') }}" style="resize:none;"></textarea>
                        </div>

                        <button type="submit" class="btn fw-bold rounded-pill w-100 py-2"
                            style="background:linear-gradient(135deg,#6366f1,#818cf8);color:#fff;border:0;">
                            <i class="fas fa-save me-2"></i>{{ __('main.save_changes') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        // ── Upload Photo modal ─────────────────────────────
        function openUpload(id, name, imgUrl) {
            // preview
            const fallback = 'https://ui-avatars.com/api/?background=2d1a0e&color=e8a54b&size=200&name=' + encodeURIComponent(name);
            document.getElementById('up-preview-img').src = imgUrl || fallback;
            document.getElementById('up-member-name').textContent = name;

            // form actions
            document.getElementById('form-upload').action = '/story/upload/' + id;
            document.getElementById('form-delete').action = '/story/delete/' + id;

            // delete button (show only if custom image exists)
            const hasImg = imgUrl && !imgUrl.includes('ui-avatars');
            document.getElementById('btn-del-photo').classList.toggle('d-none', !hasImg);

            // reset drop zone
            document.getElementById('file-input').value = '';
            document.getElementById('dz-idle').classList.remove('d-none');
            document.getElementById('dz-ready').classList.add('d-none');

            new bootstrap.Modal(document.getElementById('modalUpload')).show();
        }

        // file chosen → live preview
        document.getElementById('file-input').addEventListener('change', function () {
            const file = this.files[0];
            if (!file) return;
            document.getElementById('file-name').textContent = file.name;
            document.getElementById('dz-idle').classList.add('d-none');
            document.getElementById('dz-ready').classList.remove('d-none');
            const r = new FileReader();
            r.onload = e => document.getElementById('up-preview-img').src = e.target.result;
            r.readAsDataURL(file);
        });

        // drag & drop
        const dz = document.getElementById('dz');
        ['dragenter', 'dragover'].forEach(ev => dz.addEventListener(ev, e => { e.preventDefault(); dz.classList.add('over'); }));
        ['dragleave', 'drop'].forEach(ev => dz.addEventListener(ev, () => dz.classList.remove('over')));
        dz.addEventListener('drop', e => {
            e.preventDefault();
            const file = e.dataTransfer.files[0];
            if (!file) return;
            const dt = new DataTransfer(); dt.items.add(file);
            document.getElementById('file-input').files = dt.files;
            document.getElementById('file-input').dispatchEvent(new Event('change'));
        });

        function deletePhoto() {
            if (confirm('{{ __('main.confirm_remove_photo') }}')) {
                document.getElementById('form-delete').submit();
            }
        }

        // ── Edit Info modal ────────────────────────────────
        function openEdit(id, name, role, bio, imgUrl) {
            const fallback = 'https://ui-avatars.com/api/?background=6366f1&color=fff&size=200&name=' + encodeURIComponent(name);
            document.getElementById('edit-preview-img').src = imgUrl || fallback;
            document.getElementById('edit-display-name').textContent = name;

            document.getElementById('edit-name').value = name;
            document.getElementById('edit-role').value = role;
            document.getElementById('edit-bio').value = bio;

            document.getElementById('form-edit').action = '/story/update/' + id;

            new bootstrap.Modal(document.getElementById('modalEdit')).show();
        }

        // ── Auto-dismiss toast ─────────────────────────────
        setTimeout(() => {
            document.querySelectorAll('.flash-toast').forEach(el => {
                bootstrap.Alert.getOrCreateInstance(el).close();
            });
        }, 4000);
    </script>
@endsection