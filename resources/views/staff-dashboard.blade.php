@extends('layouts.app')

@section('page_title', 'Staff Workspace')

@section('content')
    <div class="row g-4 mb-5">
        <!-- Quick Actions Card -->
        <div class="col-12">
            <div class="card border-0 shadow-sm p-4 overflow-hidden"
                style="background: linear-gradient(135deg, #1e293b 0%, #334155 100%); color: white;">
                <div class="d-flex align-items-center justify-content-between position-relative" style="z-index: 2;">
                    <div>
                        <h2 class="fw-bold mb-1">Good Day, {{ Auth::user()->name }}! 👋</h2>
                        <p class="opacity-75 mb-4">Welcome to your daily workspace. Ready to serve some great coffee?</p>
                        <a href="{{ route('pos.index') }}"
                            class="btn btn-light btn-lg px-4 fw-bold rounded-pill text-dark border-0 shadow-sm">
                            <i class="fas fa-cash-register me-2"></i> Open POS Screen
                        </a>
                    </div>
                    <div class="d-none d-md-block opacity-25">
                        <i class="fas fa-mug-hot fa-10x"></i>
                    </div>
                </div>
                <!-- Decorative circle -->
                <div class="position-absolute"
                    style="width: 300px; height: 300px; background: rgba(255,255,255,0.05); border-radius: 50%; bottom: -100px; right: -50px; z-index: 1;">
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="card p-4 border-0 shadow-sm h-100">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="bg-primary bg-opacity-10 text-primary rounded-2xl p-3 lh-1">
                        <i class="fas fa-shopping-basket fa-2x"></i>
                    </div>
                    <h3 class="mb-0 fw-bold">{{ $total_orders }}</h3>
                </div>
                <h6 class="text-uppercase text-muted small fw-bold mb-1">Total checkouts</h6>
                <p class="text-muted small mb-0">Total orders handled recently</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-4 border-0 shadow-sm h-100">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="bg-info bg-opacity-10 text-info rounded-2xl p-3 lh-1">
                        <i class="fas fa-users fa-2x"></i>
                    </div>
                    <h3 class="mb-0 fw-bold">{{ $customers_count }}</h3>
                </div>
                <h6 class="text-uppercase text-muted small fw-bold mb-1">Loyal base</h6>
                <p class="text-muted small mb-0">Registered members in system</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-4 border-0 shadow-sm h-100">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="bg-warning bg-opacity-10 text-warning rounded-2xl p-3 lh-1">
                        <i class="fas fa-box-open fa-2x"></i>
                    </div>
                    <h3 class="mb-0 fw-bold">{{ $products_count }}</h3>
                </div>
                <h6 class="text-uppercase text-muted small fw-bold mb-1">Stock items</h6>
                <p class="text-muted small mb-0">Available products in menu</p>
            </div>
        </div>
    </div>

    <div class="row g-4 mt-2">
        <div class="col-lg-12">
            <div class="card p-4 border-0 shadow-sm h-100">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="fw-bold mb-0">Your Recent Sales Activity</h5>
                    <a href="{{ route('orders.index') }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">View All
                        History</a>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover align-middle border-0">
                        <thead class="bg-light text-muted small">
                            <tr>
                                <th class="border-0 rounded-start">ORDER ID</th>
                                <th class="border-0">CUSTOMER</th>
                                <th class="border-0">AMOUNT</th>
                                <th class="border-0">TIME</th>
                                <th class="border-0 rounded-end text-end">ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recent_orders as $order)
                                <tr>
                                    <td><span class="fw-bold text-dark">#{{ $order->id }}</span></td>
                                    <td>{{ $order->customer ? $order->customer->name : 'Walk-in Customer' }}</td>
                                    <td><span class="badge bg-success bg-opacity-10 text-success fw-bold p-2">$
                                            {{ number_format($order->total_amount, 2) }}</span></td>
                                    <td><span class="text-muted small">{{ $order->created_at->format('h:i A') }}</span></td>
                                    <td class="text-end">
                                        <a href="{{ route('orders.show', $order->id) }}"
                                            class="btn btn-sm btn-light rounded-pill px-3">Details</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5">
                                        <i class="fas fa-receipt fa-3x text-light mb-3"></i>
                                        <p class="text-muted mb-0">No sales recorded yet for today.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection