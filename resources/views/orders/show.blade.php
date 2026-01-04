@extends('layouts.app')

@section('title', 'Order #' . $order->id)

@section('content')
<div class="page-bg-image text-white min-vh-100 py-5">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="bg-dark bg-opacity-50 rounded-4 p-4 p-md-5 backdrop-blur">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h1 class="display-5 fw-bold"><i class="bi bi-receipt me-2"></i>Order #{{ $order->id }}</h1>
                        <a href="{{ route('orders.index') }}" class="btn btn-outline-light">
                            <i class="bi bi-arrow-left me-2"></i>Back to Orders
                        </a>
                    </div>
                    
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="card bg-dark bg-opacity-75 border-warning mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">Order Information</h5>
                                    <p class="mb-2"><strong>Order Date:</strong> {{ $order->created_at->format('d M Y, H:i') }}</p>
                                    <p class="mb-2">
                                        <strong>Payment Status:</strong> 
                                        <span class="badge 
                                            @if($order->payment_status === 'verified') bg-success
                                            @elseif($order->payment_status === 'rejected') bg-danger
                                            @else bg-warning text-dark
                                            @endif">
                                            {{ ucfirst($order->payment_status) }}
                                        </span>
                                    </p>
                                    <p class="mb-2">
                                        <strong>Pickup Status:</strong> 
                                        <span class="badge 
                                            @if($order->pickup_status === 'picked_up') bg-success
                                            @elseif($order->pickup_status === 'ready') bg-info
                                            @else bg-secondary
                                            @endif">
                                            {{ ucfirst(str_replace('_', ' ', $order->pickup_status)) }}
                                        </span>
                                    </p>
                                    @if($order->verified_at)
                                        <p class="mb-0"><strong>Verified At:</strong> {{ $order->verified_at->format('d M Y, H:i') }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card bg-dark bg-opacity-75 border-warning">
                                <div class="card-body">
                                    <h5 class="card-title">Payment Proof</h5>
                                    @if($order->payment_proof)
                                        <img src="{{ $order->payment_proof }}" alt="Payment Proof" class="img-fluid rounded mb-2">
                                    @else
                                        <p class="text-muted mb-0">No payment proof uploaded.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card bg-dark bg-opacity-75 border-warning">
                        <div class="card-body">
                            <h5 class="card-title mb-3">Order Items</h5>
                            <div class="table-responsive">
                                <table class="table table-dark">
                                    <thead>
                                        <tr>
                                            <th>Item</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($order->items as $item)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <img src="{{ $item->merchandise->image_path }}" 
                                                            alt="{{ $item->merchandise->name }}" 
                                                            class="img-thumbnail me-3" style="width: 60px; height: 60px; object-fit: cover;">
                                                        <div>
                                                            <strong>{{ $item->merchandise->name }}</strong>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{{ $item->quantity }}</td>
                                                <td>Rp {{ number_format($item->price_at_purchase, 0, ',', '.') }}</td>
                                                <td>Rp {{ number_format($item->quantity * $item->price_at_purchase, 0, ',', '.') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="3" class="text-end">Grand Total:</th>
                                            <th>Rp {{ number_format($order->grand_total, 0, ',', '.') }}</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
body {
    background: #2A0A56 !important;
}

.page-bg-image {
    background-image: url('{{ asset("images/bg1.jpg") }}');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: fixed;
    position: relative;
}

.page-bg-image::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(to top, 
        rgba(255, 236, 119, 0.85) 0%, 
        rgba(255, 217, 107, 0.85) 15%,
        rgba(255, 192, 95, 0.85) 25%,
        rgba(232, 160, 85, 0.85) 35%,
        rgba(199, 130, 78, 0.85) 45%,
        rgba(143, 72, 152, 0.85) 60%,
        rgba(106, 53, 116, 0.85) 75%,
        rgba(71, 35, 96, 0.85) 85%,
        rgba(42, 10, 86, 0.9) 100%);
    z-index: 0;
}

.page-bg-image > * {
    position: relative;
    z-index: 1;
}

.backdrop-blur {
    backdrop-filter: blur(10px);
}
</style>
@endsection

