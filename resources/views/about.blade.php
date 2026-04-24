@extends('layouts.app')

@section('page_title', __('main.about'))

@section('content')
    <div class="row mb-5">
        <div class="col-12">
            <h1 class="mb-3">{{ __('main.welcome_to_counnercoffe') }}</h1>
            <p class="lead text-muted">{{ __('main.about_lead') }}</p>
            <img src="{{ asset('images/about_poscoffe.png') }}" class="img-fluid rounded border mb-4"
                alt="{{ __('main.about_poscoffe') }}" style="max-height: 400px; width: 100%; object-fit: cover;">
        </div>
    </div>

    <div class="row mb-5">
        <div class="col-md-6 mb-4">
            <h2>{{ __('main.rooted_in_quality') }}</h2>
            <p>{{ __('main.rooted_in_quality_desc') }}</p>
            <div class="row mt-4 text-center">
                <div class="col-6">
                    <div class="border p-3 rounded bg-light">
                        <h3>100%</h3>
                        <p class="mb-0">{{ __('main.organic_beans') }}</p>
                    </div>
                </div>
                <div class="col-6">
                    <div class="border p-3 rounded bg-light">
                        <h3>24/7</h3>
                        <p class="mb-0">{{ __('main.service_excellence') }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-white">
                    <h4 class="mb-0">{{ __('main.core_values') }}</h4>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex align-items-center">
                        <i class="fas fa-leaf text-success fa-2x me-3"></i>
                        <div>
                            <h6 class="mb-1">{{ __('main.sustainability_first') }}</h6>
                            <small class="text-muted">{{ __('main.sustainability_first_desc') }}</small>
                        </div>
                    </li>
                    <li class="list-group-item d-flex align-items-center">
                        <i class="fas fa-users text-primary fa-2x me-3"></i>
                        <div>
                            <h6 class="mb-1">{{ __('main.community_driven') }}</h6>
                            <small class="text-muted">{{ __('main.community_driven_desc') }}</small>
                        </div>
                    </li>
                    <li class="list-group-item d-flex align-items-center">
                        <i class="fas fa-award text-warning fa-2x me-3"></i>
                        <div>
                            <h6 class="mb-1">{{ __('main.uncompromising_quality') }}</h6>
                            <small class="text-muted">{{ __('main.uncompromising_quality_desc') }}</small>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card h-100 text-center p-4">
                <i class="fas fa-tint fa-3x text-secondary mb-3"></i>
                <h5>{{ __('main.artisan_brewing') }}</h5>
                <p class="text-muted">{{ __('main.artisan_brewing_desc') }}</p>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card h-100 text-center p-4">
                <i class="fas fa-home fa-3x text-secondary mb-3"></i>
                <h5>{{ __('main.modern_atmosphere') }}</h5>
                <p class="text-muted">{{ __('main.modern_atmosphere_desc') }}</p>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card h-100 text-center p-4">
                <i class="fas fa-seedling fa-3x text-secondary mb-3"></i>
                <h5>{{ __('main.ethical_sourcing') }}</h5>
                <p class="text-muted">{{ __('main.ethical_sourcing_desc') }}</p>
            </div>
        </div>
    </div>
@endsection