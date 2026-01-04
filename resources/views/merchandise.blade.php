@extends('layouts.app')

@section('title', 'Merchandise')

@section('content')
    <div class="container merchandise-page"
        style="padding-top: 100px; padding-bottom: 50px; position: relative; overflow: hidden;">

        {{-- <img src="{{ asset('images/mascot2.png') }}" alt="Mascot" class="merch-decor mascot-decor"> --}}
        {{-- <img src="{{ asset('images/cloud1.png') }}" alt="Cloud" class="merch-decor cloud-decor-1"> --}}
        {{-- <img src="{{ asset('images/cloud3.png') }}" alt="Cloud" class="merch-decor cloud-decor-2"> --}}
        {{-- <img src="{{ asset('images/cloud5.png') }}" alt="Cloud" class="merch-decor cloud-decor-3"> --}}


        <div class="row text-center mb-4">
            <div class="col">
                <h1 class="text-white-50">OUR MERCHANDISE</h1>
                <p class="text-white-50">Get your hands on our exclusive Kanvas goodies!</p>
            </div>
        </div>

        <div class="row">
            @forelse ($merchandises as $item)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="merch-card">
                        <div class="merch-card-image-container">
                            <img src="{{ $item->image_path }}" class="merch-card-image" alt="{{ $item->name }}">
                        </div>
                        <div class="merch-card-body">
                            <h5 class="merch-card-title">{{ $item->name }}</h5>
                            <p class="merch-card-price">IDR {{ number_format($item->price, 0, ',', '.') }}</p>
                            @if ($item->description)
                                <p class="merch-card-description">{{ $item->description }}</p>
                            @endif
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <small class="text-secondary fw-semibold">
                                    Stock: {{ $item->stock }}
                                </small>
                                @auth
                                    @if ($item->stock > 0)
                                        <form action="{{ route('cart.add', $item->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <input type="hidden" name="quantity" value="1">
                                            <button type="submit" class="btn btn-sm btn-warning">
                                                <i class="bi bi-cart-plus me-1"></i>Add to Cart
                                            </button>
                                        </form>
                                    @else
                                        <span class="badge bg-danger">Out of Stock</span>
                                    @endif
                                @else
                                    <a href="{{ route('login.form') }}" class="btn btn-sm btn-outline-warning">
                                        <i class="bi bi-box-arrow-in-right me-1"></i>Login to Buy
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col text-center" style="min-height: 300px;">
                    <h3 class="text-white pt-5  mt-5">No merchandise available right now.</h3>
                    <p class="text-white-50">Please check back soon!</p>
                </div>
            @endforelse
        </div>

    </div>
@endsection
