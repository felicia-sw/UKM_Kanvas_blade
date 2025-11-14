@extends('layouts.app')

@section('title', 'Merchandise')

@section('content')
<div class="container merchandise-page" style="padding-top: 100px; padding-bottom: 50px; position: relative; overflow: hidden;">

    {{-- <img src="{{ asset('images/mascot2.png') }}" alt="Mascot" class="merch-decor mascot-decor"> --}}
    {{-- <img src="{{ asset('images/cloud1.png') }}" alt="Cloud" class="merch-decor cloud-decor-1"> --}}
    {{-- <img src="{{ asset('images/cloud3.png') }}" alt="Cloud" class="merch-decor cloud-decor-2"> --}}
    {{-- <img src="{{ asset('images/cloud5.png') }}" alt="Cloud" class="merch-decor cloud-decor-3"> --}}


    <div class="row text-center mb-4">
        <div class="col">
            <h1 class="merch-title">OUR MERCHANDISE</h1>
            <p class="merch-subtitle">Get your hands on our exclusive Kanvas goodies!</p>
        </div>
    </div>

    <div class="row">
        @forelse ($merchandiseItems as $item)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="merch-card">
                    <div class="merch-card-image-container">
                        <img src="{{ $item->image_path }}" class="merch-card-image" alt="{{ $item->name }}">
                    </div>
                    <div class="merch-card-body">
                        <h5 class="merch-card-title">{{ $item->name }}</h5>
                        <p class="merch-card-price">IDR {{ number_format($item->price, 0, ',', '.') }}</p>
                        @if($item->description)
                            <p class="merch-card-description">{{ $item->description }}</p>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="col text-center" style="min-height: 300px;">
                <h3 class="text-muted mt-5">No merchandise available right now.</h3>
                <p class="text-muted">Please check back soon!</p>
            </div>
        @endforelse
    </div>

</div>

{{-- 
Note: For the styles to apply, make sure the CSS from the previous step 
is at the end of your public/css/app.css file.
--}}
@endsection