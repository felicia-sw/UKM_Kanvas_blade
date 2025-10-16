@extends('layouts.app')

@section('title', 'Home - UKM Kanvas')

@section('content')
    <div class="container-fluid px-5 pe-0 min-vh-100 d-flex align-items-center">
        <div class="center-me ps-2 pe-0" style="width: 100%;">
            <div class="row align-items-center" style="margin-right: 0;">
                <!-- Left Content Section -->
                <div class="col-xl-7 col-12" data-aos="fade-right" data-aos-duration="1000">
                    <h1 class="text-start text-white fw-bold hero-title mb-4">
                        WELCOME<br>PEEPS
                    </h1>

                    <!-- Description Section -->
                    <div class="text-white border-start border-4 border-white ps-3 mt-4 mb-4">
                        <h4 class="text-start mb-0">Apa itu Kanvas?</h4>
                    </div>

                    <div class="description-text mb-4">
                        <p class="text-white fs-5 lh-lg">
                            Kanvas adalah Unit Kegiatan Mahasiswa yang berfokus pada pengembangan
                            kreativitas seni dan desain. Kami adalah rumah bagi para seniman muda
                            yang ingin mengekspresikan diri melalui berbagai medium seni.
                        </p>
                    </div>

                    <!-- Slogan Section -->
                    <div class="mt-5 pt-3">
                        <h2 class="text-white text-start fw-bold slogan-text">
                            "Ekspresikan. Ciptakan. Inspirasi."
                        </h2>
                    </div>

                    <!-- CTA Buttons -->
                    <div class="mt-5 d-flex gap-3 flex-wrap">
                        <a href="{{ route('event') }}" class="btn btn-gradient btn-lg px-4 py-3">
                            <i class="bi bi-calendar-event me-2"></i>Lihat Event
                        </a>
                        <a href="{{ route('art_gallery') }}" class="btn btn-outline-light btn-lg px-4 py-3">
                            <i class="bi bi-palette me-2"></i>Galeri Karya
                        </a>
                    </div>
                </div>

                <!-- Right Image Section -->
                <div class="col-xl-5 col-12 d-flex justify-content-end align-items-center mascot-container"
                    style="padding-right: 0;" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="200">
                    <img src="{{ asset('images/mascot.png') }}?v=2" alt="Kanvas Mascot" class="mascot-image"
                        style="width: 100%; height: auto; margin-right: -50px">
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <section id="features" class="features-section py-5 mt-5 section-light">
        <div class="container">
            <div class="row text-center mb-5">
                <div class="col-12">
                    <h2 class="text-dark fw-bold mb-3" data-aos="fade-up">Kenapa Bergabung dengan Kanvas?</h2>
                    <p class="text-muted fs-5" data-aos="fade-up" data-aos-delay="100">
                        Temukan alasan mengapa Kanvas adalah tempat yang tepat untuk mengembangkan bakat senimu
                    </p>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="feature-card glass-card p-4 h-100 text-center">
                        <div class="feature-icon mb-3">
                            <i class="bi bi-brush fs-1 text-warning"></i>
                        </div>
                        <h4 class="text-dark mb-3">Workshop Rutin</h4>
                        <p class="text-muted">
                            Ikuti workshop rutin dari seniman profesional dan tingkatkan skill senimu
                        </p>
                    </div>
                </div>

                <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="feature-card glass-card p-4 h-100 text-center">
                        <div class="feature-icon mb-3">
                            <i class="bi bi-people fs-1 text-warning"></i>
                        </div>
                        <h4 class="text-dark mb-3">Komunitas Kreatif</h4>
                        <p class="text-muted">
                            Bergabung dengan komunitas seniman muda yang penuh passion dan inspirasi
                        </p>
                    </div>
                </div>

                <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="feature-card glass-card p-4 h-100 text-center">
                        <div class="feature-icon mb-3">
                            <i class="bi bi-trophy fs-1 text-warning"></i>
                        </div>
                        <h4 class="text-dark mb-3">Pameran & Kompetisi</h4>
                        <p class="text-muted">
                            Kesempatan untuk memamerkan karyamu dan ikut kompetisi tingkat nasional
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Values Section -->
    <section class="py-5">
        <div class="container">
            <div class="row text-center mb-5">
                <div class="col-12">
                    <h2 class="text-white fw-bold mb-3" data-aos="fade-up">Our Values</h2>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="50">
                    <div class="glass-card p-4 h-100 rounded-4">
                        <div class="d-inline-flex align-items-center justify-content-center rounded-4 mb-3"
                            style="width: 54px; height: 54px; background: linear-gradient(135deg, rgba(255,236,119,.35), rgba(255,117,15,.35));">
                            <i class="bi bi-palette2 text-white fs-4"></i>
                        </div>
                        <h5 class="text-white mb-2">Creativity First</h5>
                        <p class="text-white-50 mb-0">We celebrate and nurture creative expression across mediums and
                            styles.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="glass-card p-4 h-100 rounded-4">
                        <div class="d-inline-flex align-items-center justify-content-center rounded-4 mb-3"
                            style="width: 54px; height: 54px; background: linear-gradient(135deg, rgba(255,236,119,.35), rgba(255,117,15,.35));">
                            <i class="bi bi-people text-white fs-4"></i>
                        </div>
                        <h5 class="text-white mb-2">Inclusive Community</h5>
                        <p class="text-white-50 mb-0">Welcoming all skill levels, fostering a supportive environment to
                            grow.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="150">
                    <div class="glass-card p-4 h-100 rounded-4">
                        <div class="d-inline-flex align-items-center justify-content-center rounded-4 mb-3"
                            style="width: 54px; height: 54px; background: linear-gradient(135deg, rgba(255,236,119,.35), rgba(255,117,15,.35));">
                            <i class="bi bi-trophy text-white fs-4"></i>
                        </div>
                        <h5 class="text-white mb-2">Excellence</h5>
                        <p class="text-white-50 mb-0">We strive for high standards while embracing experimentation.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="glass-card p-4 h-100 rounded-4">
                        <div class="d-inline-flex align-items-center justify-content-center rounded-4 mb-3"
                            style="width: 54px; height: 54px; background: linear-gradient(135deg, rgba(255,236,119,.35), rgba(255,117,15,.35));">
                            <i class="bi bi-heart text-white fs-4"></i>
                        </div>
                        <h5 class="text-white mb-2">Passion for Art</h5>
                        <p class="text-white-50 mb-0">We share our enthusiasm through workshops, showcases, and
                            collaborations.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="250">
                    <div class="glass-card p-4 h-100 rounded-4">
                        <div class="d-inline-flex align-items-center justify-content-center rounded-4 mb-3"
                            style="width: 54px; height: 54px; background: linear-gradient(135deg, rgba(255,236,119,.35), rgba(255,117,15,.35));">
                            <i class="bi bi-lightbulb text-white fs-4"></i>
                        </div>
                        <h5 class="text-white mb-2">Innovation</h5>
                        <p class="text-white-50 mb-0">We explore new media and techniques to discover unique artistic
                            voices.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="glass-card p-4 h-100 rounded-4">
                        <div class="d-inline-flex align-items-center justify-content-center rounded-4 mb-3"
                            style="width: 54px; height: 54px; background: linear-gradient(135deg, rgba(255,236,119,.35), rgba(255,117,15,.35));">
                            <i class="bi bi-bullseye text-white fs-4"></i>
                        </div>
                        <h5 class="text-white mb-2">Goal‑Oriented</h5>
                        <p class="text-white-50 mb-0">We set clear goals for growth, events, and meaningful achievements.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Club Guidelines Section -->
    <section class="py-5">
        <div class="container">
            <div class="row text-center mb-5">
                <div class="col-12">
                    <h2 class="text-white fw-bold mb-3" data-aos="fade-up">Club Guidelines</h2>
                </div>
            </div>

            <div class="vstack gap-3">
                <div class="glass-card p-4 rounded-4" data-aos="fade-up" data-aos-delay="50">
                    <div class="d-flex align-items-start gap-3">
                        <div class="guideline-num">01</div>
                        <div>
                            <h5 class="text-white mb-1">Respect & Support</h5>
                            <p class="text-white-50 mb-0">Treat all members with respect and provide constructive feedback.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="glass-card p-4 rounded-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="d-flex align-items-start gap-3">
                        <div class="guideline-num">02</div>
                        <div>
                            <h5 class="text-white mb-1">Active Participation</h5>
                            <p class="text-white-50 mb-0">Aim to attend club activities and events regularly.</p>
                        </div>
                    </div>
                </div>
                <div class="glass-card p-4 rounded-4" data-aos="fade-up" data-aos-delay="150">
                    <div class="d-flex align-items-start gap-3">
                        <div class="guideline-num">03</div>
                        <div>
                            <h5 class="text-white mb-1">Original Work</h5>
                            <p class="text-white-50 mb-0">All submitted artworks must be original creations.</p>
                        </div>
                    </div>
                </div>
                <div class="glass-card p-4 rounded-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="d-flex align-items-start gap-3">
                        <div class="guideline-num">04</div>
                        <div>
                            <h5 class="text-white mb-1">Studio Care</h5>
                            <p class="text-white-50 mb-0">Keep the studio clean and return all materials after use.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Mission Section -->
    <section class="py-5">
        <div class="container">
            <div class="glass-card p-5 rounded-4" data-aos="zoom-in">
                <h2 class="text-center text-white fw-bold mb-3">Our Mission</h2>
                <p class="text-center text-white-50 mb-0 fs-5">To create an inclusive platform where students can explore,
                    develop, and showcase their artistic talents while fostering a supportive community that celebrates
                    creativity, innovation, and excellence.</p>
            </div>
        </div>
    </section>

    <!-- Upcoming Events Section -->
    <section id="events" class="py-5 section-light">
        <div class="container">
            <div class="row align-items-end mb-4">
                <div class="col">
                    <h2 class="text-dark fw-bold" data-aos="fade-up">Upcoming Events</h2>
                    <p class="text-muted mb-0" data-aos="fade-up" data-aos-delay="100">Ikuti kegiatan Kanvas terbaru dan
                        tingkatkan jaringan kreatifmu</p>
                </div>
                <div class="col-auto">
                    <a href="{{ route('event') }}" class="btn btn-outline-dark">Lihat Semua</a>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="card bg-transparent border-0 h-100 glass-card">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center mb-3">
                                <span class="badge bg-warning text-dark me-2">Workshop</span>
                                <small class="text-muted">Sab, 26 Okt</small>
                            </div>
                            <h5 class="card-title text-dark">Dasar Ilustrasi Digital</h5>
                            <p class="card-text text-muted">Belajar workflow ilustrasi dari sketsa hingga final render.
                            </p>
                            <a href="{{ route('event') }}" class="link-dark text-decoration-none">Detail event →</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="card bg-transparent border-0 h-100 glass-card">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center mb-3">
                                <span class="badge bg-warning text-dark me-2">Talkshow</span>
                                <small class="text-muted">Min, 3 Nov</small>
                            </div>
                            <h5 class="card-title text-dark">Career in Creative Industry</h5>
                            <p class="card-text text-muted">Ngobrol bareng praktisi industri desain dan ilustrasi.</p>
                            <a href="{{ route('event') }}" class="link-dark text-decoration-none">Detail event →</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="card bg-transparent border-0 h-100 glass-card">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center mb-3">
                                <span class="badge bg-warning text-dark me-2">Exhibition</span>
                                <small class="text-muted">Sab, 16 Nov</small>
                            </div>
                            <h5 class="card-title text-dark">Kanvas Art Showcase</h5>
                            <p class="card-text text-muted">Pameran karya anggota Kanvas terbaik bulan ini.</p>
                            <a href="{{ route('event') }}" class="link-dark text-decoration-none">Detail event →</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <!-- Gallery Preview Section -->
    <section id="gallery" class="py-5">
        <div class="container">
            <div class="d-flex align-items-end justify-content-between mb-4">
                <div>
                    <h2 class="text-white fw-bold" data-aos="fade-up">Galeri Karya</h2>
                    <p class="text-white-50 mb-0" data-aos="fade-up" data-aos-delay="100">Karya terbaru dari anggota
                        Kanvas</p>
                </div>
                <a href="{{ route('art_gallery') }}" class="btn btn-outline-light">Lihat Galeri</a>
            </div>

            <div class="row g-3">
                <div class="col-6 col-md-3" data-aos="zoom-in" data-aos-delay="50">
                    <div class="ratio ratio-1x1 rounded-4 overflow-hidden glass-card">
                        <img src="{{ asset('images/mascot.png') }}" alt="Karya 1" class="w-100 h-100 object-fit-cover">
                    </div>
                </div>
                <div class="col-6 col-md-3" data-aos="zoom-in" data-aos-delay="100">
                    <div class="ratio ratio-1x1 rounded-4 overflow-hidden glass-card">
                        <img src="{{ asset('images/mascot.png') }}" alt="Karya 2" class="w-100 h-100 object-fit-cover">
                    </div>
                </div>
                <div class="col-6 col-md-3" data-aos="zoom-in" data-aos-delay="150">
                    <div class="ratio ratio-1x1 rounded-4 overflow-hidden glass-card">
                        <img src="{{ asset('images/mascot.png') }}" alt="Karya 3" class="w-100 h-100 object-fit-cover">
                    </div>
                </div>
                <div class="col-6 col-md-3" data-aos="zoom-in" data-aos-delay="200">
                    <div class="ratio ratio-1x1 rounded-4 overflow-hidden glass-card">
                        <img src="{{ asset('images/mascot.png') }}" alt="Karya 4" class="w-100 h-100 object-fit-cover">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-5 section-light">
        <div class="container">
            <div class="row align-items-center g-4">
                <div class="col-lg-6" data-aos="fade-right">
                    <h2 class="text-dark fw-bold mb-3">Tentang Kanvas</h2>
                    <p class="text-muted fs-5 mb-4">Kanvas adalah komunitas kreatif di lingkungan kampus yang mendorong
                        eksplorasi seni visual, desain, dan media kreatif lainnya. Kami rutin mengadakan workshop, pameran,
                        serta kolaborasi lintas disiplin untuk memperluas wawasan dan jejaring.</p>
                    <ul class="text-muted mb-4 list-unstyled">
                        <li class="mb-2"><i class="bi bi-check-circle text-warning me-2"></i>Mentoring dari praktisi
                        </li>
                        <li class="mb-2"><i class="bi bi-check-circle text-warning me-2"></i>Fasilitas studio dan
                            perangkat</li>
                        <li class="mb-2"><i class="bi bi-check-circle text-warning me-2"></i>Proyek kolaborasi nyata
                        </li>
                    </ul>
                    <a href="{{ route('about') }}" class="btn btn-gradient px-4 py-2">Pelajari lebih lanjut</a>
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <div class="ratio ratio-16x9 rounded-4 overflow-hidden glass-card">
                        <img src="{{ asset('images/mascot.png') }}" alt="Tentang Kanvas"
                            class="w-100 h-100 object-fit-cover">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Join Section -->
    <section id="contact" class="py-5 section-light">
        <div class="container">
            <div class="glass-card p-5 rounded-4" data-aos="zoom-in">
                <div class="row align-items-center g-4">
                    <div class="col-lg-8">
                        <h3 class="text-dark fw-bold mb-2">Siap bergabung dengan Kanvas?</h3>
                        <p class="text-muted mb-0">Mari kembangkan potensi kreatifmu bersama komunitas yang suportif.
                        </p>
                    </div>
                    <div class="col-lg-4 d-flex gap-3 justify-content-lg-end">
                        <a href="{{ route('contact') }}" class="btn btn-outline-dark btn-lg">Hubungi Kami</a>
                        <a href="{{ route('event') }}" class="btn btn-gradient btn-lg">Lihat Kegiatan</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .hero-title {
            font-size: clamp(64px, 10vw, 170px);
            line-height: 1.1;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.3);
        }

        .slogan-text {
            font-size: clamp(28px, 4vw, 48px);
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 1rem;
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
        }

        .glass-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.3);
            background: rgba(255, 255, 255, 0.15);
        }

        /* Navbar scrolled effect */
        .nav-scrolled {
            backdrop-filter: blur(12px);
            background: rgba(0, 0, 0, 0.35) !important;
            transition: background 0.3s ease;
        }

        .mascot-image {
            filter: drop-shadow(0 10px 20px rgba(0, 0, 0, 0.3));
            transition: transform 0.3s ease;
        }

        .mascot-image:hover {
            transform: scale(1.05);
        }

        .btn-gradient {
            background: linear-gradient(135deg, #FFEC77 0%, #F8B803 50%, #FF750F 100%);
            border: none;
            color: #1b1b18;
            font-weight: 600;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(255, 236, 119, 0.4);
        }

        .btn-gradient:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(255, 236, 119, 0.6);
            color: #1b1b18;
        }

        .btn-outline-light {
            border: 2px solid #fff;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-outline-light:hover {
            background: rgba(255, 255, 255, 0.2);
            border-color: #fff;
            transform: translateY(-2px);
        }

        .guideline-num {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, rgba(255, 236, 119, .35), rgba(255, 117, 15, .35));
            color: #fff;
            font-weight: 700;
        }

        /* Light section styles to blend with the same palette */
        .section-light {
            background: #F9FAFB;
        }

        .section-light .glass-card {
            background: rgba(0, 0, 0, 0.02);
            border: 1px solid rgba(0, 0, 0, 0.08);
        }

        .btn-outline-dark {
            border-width: 2px;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-outline-dark:hover {
            transform: translateY(-2px);
        }

        @media (max-width: 1199px) {
            .mascot-container {
                margin-top: 3rem;
                padding-right: 15px !important;
            }

            .mascot-image {
                margin-right: 0 !important;
            }
        }
    </style>
@endsection
