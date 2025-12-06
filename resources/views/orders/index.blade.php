@extends('layouts.app')

@section('title', 'My Orders')

@section('content')
<div class="page-bg-image text-white min-vh-100 py-5">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="bg-dark bg-opacity-50 rounded-4 p-4 p-md-5 backdrop-blur">
                    <h1 class="display-5 fw-bold mb-4"><i class="bi bi-receipt me-2"></i>My Orders</h1>
                    
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if($orders->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-dark table-hover">
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Items</th>
                                        <th>Total</th>
                                        <th>Payment Status</th>
                                        <th>Pickup Status</th>
                                        <th>Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $order)
                                        <tr>
                                            <td>#{{ $order->id }}</td>
                                            <td>{{ $order->items->count() }} item(s)</td>
                                            <td>Rp {{ number_format($order->grand_total, 0, ',', '.') }}</td>
                                            <td>
                                                <span class="badge 
                                                    @if($order->payment_status === 'verified') bg-success
                                                    @elseif($order->payment_status === 'rejected') bg-danger
                                                    @else bg-warning text-dark
                                                    @endif">
                                                    {{ ucfirst($order->payment_status) }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge 
                                                    @if($order->pickup_status === 'picked_up') bg-success
                                                    @elseif($order->pickup_status === 'ready') bg-info
                                                    @else bg-secondary
                                                    @endif">
                                                    {{ ucfirst(str_replace('_', ' ', $order->pickup_status)) }}
                                                </span>
                                            </td>
                                            <td>{{ $order->created_at->format('d M Y') }}</td>
                                            <td>
                                                <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-outline-light">
                                                    <i class="bi bi-eye"></i> View
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $orders->links() }}
                    @else
                        <div class="text-center py-5">
                            <i class="bi bi-receipt display-1 text-white-50"></i>
                            <p class="text-white-50 mt-3">You haven't placed any orders yet.</p>
                            <a href="{{ route('merchandise') }}" class="btn btn-warning">
                                <i class="bi bi-arrow-left me-2"></i>Browse Merchandise
                            </a>
                        </div>
                    @endif
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

