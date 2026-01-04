@extends('admin.layouts.admin')

@section('title', 'Order #' . $order->id)

@section('content')
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.orders.index') }}">Orders</a></li>
            <li class="breadcrumb-item active">Order #{{ $order->id }}</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h2 mb-0">Order #{{ $order->id }}</h1>
            <p class="text-muted mb-0">Customer: {{ $order->user->name }} ({{ $order->user->email }})</p>
        </div>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-admin-outline-secondary">
            <i class="bi bi-arrow-left me-2"></i>Back
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row mb-4">
        <div class="col-md-6">
            <div class="admin-card">
                <div class="card-body">
                    <h5 class="card-title">Order Information</h5>
                    <p class="mb-2"><strong>Order Date:</strong> {{ $order->created_at->format('d M Y, H:i') }}</p>
                    <p class="mb-2">
                        <strong>Payment Status:</strong>
                        <span
                            class="badge 
                            @if ($order->payment_status === 'verified') bg-success
                            @elseif($order->payment_status === 'rejected') bg-danger
                            @else bg-warning text-dark @endif">
                            {{ ucfirst($order->payment_status) }}
                        </span>
                    </p>
                    <p class="mb-2">
                        <strong>Pickup Status:</strong>
                        <span
                            class="badge 
                            @if ($order->pickup_status === 'picked_up') bg-success
                            @elseif($order->pickup_status === 'ready') bg-info
                            @else bg-secondary @endif">
                            {{ ucfirst(str_replace('_', ' ', $order->pickup_status)) }}
                        </span>
                    </p>
                    @if ($order->verified_at)
                        <p class="mb-0"><strong>Verified At:</strong> {{ $order->verified_at->format('d M Y, H:i') }}</p>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="admin-card">
                <div class="card-body">
                    <h5 class="card-title">Payment Proof</h5>
                    @if ($order->payment_proof)
                        <img src="{{ $order->payment_proof }}" alt="Payment Proof" class="img-fluid rounded mb-3">
                    @else
                        <p class="text-muted mb-0">No payment proof uploaded.</p>
                    @endif

                    @if ($order->payment_status === 'pending')
                        <div class="d-flex gap-2 mt-3">
                            <form action="{{ route('admin.orders.verify-payment', $order->id) }}" method="POST"
                                class="d-inline">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="payment_status" value="verified">
                                <button type="submit" class="btn btn-success">
                                    <i class="bi bi-check-circle me-1"></i>Verify Payment
                                </button>
                            </form>
                            <form action="{{ route('admin.orders.verify-payment', $order->id) }}" method="POST"
                                class="d-inline">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="payment_status" value="rejected">
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Reject this payment?')">
                                    <i class="bi bi-x-circle me-1"></i>Reject Payment
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="admin-card mb-4">
        <div class="card-body">
            <h5 class="card-title mb-3">Order Items ({{ $order->items->count() }} items)</h5>
            @if ($order->items->count() > 0)
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->items as $item)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            @if ($item->merchandise)
                                                <img src="{{ $item->merchandise->image_path }}"
                                                    alt="{{ $item->merchandise->name }}" class="img-thumbnail me-3"
                                                    style="width: 60px; height: 60px; object-fit: cover;">
                                                <div>
                                                    <strong>{{ $item->merchandise->name }}</strong>
                                                </div>
                                            @else
                                                <div>
                                                    <strong class="text-muted">Product Deleted</strong>
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>Rp {{ number_format($item->price_at_purchase, 0, ',', '.') }}</td>
                                    <td>Rp {{ number_format($item->quantity * $item->price_at_purchase, 0, ',', '.') }}
                                    </td>
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
            @else
              
                <div class="table-responsive">
                    <table class="table">
                        <tfoot>
                            <tr>
                                <th class="text-end">Grand Total:</th>
                                <th>Rp {{ number_format($order->grand_total, 0, ',', '.') }}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            @endif
        </div>
    </div>

    @if ($order->payment_status === 'verified')
        <div class="admin-card">
            <div class="card-body">
                <h5 class="card-title mb-3">Update Pickup Status</h5>
                <form action="{{ route('admin.orders.update-pickup-status', $order->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="row">
                        <div class="col-md-6">
                            <select name="pickup_status" class="form-select" required>
                                <option value="pending" {{ $order->pickup_status === 'pending' ? 'selected' : '' }}>Pending
                                </option>
                                <option value="ready" {{ $order->pickup_status === 'ready' ? 'selected' : '' }}>Ready for
                                    Pickup</option>
                                <option value="picked_up" {{ $order->pickup_status === 'picked_up' ? 'selected' : '' }}>
                                    Picked Up</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-admin-primary">
                                <i class="bi bi-save me-2"></i>Update Status
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endif
@endsection
