@extends('layouts.app')

@section('title', $artwork->title . ' - UKM Kanvas')

@section('content')
<div class="page-bg-image text-white min-vh-100 py-5">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="d-flex justify-content-between align-items-center mb-4 mt-5 pt-4">
                    <a href="{{ route('art_gallery') }}" class="btn btn-outline-light">
                        <i class="bi bi-arrow-left me-2"></i>Back to Gallery
                    </a>
                </div>

                <div class="bg-dark bg-opacity-50 rounded-4 p-4 p-md-5 backdrop-blur">
                    <div class="row g-4 align-items-center">
                        <div class="col-lg-7">
                            <div class="modal-image-box rounded-4 overflow-hidden">
                                <img src="{{ $artwork->image_path }}"
                                     alt="{{ $artwork->title }}"
                                     class="img-fluid w-100">
                            </div>
                        </div>

                        <div class="col-lg-5">
                            <h1 class="fw-bold mb-4">{{ $artwork->title }}</h1>

                            <div class="detail-item mb-3">
                                <div class="d-flex align-items-center gap-2 mb-2">
                                    <i class="bi bi-person-circle text-warning fs-5"></i>
                                    <span class="text-warning fw-semibold">Artist</span>
                                </div>
                                <p class="text-white mb-0 ps-4">{{ $artwork->artist_name }}</p>
                            </div>

                            <div class="detail-item mb-3">
                                <div class="d-flex align-items-center gap-2 mb-2">
                                    <i class="bi bi-tag-fill text-warning fs-5"></i>
                                    <span class="text-warning fw-semibold">Category</span>
                                </div>
                                <p class="mb-0 ps-4">
                                    <span class="badge bg-warning text-dark">{{ $artwork->category->name ?? 'Uncategorized' }}</span>
                                </p>
                            </div>

                            @if($artwork->created_date)
                            <div class="detail-item mb-3">
                                <div class="d-flex align-items-center gap-2 mb-2">
                                    <i class="bi bi-calendar-fill text-warning fs-5"></i>
                                    <span class="text-warning fw-semibold">Created Date</span>
                                </div>
                                <p class="text-white mb-0 ps-4">{{ $artwork->created_date->format('F d, Y') }}</p>
                            </div>
                            @endif

                            @if($artwork->description)
                            <div class="detail-item">
                                <div class="d-flex align-items-center gap-2 mb-2">
                                    <i class="bi bi-journal-text-fill text-warning fs-5"></i>
                                    <span class="text-warning fw-semibold">Description</span>
                                </div>
                                <p class="text-white-50 mb-0 ps-4 lh-lg">{{ $artwork->description }}</p>
                            </div>
                            @endif
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

.modal-image-box {
    background: rgba(0, 0, 0, 0.3);
    border: 3px solid rgba(255, 236, 119, 0.4);
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.4);
}

.detail-item {
    padding: 1rem;
    background: rgba(255, 255, 255, 0.05);
    border-radius: 0.75rem;
    border-left: 3px solid rgba(255, 236, 119, 0.5);
}
</style>
@endsection
