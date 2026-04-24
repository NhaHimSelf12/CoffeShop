@extends('layouts.app')

@section('page_title', 'Identity & Security Settings')

@section('content')
<div class="row align-items-center mb-5">
    <div class="col-md-6 mb-3 mb-md-0 px-4">
        <h3 class="fw-bold text-main mb-1">Account & Identity</h3>
        <p class="text-muted small mb-0">Manage your personal information and maintain account security protocols.</p>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-10 mx-auto">
        <div class="card border-0 shadow-sm p-4 px-md-5">
            <h5 class="fw-bold mb-4 text-main font-outfit border-bottom pb-4">Personal Identity Settings</h5>
            
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-4 border-bottom pb-5 mb-5 align-items-center">
                    <div class="col-md-3 text-center">
                        <div class="position-relative d-inline-block">
                             <img src="{{ Auth::user()->image ? asset('storage/'.Auth::user()->image) : 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name).'&background=6366f1&color=fff&size=200' }}" 
                                  class="rounded-2xl shadow-lg mb-3" 
                                  width="140" height="140" 
                                  id="avatar-preview"
                                  style="object-fit: cover;">
                             <div class="small text-muted mt-2">Identity Shield</div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <label for="image" class="form-label text-muted small fw-bold text-uppercase">Update Identity Portrait</label>
                        <input type="file" name="image" id="image" class="form-control bg-light border-0 py-3 ps-4 shadow-sm @error('image') is-invalid @enderror">
                        <div class="text-muted small mt-2 d-flex align-items-center justify-content-between">
                            <span><i class="fas fa-info-circle me-2 opacity-50"></i> Recommended: Square image, max 2MB.</span>
                            @if(Auth::user()->image)
                                <button type="button" class="btn btn-link text-danger p-0 small text-decoration-none" onclick="if(confirm('Reset identity portrait?')) document.getElementById('delete-avatar-form').submit();">Clear Portrait</button>
                            @endif
                        </div>
                        @error('image')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
@if(Auth::user()->image)
<form id="delete-avatar-form" action="{{ route('profile.image.delete') }}" method="POST" style="display:none;">
    @csrf
    @method('DELETE')
</form>
@endif

                <div class="row g-4">
                    <!-- Name -->
                    <div class="col-md-6">
                        <label for="name" class="form-label text-muted small fw-bold text-uppercase">Full Display Name</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-0 py-3 ps-4"><i class="fas fa-user-circle text-muted"></i></span>
                            <input type="text" name="name" id="name" class="form-control bg-light border-0 py-3 pe-4 @error('name') is-invalid @enderror" 
                                   placeholder="Enter your name" value="{{ old('name', $user->name) }}" required>
                        </div>
                        @error('name')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="col-md-6">
                        <label for="email" class="form-label text-muted small fw-bold text-uppercase">Email Address Access</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-0 py-3 ps-4"><i class="fas fa-envelope text-muted"></i></span>
                            <input type="email" name="email" id="email" class="form-control bg-light border-0 py-3 pe-4 @error('email') is-invalid @enderror" 
                                   placeholder="yourname@email.com" value="{{ old('email', $user->email) }}" required>
                        </div>
                        @error('email')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 mt-5">
                        <div class="card p-4 bg-light border-0 shadow-none mb-4">
                            <h6 class="fw-bold text-main mb-3">Security & Password Shield</h6>
                            <p class="text-muted small">Update your password to high-strength complexity for maximum protection. Leave blank if you wish to maintain current credentials.</p>
                            
                            <div class="row g-4 mt-1">
                                <!-- Password -->
                                <div class="col-md-6">
                                    <label for="password" class="form-label text-muted small fw-bold text-uppercase">New Private Password</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-white border-0 py-3 ps-4 shadow-sm"><i class="fas fa-shield-alt text-muted opacity-50"></i></span>
                                        <input type="password" name="password" id="password" class="form-control bg-white border-0 py-3 pe-4 shadow-sm @error('password') is-invalid @enderror" 
                                               placeholder="••••••••">
                                    </div>
                                    @error('password')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Confirm Password -->
                                <div class="col-md-6">
                                    <label for="password_confirmation" class="form-label text-muted small fw-bold text-uppercase">Verify New Password</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-white border-0 py-3 ps-4 shadow-sm"><i class="fas fa-lock text-muted opacity-50"></i></span>
                                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control bg-white border-0 py-3 pe-4 shadow-sm" 
                                               placeholder="••••••••">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 text-end">
                        <button type="submit" class="btn btn-primary px-5 py-3 rounded-pill brand-font shadow-lg text-uppercase letter-spacing-1">
                            Synchronize Identity Profile
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
