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

                        @if (session('success'))
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
                                        <p class="mb-2"><strong>Order Date:</strong>
                                            {{ $order->created_at->format('d M Y, H:i') }}</p>
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
                                            <p class="mb-0"><strong>Verified At:</strong>
                                                {{ $order->verified_at->format('d M Y, H:i') }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card bg-dark bg-opacity-75 border-warning">
                                    <div class="card-body">
                                        <h5 class="card-title">Payment Proof</h5>
                                        @if ($order->payment_proof)
                                            <img src="{{ $order->payment_proof }}" alt="Payment Proof"
                                                class="img-fluid rounded mb-2">
                                        @else
                                            <p class="text-white mb-0">No payment proof uploaded.</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card bg-dark bg-opacity-75 border-warning">
                            <div class="card-body">
                                @include('orders.partials.items-table', ['order' => $order, 'tableClass' => 'table table-dark'])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <link rel="stylesheet" href="{{ asset('css/pages/order-show.css') }}">
@endsection
