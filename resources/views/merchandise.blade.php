@extends('layouts.app')

@section('title', 'Merchandise')

@section('content')
    <div class="merchandise-page-wrapper">
        <div class="container-fluid px-4" style="padding-top: 120px; padding-bottom: 80px;">

            <!-- Page Header -->
            <div class="row justify-content-center text-center mb-5" data-aos="fade-down">
                <div class="col-12">
                    <h1 class="merch-page-title display-1 fw-bold text-uppercase mb-3">OUR MERCHANDISE</h1>
                    <p class="merch-page-subtitle fs-5 text-white-50">Get your hands on our exclusive Kanvas goodies!</p>
                </div>
            </div>

            <!-- Merchandise Grid -->
            <div class="container">
                <div class="row g-4">
                    @forelse ($merchandises as $index => $item)
                        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ ($index % 3) * 100 }}">
                            <div class="merch-card h-100">
                                <div class="merch-card-image-container">
                                    <img src="{{ $item->image_path }}" class="merch-card-image" alt="{{ $item->name }}">
                                    <div class="merch-image-overlay"></div>
                                </div>
                                <div class="merch-card-body">
                                    <h5 class="merch-card-title">{{ $item->name }}</h5>
                                    <p class="merch-card-price mb-3">IDR {{ number_format($item->price, 0, ',', '.') }}</p>
                                    @if ($item->description)
                                        <p class="merch-card-description mb-3">{{ $item->description }}</p>
                                    @endif

                                    <div class="mt-auto">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <div class="stock-badge">
                                                <i class="bi bi-box-seam me-1"></i>
                                                <span class="fw-semibold">{{ $item->stock }} in stock</span>
                                            </div>
                                            @if ($item->stock > 0)
                                                <span class="badge bg-success">Available</span>
                                            @else
                                                <span class="badge bg-danger">Sold Out</span>
                                            @endif
                                        </div>

                                        @auth
                                            @if ($item->stock > 0)
                                                <form action="{{ route('cart.add', $item->id) }}" method="POST" class="w-100">
                                                    @csrf
                                                    <input type="hidden" name="quantity" value="1">
                                                    <button type="submit" class="btn btn-warning w-100 fw-bold">
                                                        <i class="bi bi-cart-plus me-2"></i>Add to Cart
                                                    </button>
                                                </form>
                                            @else
                                                <button class="btn btn-secondary w-100 fw-bold" disabled>
                                                    <i class="bi bi-x-circle me-2"></i>Out of Stock
                                                </button>
                                            @endif
                                        @else
                                            <a href="{{ route('login.form') }}" class="btn btn-warning w-100 fw-bold">
                                                <i class="bi bi-box-arrow-in-right me-2"></i>Login to Buy
                                            </a>
                                        @endauth
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center py-5" data-aos="fade-up">
                            <div class="empty-state">
                                <i class="bi bi-bag-x display-1 text-white-50 mb-4 d-block"></i>
                                <h3 class="text-white mb-3">No merchandise available right now.</h3>
                                <p class="text-white-50 mb-4">Check back later for awesome Kanvas merchandise!</p>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Merchandise Page Specific Styles */
        .merchandise-page-wrapper {
            min-height: 100vh;
            background: linear-gradient(135deg, #1a0033 0%, #2a0a56 50%, #1a0033 100%);
            position: relative;
            overflow: hidden;
        }

        .merchandise-page-wrapper::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image:
                radial-gradient(circle at 20% 50%, rgba(255, 236, 119, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(248, 184, 3, 0.1) 0%, transparent 50%);
            pointer-events: none;
        }

        .merch-page-title {
            color: #FFEC77;
            text-shadow: 0 0 30px rgba(255, 236, 119, 0.5);
            letter-spacing: 3px;
        }

        .merch-page-subtitle {
            font-size: 1.2rem;
        }

        .merch-card {
            background: rgba(42, 10, 86, 0.7);
            backdrop-filter: blur(15px);
            border-radius: 1.5rem;
            border: 2px solid rgba(255, 236, 119, 0.3);
            overflow: hidden;
            transition: all 0.4s ease;
            display: flex;
            flex-direction: column;
            position: relative;
        }

        .merch-card:hover {
            transform: translateY(-10px);
            border-color: rgba(255, 236, 119, 0.8);
            box-shadow: 0 20px 40px rgba(255, 236, 119, 0.2);
        }

        .merch-card-image-container {
            position: relative;
            height: 280px;
            overflow: hidden;
            background: linear-gradient(135deg, rgba(42, 10, 86, 0.5), rgba(74, 0, 224, 0.3));
        }

        .merch-card-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .merch-card:hover .merch-card-image {
            transform: scale(1.1);
        }

        .merch-image-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to top, rgba(42, 10, 86, 0.8) 0%, transparent 50%);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .merch-card:hover .merch-image-overlay {
            opacity: 1;
        }

        .merch-card-body {
            padding: 1.5rem;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .merch-card-title {
            color: #ffffff;
            font-size: 1.4rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            text-align: center;
        }

        .merch-card-price {
            color: #FFEC77;
            font-size: 1.5rem;
            font-weight: 700;
            text-align: center;
            text-shadow: 0 0 10px rgba(255, 236, 119, 0.3);
        }

        .merch-card-description {
            color: rgba(255, 255, 255, 0.85);
            font-size: 0.95rem;
            line-height: 1.6;
            text-align: center;
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
        }

        .stock-badge {
            color: rgba(255, 255, 255, 0.9);
            font-size: 0.9rem;
            display: flex;
            align-items: center;
        }

        .empty-state {
            padding: 4rem 2rem;
            background: rgba(42, 10, 86, 0.5);
            backdrop-filter: blur(10px);
            border-radius: 2rem;
            border: 2px solid rgba(255, 236, 119, 0.2);
        }

        @media (max-width: 768px) {
            .merch-page-title {
                font-size: 2.5rem;
            }

            .merch-card-image-container {
                height: 220px;
            }
        }
    </style>
@endsection
