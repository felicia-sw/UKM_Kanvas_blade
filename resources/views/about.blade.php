@extends('layouts.app')

@section('title', 'About Us')

@section('content')
<div class="about-page">
    <!-- Page Header -->
    <div class="page-header py-5 mb-5">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center" data-aos="fade-down">
                    <h1 class="text-white fw-bold display-3 mb-3">ABOUT US</h1>
                    <p class="text-white-50 fs-5">Mengenal lebih dekat UKM Kanvas</p>
                </div>
            </div>
        </div>
    </div>

    <!-- About Content -->
    <div class="container py-5">
        <!-- Introduction -->
        <div class="row mb-5 align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0" data-aos="fade-right">
                <div class="about-image-container">
                    <img src="{{ asset('images/about/team.jpg') }}" 
                         alt="Kanvas Team" 
                         class="img-fluid rounded-4 shadow-lg">
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <h2 class="text-white fw-bold mb-4">Apa itu UKM Kanvas?</h2>
                <p class="text-white-50 fs-5 lh-lg mb-4">
                    UKM Kanvas adalah Unit Kegiatan Mahasiswa yang berfokus pada pengembangan 
                    kreativitas seni dan desain. Kami menyediakan wadah bagi mahasiswa untuk 
                    mengekspresikan diri melalui berbagai medium seni seperti lukisan, digital art, 
                    fotografi, dan banyak lagi.
                </p>
                <p class="text-white-50 fs-5 lh-lg">
                    Sejak didirikan, Kanvas telah menjadi rumah bagi ratusan seniman muda yang 
                    berbakat dan terus berkembang menjadi komunitas kreatif terbesar di kampus.
                </p>
            </div>
        </div>

        <!-- Vision & Mission -->
        <div class="row g-4 mb-5">
            <div class="col-lg-6" data-aos="fade-up">
                <div class="glass-card p-5 h-100">
                    <div class="icon-box mb-4">
                        <i class="bi bi-eye fs-1 text-warning"></i>
                    </div>
                    <h3 class="text-white fw-bold mb-3">Visi Kami</h3>
                    <p class="text-white-50 fs-5 lh-lg">
                        Menjadi wadah utama pengembangan bakat seni mahasiswa dan menghasilkan 
                        karya-karya berkualitas yang dapat menginspirasi dan memberikan dampak 
                        positif bagi masyarakat.
                    </p>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                <div class="glass-card p-5 h-100">
                    <div class="icon-box mb-4">
                        <i class="bi bi-bullseye fs-1 text-warning"></i>
                    </div>
                    <h3 class="text-white fw-bold mb-3">Misi Kami</h3>
                    <ul class="text-white-50 fs-5 lh-lg">
                        <li class="mb-2">Mengembangkan kreativitas dan bakat seni mahasiswa</li>
                        <li class="mb-2">Menyelenggarakan workshop dan pelatihan berkualitas</li>
                        <li class="mb-2">Memfasilitasi pameran dan kompetisi seni</li>
                        <li>Membangun komunitas seniman yang solid dan supportif</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Values -->
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="text-white fw-bold mb-4">Nilai-Nilai Kami</h2>
            <p class="text-white-50 fs-5">Prinsip yang menjadi fondasi UKM Kanvas</p>
        </div>

        <div class="row g-4 mb-5">
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="value-card glass-card p-4 text-center h-100">
                    <div class="value-icon mb-3">
                        <i class="bi bi-lightbulb fs-1 text-warning"></i>
                    </div>
                    <h4 class="text-white fw-bold mb-3">Kreativitas</h4>
                    <p class="text-white-50">
                        Mendorong inovasi dan pemikiran out-of-the-box dalam setiap karya
                    </p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="value-card glass-card p-4 text-center h-100">
                    <div class="value-icon mb-3">
                        <i class="bi bi-people fs-1 text-warning"></i>
                    </div>
                    <h4 class="text-white fw-bold mb-3">Kolaborasi</h4>
                    <p class="text-white-50">
                        Membangun kerjasama yang kuat antar anggota untuk hasil maksimal
                    </p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="value-card glass-card p-4 text-center h-100">
                    <div class="value-icon mb-3">
                        <i class="bi bi-award fs-1 text-warning"></i>
                    </div>
                    <h4 class="text-white fw-bold mb-3">Excellence</h4>
                    <p class="text-white-50">
                        Selalu berusaha memberikan yang terbaik dalam setiap karya dan kegiatan
                    </p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
                <div class="value-card glass-card p-4 text-center h-100">
                    <div class="value-icon mb-3">
                        <i class="bi bi-heart fs-1 text-warning"></i>
                    </div>
                    <h4 class="text-white fw-bold mb-3">Passion</h4>
                    <p class="text-white-50">
                        Menjalankan setiap aktivitas dengan cinta dan dedikasi penuh
                    </p>
                </div>
            </div>
        </div>

        <!-- Statistics -->
        <div class="stats-section glass-card p-5 mb-5" data-aos="fade-up">
            <div class="row text-center g-4">
                <div class="col-lg-3 col-6">
                    <div class="stat-item">
                        <h2 class="text-warning fw-bold display-4 mb-2">150+</h2>
                        <p class="text-white-50 fs-5">Anggota Aktif</p>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="stat-item">
                        <h2 class="text-warning fw-bold display-4 mb-2">50+</h2>
                        <p class="text-white-50 fs-5">Event Tahunan</p>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="stat-item">
                        <h2 class="text-warning fw-bold display-4 mb-2">100+</h2>
                        <p class="text-white-50 fs-5">Karya Dipamerkan</p>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="stat-item">
                        <h2 class="text-warning fw-bold display-4 mb-2">5+</h2>
                        <p class="text-white-50 fs-5">Tahun Berpengalaman</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- CTA Section -->
        <div class="text-center" data-aos="fade-up">
            <h2 class="text-white fw-bold mb-4">Siap Bergabung dengan Kami?</h2>
            <p class="text-white-50 fs-5 mb-4">
                Jangan lewatkan kesempatan untuk mengembangkan bakat senimu bersama komunitas terbaik!
            </p>
            <div class="d-flex gap-3 justify-content-center flex-wrap">
                <a href="{{ route('event') }}" class="btn btn-gradient btn-lg px-4 py-3">
                    <i class="bi bi-calendar-event me-2"></i>Lihat Event
                </a>
                <a href="{{ route('contact') }}" class="btn btn-outline-light btn-lg px-4 py-3">
                    <i class="bi bi-envelope me-2"></i>Hubungi Kami
                </a>
            </div>
        </div>
    </div>
</div>

<style>
.about-page {
    min-height: 100vh;
}

.about-image-container img {
    transition: transform 0.3s ease;
}

.about-image-container:hover img {
    transform: scale(1.05);
}

.value-card {
    transition: all 0.3s ease;
}

.value-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
}

.value-icon {
    width: 80px;
    height: 80px;
    margin: 0 auto;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(255, 236, 119, 0.1);
    border-radius: 50%;
    transition: all 0.3s ease;
}

.value-card:hover .value-icon {
    background: rgba(255, 236, 119, 0.2);
    transform: scale(1.1);
}

.stat-item {
    transition: transform 0.3s ease;
}

.stat-item:hover {
    transform: scale(1.1);
}

.stats-section {
    border: 2px solid rgba(255, 236, 119, 0.3);
}
</style>
@endsection