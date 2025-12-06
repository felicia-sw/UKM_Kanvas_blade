@extends('layouts.app')

@section('title', 'Shopping Cart')

@section('content')
<div class="page-bg-image text-white min-vh-100 py-5">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="bg-dark bg-opacity-50 rounded-4 p-4 p-md-5 backdrop-blur">
                    <h1 class="display-5 fw-bold mb-4"><i class="bi bi-cart me-2"></i>Shopping Cart</h1>
                    
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if($cartItems->count() > 0)
                        <div class="table-responsive mb-4">
                            <table class="table table-dark table-hover">
                                <thead>
                                    <tr>
                                        <th>Item</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Subtotal</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($cartItems as $item)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="{{ Storage::url($item->merchandise->image_path) }}" 
                                                        alt="{{ $item->merchandise->name }}" 
                                                        class="img-thumbnail me-3" style="width: 80px; height: 80px; object-fit: cover;">
                                                    <div>
                                                        <strong>{{ $item->merchandise->name }}</strong>
                                                        @if($item->merchandise->stock < $item->quantity)
                                                            <br><small class="text-danger">Only {{ $item->merchandise->stock }} available</small>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td>Rp {{ number_format($item->merchandise->price, 0, ',', '.') }}</td>
                                            <td>
                                                <form action="{{ route('cart.update', $item->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="number" name="quantity" value="{{ $item->quantity }}" 
                                                        min="1" max="{{ $item->merchandise->stock }}" 
                                                        class="form-control form-control-sm d-inline-block" style="width: 80px;" 
                                                        onchange="this.form.submit()">
                                                </form>
                                            </td>
                                            <td>Rp {{ number_format($item->quantity * $item->merchandise->price, 0, ',', '.') }}</td>
                                            <td>
                                                <form action="{{ route('cart.remove', $item->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Remove from cart?')">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <form action="{{ route('cart.clear') }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('POST')
                                    <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Clear entire cart?')">
                                        <i class="bi bi-trash me-2"></i>Clear Cart
                                    </button>
                                </form>
                            </div>
                            <div class="col-md-6 text-end">
                                <div class="card bg-dark bg-opacity-75 border-warning d-inline-block p-3">
                                    <h5 class="mb-0">Total: <strong>Rp {{ number_format($total, 0, ',', '.') }}</strong></h5>
                                    <form action="{{ route('orders.store') }}" method="POST" enctype="multipart/form-data" class="mt-3">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="payment_proof" class="form-label text-white">Payment Proof <span class="text-danger">*</span></label>
                                            <input type="file" name="payment_proof" id="payment_proof" accept="image/*" required class="form-control">
                                        </div>
                                        <button type="submit" class="btn btn-warning w-100">
                                            <i class="bi bi-check-circle me-2"></i>Place Order
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="bi bi-cart-x display-1 text-white-50"></i>
                            <p class="text-white-50 mt-3">Your cart is empty.</p>
                            <a href="{{ route('merchandise') }}" class="btn btn-warning">
                                <i class="bi bi-arrow-left me-2"></i>Continue Shopping
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

.form-control {
    background-color: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
    color: white;
}

.form-control:focus {
    background-color: rgba(255, 255, 255, 0.15);
    border-color: #FFEC77;
    color: white;
    box-shadow: 0 0 0 0.2rem rgba(255, 236, 119, 0.25);
}
</style>
@endsection

