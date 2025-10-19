@extends('layouts.app')

@section('title', 'Home - UKM Kanvas')

@section('content')
    <div class="container-fluid px-5 pe-0 min-vh-100 d-flex align-items-center hero-section">
        <div class="center-me " style="width: 100%;">
            <div class="row align-items-center" style="transform: translateX(8%);">
                <!-- Left Content Section -->
                <div class="col-xl-7 col-12" data-aos="fade-right" data-aos-duration="1000">
                    <h1 class="text-start text-white fw-bold hero-title mb-4">
                        WELCOME<br>PEEPS
                    </h1>

                    <!-- Description Section -->
                    <div class="text-white border-start border-4 border-white ps-3 mt-4 mb-4">
                        <h3 class="text-start mb-0 fs-3">Apa itu Kanvas?</h3>
                    </div>

                    <div class="description-text mb-4">
                        <p class="text-white fs-4 lh-lg">
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
                        <a href="{{ route('events') }}" class="btn btn-gradient btn-lg px-4 py-3">
                            <i class="bi bi-calendar-event me-2"></i>Lihat Event
                        </a>
                        <a href="{{ route('art_gallery') }}" class="btn btn-outline-light btn-lg px-4 py-3">
                            <i class="bi bi-palette me-2"></i>Galeri Karya
                        </a>
                    </div>
                </div>

                <!-- Right Image Section -->
                <div class="col-xl-5 col-12 d-flex justify-content-end align-items-center mascot-container"
                    data-aos="fade-left" data-aos-duration="1000" data-aos-delay="200">
                    <img src="{{ asset('images/mascot.png') }}?v=2" alt="Kanvas Mascot" class="mascot-image"
                        style="width: 100%; height: auto; max-width: 700px; transform: translateX(-28%);">
                </div>
            </div>
        </div>
    </div>

    <!-- Section Divider -->
    <div class="container">
        <div class="section-divider" data-aos="fade-in">
            <div class="divider-line"></div>
            <div class="divider-icon">
                <i class="bi bi-star-fill"></i>
            </div>
            <div class="divider-line"></div>
        </div>
    </div>

    <!-- Features Section -->
    <section id="features" class="features-section py-5">
        <div class="container">
            <div class="row text-center mb-5">
                <div class="col-12">
                    <h2 class="text-white fw-bold mb-4 display-5 text-shadow-md">Kenapa Bergabung dengan Kanvas?</h2>
                    <p class="text-white-50 fs-4 text-shadow-sm" data-aos="fade-up" data-aos-delay="100">
                        Temukan alasan mengapa Kanvas adalah tempat yang tepat untuk mengembangkan bakat senimu
                    </p>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="feature-card p-4 h-100 text-center">
                        <div class="feature-icon mb-3">
                            <i class="bi bi-brush text-warning"></i>
                        </div>
                        <h4 class="text-white mb-3 fs-3 text-shadow-sm">Workshop Rutin</h4>
                        <p class="text-white-50 fs-5 text-shadow-sm">
                            Ikuti workshop rutin dari seniman profesional dan tingkatkan skill senimu
                        </p>
                    </div>
                </div>

                <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="feature-card p-4 h-100 text-center">
                        <div class="feature-icon mb-3">
                            <i class="bi bi-people text-warning"></i>
                        </div>
                        <h4 class="text-white mb-3 fs-3 text-shadow-sm">Komunitas Kreatif</h4>
                        <p class="text-white-50 fs-5 text-shadow-sm">
                            Bergabung dengan komunitas seniman muda yang penuh passion dan inspirasi
                        </p>
                    </div>
                </div>

                <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="feature-card p-4 h-100 text-center">
                        <div class="feature-icon mb-3">
                            <i class="bi bi-trophy text-warning"></i>
                        </div>
                        <h4 class="text-white mb-3 fs-3 text-shadow-sm">Pameran & Kompetisi</h4>
                        <p class="text-white-50 fs-5 text-shadow-sm">
                            Kesempatan untuk memamerkan karyamu dan ikut kompetisi tingkat nasional
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Divider -->
    <div class="container">
        <div class="section-divider section-divider-dark" data-aos="fade-in">
            <div class="divider-line"></div>
            <div class="divider-icon">
                <i class="bi bi-heart-fill"></i>
            </div>
            <div class="divider-line"></div>
        </div>
    </div>

    <!-- Our Values Section -->
    <section class="py-5">
        <div class="container">
            <div class="row text-center mb-5">
                <div class="col-12">
                    <h2 class="text-white fw-bold mb-4 display-5 text-shadow-md" data-aos="fade-up">Our Values</h2>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="50">
                    <div class="glass-card p-4 h-100">
                        <div class="icon-bg mb-3">
                            <i class="bi bi-palette2 text-white fs-4"></i>
                        </div>
                        <h5 class="text-white mb-3 fs-4 text-shadow-sm">Creativity First</h5>
                        <p class="text-white-50 mb-0 fs-5 text-shadow-sm">We celebrate and nurture creative expression across mediums and
                            styles.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="glass-card p-4 h-100">
                        <div class="icon-bg mb-3">
                            <i class="bi bi-people text-white fs-4"></i>
                        </div>
                        <h5 class="text-white mb-3 fs-4 text-shadow-sm">Inclusive Community</h5>
                        <p class="text-white-50 mb-0 fs-5 text-shadow-sm">Welcoming all skill levels, fostering a supportive environment to
                            grow.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="150">
                    <div class="glass-card p-4 h-100">
                        <div class="icon-bg mb-3">
                            <i class="bi bi-trophy text-white fs-4"></i>
                        </div>
                        <h5 class="text-white mb-3 fs-4 text-shadow-sm">Excellence</h5>
                        <p class="text-white-50 mb-0 fs-5 text-shadow-sm">We strive for high standards while embracing experimentation.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="glass-card p-4 h-100">
                        <div class="icon-bg mb-3">
                            <i class="bi bi-heart text-white fs-4"></i>
                        </div>
                        <h5 class="text-white mb-3 fs-4 text-shadow-sm">Passion for Art</h5>
                        <p class="text-white-50 mb-0 fs-5 text-shadow-sm">We share our enthusiasm through workshops, showcases, and
                            collaborations.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="250">
                    <div class="glass-card p-4 h-100">
                        <div class="icon-bg mb-3">
                            <i class="bi bi-lightbulb text-white fs-4"></i>
                        </div>
                        <h5 class="text-white mb-3 fs-4 text-shadow-sm">Innovation</h5>
                        <p class="text-white-50 mb-0 fs-5 text-shadow-sm">We explore new media and techniques to discover unique artistic
                            voices.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="glass-card p-4 h-100">
                        <div class="icon-bg mb-3">
                            <i class="bi bi-bullseye text-white fs-4"></i>
                        </div>
                        <h5 class="text-white mb-3 fs-4 text-shadow-sm">Goal-Oriented</h5>
                        <p class="text-white-50 mb-0 fs-5 text-shadow-sm">We set clear goals for growth, events, and meaningful achievements.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Divider -->
    <div class="container">
        <div class="section-divider section-divider-dark" data-aos="fade-in">
            <div class="divider-line"></div>
            <div class="divider-icon">
                <i class="bi bi-bookmark-fill"></i>
            </div>
            <div class="divider-line"></div>
        </div>
    </div>

    <!-- Club Guidelines Section -->
    <section class="py-5">
        <div class="container">
            <div class="row text-center mb-5">
                <div class="col-12">
                    <h2 class="text-white fw-bold mb-4 display-5 text-shadow-md" data-aos="fade-up">Club Guidelines</h2>
                </div>
            </div>

            <div class="vstack gap-3">
                <div class="glass-card p-4" data-aos="fade-up" data-aos-delay="50">
                    <div class="d-flex align-items-start gap-3">
                        <div class="guideline-num fs-5">01</div>
                        <div>
                            <h5 class="text-white mb-2 fs-4 text-shadow-sm">Respect & Support</h5>
                            <p class="text-white-50 mb-0 fs-5 text-shadow-sm">Treat all members with respect and provide constructive feedback.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="glass-card p-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="d-flex align-items-start gap-3">
                        <div class="guideline-num fs-5">02</div>
                        <div>
                            <h5 class="text-white mb-2 fs-4 text-shadow-sm">Active Participation</h5>
                            <p class="text-white-50 mb-0 fs-5 text-shadow-sm">Aim to attend club activities and events regularly.</p>
                        </div>
                    </div>
                </div>
                <div class="glass-card p-4" data-aos="fade-up" data-aos-delay="150">
                    <div class="d-flex align-items-start gap-3">
                        <div class="guideline-num fs-5">03</div>
                        <div>
                            <h5 class="text-white mb-2 fs-4 text-shadow-sm">Original Work</h5>
                            <p class="text-white-50 mb-0 fs-5 text-shadow-sm">All submitted artworks must be original creations.</p>
                        </div>
                    </div>
                </div>
                <div class="glass-card p-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="d-flex align-items-start gap-3">
                        <div class="guideline-num fs-5">04</div>
                        <div>
                            <h5 class="text-white mb-2 fs-4 text-shadow-sm">Studio Care</h5>
                            <p class="text-white-50 mb-0 fs-5 text-shadow-sm">Keep the studio clean and return all materials after use.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Divider -->
    <div class="container">
        <div class="section-divider section-divider-dark" data-aos="fade-in">
            <div class="divider-line"></div>
            <div class="divider-icon">
                <i class="bi bi-bullseye"></i>
            </div>
            <div class="divider-line"></div>
        </div>
    </div>

    <!-- Mission Section -->
    <section class="py-5">
        <div class="container">
            <div class="glass-card p-5" data-aos="zoom-in">
                <h2 class="text-center text-white fw-bold mb-4 display-5 text-shadow-md">Our Mission</h2>
                <p class="text-center text-white-50 mb-0 fs-4 text-shadow-sm">To create an inclusive platform where students can explore,
                    develop, and showcase their artistic talents while fostering a supportive community that celebrates
                    creativity, innovation, and excellence.</p>
            </div>
        </div>
    </section>

    <!-- Section Divider -->
    <div class="container">
        <div class="section-divider" data-aos="fade-in">
            <div class="divider-line"></div>
            <div class="divider-icon">
                <i class="bi bi-calendar-event-fill"></i>
            </div>
            <div class="divider-line"></div>
        </div>
    </div>

    <!-- Upcoming Events Section -->
    <section id="events" class="py-5">
        <div class="container">
            <div class="row align-items-end mb-4">
                <div class="col">
                    <h2 class="text-white fw-bold display-5 text-shadow-md" data-aos="fade-up">Upcoming Events</h2>
                    <p class="text-white-50 mb-0 fs-4 text-shadow-sm" data-aos="fade-up" data-aos-delay="100">Ikuti kegiatan Kanvas terbaru dan
                        tingkatkan jaringan kreatifmu</p>
                </div>
                <div class="col-auto">
                    <a href="{{ route('events') }}" class="btn btn-outline-light">Lihat Semua</a>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="card border-0 h-100 event-card">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center mb-3">
                                <span class="badge bg-warning text-dark me-2 event-badge">Workshop</span>
                                <small class="text-white-50 event-badge text-shadow-sm">Sab, 26 Okt</small>
                            </div>
                            <h5 class="card-title text-white fs-3 text-shadow-sm">Dasar Ilustrasi Digital</h5>
                            <p class="card-text text-white-50 fs-5 text-shadow-sm">Belajar workflow ilustrasi dari sketsa hingga final render.
                            </p>
                            <a href="{{ route('events') }}" class="link-light text-decoration-none fs-5 text-shadow-sm">Detail event →</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="card border-0 h-100 event-card">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center mb-3">
                                <span class="badge bg-warning text-dark me-2 event-badge">Talkshow</span>
                                <small class="text-white-50 event-badge text-shadow-sm">Min, 3 Nov</small>
                            </div>
                            <h5 class="card-title text-white fs-3 text-shadow-sm">Career in Creative Industry</h5>
                            <p class="card-text text-white-50 fs-5 text-shadow-sm">Ngobrol bareng praktisi industri desain dan ilustrasi.</p>
                            <a href="{{ route('events') }}" class="link-light text-decoration-none fs-5 text-shadow-sm">Detail event →</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="card border-0 h-100 event-card">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center mb-3">
                                <span class="badge bg-warning text-dark me-2 event-badge">Exhibition</span>
                                <small class="text-white-50 event-badge text-shadow-sm">Sab, 16 Nov</small>
                            </div>
                            <h5 class="card-title text-white fs-3 text-shadow-sm">Kanvas Art Showcase</h5>
                            <p class="card-text text-white-50 fs-5 text-shadow-sm">Pameran karya anggota Kanvas terbaik bulan ini.</p>
                            <a href="{{ route('events') }}" class="link-light text-decoration-none fs-5 text-shadow-sm">Detail event →</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <!-- Section Divider -->
    <div class="section-divider section-divider-dark" data-aos="fade-in">
        <div class="divider-line"></div>
        <div class="divider-icon">
            <i class="bi bi-palette-fill"></i>
        </div>
        <div class="divider-line"></div>
    </div>

    <!-- Gallery Preview Section -->
    <section id="gallery" class="py-5">
        <div class="container">
            <div class="d-flex align-items-end justify-content-between mb-4">
                <div>
                    <h2 class="text-white fw-bold display-5 text-shadow-md" data-aos="fade-up">Galeri Karya</h2>
                    <p class="text-white-50 mb-0 fs-4 text-shadow-sm" data-aos="fade-up" data-aos-delay="100">Karya terbaru dari anggota
                        Kanvas</p>
                </div>
                <a href="{{ route('art_gallery') }}" class="btn btn-outline-light">Lihat Galeri</a>
            </div>

            <div class="row g-3">
                <div class="col-6 col-md-3" data-aos="zoom-in" data-aos-delay="50">
                    <div class="ratio ratio-1x1 overflow-hidden glass-card">
                        <img src="{{ asset('images/mascot.png') }}" alt="Karya 1" class="w-100 h-100 object-fit-cover">
                    </div>
                </div>
                <div class="col-6 col-md-3" data-aos="zoom-in" data-aos-delay="100">
                    <div class="ratio ratio-1x1 overflow-hidden glass-card">
                        <img src="{{ asset('images/mascot.png') }}" alt="Karya 2" class="w-100 h-100 object-fit-cover">
                    </div>
                </div>
                <div class="col-6 col-md-3" data-aos="zoom-in" data-aos-delay="150">
                    <div class="ratio ratio-1x1 overflow-hidden glass-card">
                        <img src="{{ asset('images/mascot.png') }}" alt="Karya 3" class="w-100 h-100 object-fit-cover">
                    </div>
                </div>
                <div class="col-6 col-md-3" data-aos="zoom-in" data-aos-delay="200">
                    <div class="ratio ratio-1x1 overflow-hidden glass-card">
                        <img src="{{ asset('images/mascot.png') }}" alt="Karya 4" class="w-100 h-100 object-fit-cover">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Divider -->
    <div class="section-divider" data-aos="fade-in">
        <div class="divider-line"></div>
        <div class="divider-icon">
            <i class="bi bi-info-circle-fill"></i>
        </div>
        <div class="divider-line"></div>
    </div>

    <!-- About Section -->
    <section id="about" class="py-5">
        <div class="container">
            <div class="row align-items-center g-4">
                <div class="col-lg-6" data-aos="fade-right">
                    <div class="glass-card p-4">
                        <h2 class="text-white fw-bold mb-4 display-5 text-shadow-md">Tentang Kanvas</h2>
                        <p class="text-white-50 fs-4 mb-4 text-shadow-sm">Kanvas adalah komunitas kreatif di lingkungan kampus yang mendorong
                            eksplorasi seni visual, desain, dan media kreatif lainnya. Kami rutin mengadakan workshop, pameran,
                            serta kolaborasi lintas disiplin untuk memperluas wawasan dan jejaring.</p>
                        <ul class="text-white-50 mb-4 list-unstyled fs-5 text-shadow-sm">
                            <li class="mb-2"><i class="bi bi-check-circle text-warning me-2"></i>Mentoring dari praktisi
                            </li>
                            <li class="mb-2"><i class="bi bi-check-circle text-warning me-2"></i>Fasilitas studio dan
                                perangkat</li>
                            <li class="mb-2"><i class="bi bi-check-circle text-warning me-2"></i>Proyek kolaborasi nyata
                            </li>
                        </ul>
                        <a href="{{ route('about') }}" class="btn btn-gradient px-4 py-2">Pelajari lebih lanjut</a>
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <div class="ratio ratio-16x9 overflow-hidden glass-card">
                        <img src="{{ asset('images/mascot.png') }}" alt="Tentang Kanvas"
                            class="w-100 h-100 object-fit-cover">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Divider -->
    <div class="section-divider" data-aos="fade-in">
        <div class="divider-line"></div>
        <div class="divider-icon">
            <i class="bi bi-envelope-fill"></i>
        </div>
        <div class="divider-line"></div>
    </div>

    <!-- CTA Join Section -->
    <section id="contact" class="py-5">
        <div class="container">
            <div class="glass-card p-5" data-aos="zoom-in">
                <div class="row align-items-center g-4">
                    <div class="col-lg-8">
                        <h3 class="text-white fw-bold mb-3 display-6 text-shadow-md">Siap bergabung dengan Kanvas?</h3>
                        <p class="text-white-50 mb-0 fs-4 text-shadow-sm">Mari kembangkan potensi kreatifmu bersama komunitas yang suportif.
                        </p>
                    </div>
                    <div class="col-lg-4 d-flex gap-3 justify-content-lg-end">
                        <a href="{{ route('contact') }}" class="btn btn-outline-light btn-lg">Hubungi Kami</a>
                        <a href="{{ route('events') }}" class="btn btn-gradient btn-lg">Lihat Kegiatan</a>
                    </div>
                </div>
            </div>
        </div>
    </section>




    {{-- yg kemarin coba" embed  --}}

    {{-- <section>
        
<br><br>
<iframe data-testid="embed-iframe" style="border-radius:12px" src="https://open.spotify.com/embed/track/1CPZ5BxNNd0n0nF4Orb9JS?utm_source=generator" width="100%" height="152" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy">
</iframe>
<iframe width="2033" height="937" src="https://www.youtube.com/embed/SdSSPF1S-Uc" title="Live NOW: Victoria&#39;s Secret Fashion Show 2025" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>

<blockquote class="instagram-media" data-instgrm-captioned data-instgrm-permalink="https://www.instagram.com/p/DPd0SHUibrk/?utm_source=ig_embed&amp;utm_campaign=loading" data-instgrm-version="14" style=" background:#ff9c9c; border:0; border-radius:3px; box-shadow:0 0 1px 0 rgba(0,0,0,0.5),0 1px 10px 0 rgba(0,0,0,0.15); margin: 1px; max-width:540px; min-width:326px; padding:0; width:99.375%; width:-webkit-calc(100% - 2px); width:calc(100% - 2px);"><div style="padding:16px;"> <a href="https://www.instagram.com/p/DPd0SHUibrk/?utm_source=ig_embed&amp;utm_campaign=loading" style=" background:#FFFFFF; line-height:0; padding:0 0; text-align:center; text-decoration:none; width:100%;" target="_blank"> <div style=" display: flex; flex-direction: row; align-items: center;"> <div style="background-color: #F4F4F4; border-radius: 50%; flex-grow: 0; height: 40px; margin-right: 14px; width: 40px;"></div> <div style="display: flex; flex-direction: column; flex-grow: 1; justify-content: center;"> <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; margin-bottom: 6px; width: 100px;"></div> <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; width: 60px;"></div></div></div><div style="padding: 19% 0;"></div> <div style="display:block; height:50px; margin:0 auto 12px; width:50px;"><svg width="50px" height="50px" viewBox="0 0 60 60" version="1.1" xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g transform="translate(-511.000000, -20.000000)" fill="#000000"><g><path d="M556.869,30.41 C554.814,30.41 553.148,32.076 553.148,34.131 C553.148,36.186 554.814,37.852 556.869,37.852 C558.924,37.852 560.59,36.186 560.59,34.131 C560.59,32.076 558.924,30.41 556.869,30.41 M541,60.657 C535.114,60.657 530.342,55.887 530.342,50 C530.342,44.114 535.114,39.342 541,39.342 C546.887,39.342 551.658,44.114 551.658,50 C551.658,55.887 546.887,60.657 541,60.657 M541,33.886 C532.1,33.886 524.886,41.1 524.886,50 C524.886,58.899 532.1,66.113 541,66.113 C549.9,66.113 557.115,58.899 557.115,50 C557.115,41.1 549.9,33.886 541,33.886 M565.378,62.101 C565.244,65.022 564.756,66.606 564.346,67.663 C563.803,69.06 563.154,70.057 562.106,71.106 C561.058,72.155 560.06,72.803 558.662,73.347 C557.607,73.757 556.021,74.244 553.102,74.378 C549.944,74.521 548.997,74.552 541,74.552 C533.003,74.552 532.056,74.521 528.898,74.378 C525.979,74.244 524.393,73.757 523.338,73.347 C521.94,72.803 520.942,72.155 519.894,71.106 C518.846,70.057 518.197,69.06 517.654,67.663 C517.244,66.606 516.755,65.022 516.623,62.101 C516.479,58.943 516.448,57.996 516.448,50 C516.448,42.003 516.479,41.056 516.623,37.899 C516.755,34.978 517.244,33.391 517.654,32.338 C518.197,30.938 518.846,29.942 519.894,28.894 C520.942,27.846 521.94,27.196 523.338,26.654 C524.393,26.244 525.979,25.756 528.898,25.623 C532.057,25.479 533.004,25.448 541,25.448 C548.997,25.448 549.943,25.479 553.102,25.623 C556.021,25.756 557.607,26.244 558.662,26.654 C560.06,27.196 561.058,27.846 562.106,28.894 C563.154,29.942 563.803,30.938 564.346,32.338 C564.756,33.391 565.244,34.978 565.378,37.899 C565.522,41.056 565.552,42.003 565.552,50 C565.552,57.996 565.522,58.943 565.378,62.101 M570.82,37.631 C570.674,34.438 570.167,32.258 569.425,30.349 C568.659,28.377 567.633,26.702 565.965,25.035 C564.297,23.368 562.623,22.342 560.652,21.575 C558.743,20.834 556.562,20.326 553.369,20.18 C550.169,20.033 549.148,20 541,20 C532.853,20 531.831,20.033 528.631,20.18 C525.438,20.326 523.257,20.834 521.349,21.575 C519.376,22.342 517.703,23.368 516.035,25.035 C514.368,26.702 513.342,28.377 512.574,30.349 C511.834,32.258 511.326,34.438 511.181,37.631 C511.035,40.831 511,41.851 511,50 C511,58.147 511.035,59.17 511.181,62.369 C511.326,65.562 511.834,67.743 512.574,69.651 C513.342,71.625 514.368,73.296 516.035,74.965 C517.703,76.634 519.376,77.658 521.349,78.425 C523.257,79.167 525.438,79.673 528.631,79.82 C531.831,79.965 532.853,80.001 541,80.001 C549.148,80.001 550.169,79.965 553.369,79.82 C556.562,79.673 558.743,79.167 560.652,78.425 C562.623,77.658 564.297,76.634 565.965,74.965 C567.633,73.296 568.659,71.625 569.425,69.651 C570.167,67.743 570.674,65.562 570.82,62.369 C570.966,59.17 571,58.147 571,50 C571,41.851 570.966,40.831 570.82,37.631"></path></g></g></g></svg></div><div style="padding-top: 8px;"> <div style=" color:#3897f0; font-family:Arial,sans-serif; font-size:14px; font-style:normal; font-weight:550; line-height:18px;">View this post on Instagram</div></div><div style="padding: 12.5% 0;"></div> <div style="display: flex; flex-direction: row; margin-bottom: 14px; align-items: center;"><div> <div style="background-color: #F4F4F4; border-radius: 50%; height: 12.5px; width: 12.5px; transform: translateX(0px) translateY(7px);"></div> <div style="background-color: #F4F4F4; height: 12.5px; transform: rotate(-45deg) translateX(3px) translateY(1px); width: 12.5px; flex-grow: 0; margin-right: 14px; margin-left: 2px;"></div> <div style="background-color: #F4F4F4; border-radius: 50%; height: 12.5px; width: 12.5px; transform: translateX(9px) translateY(-18px);"></div></div><div style="margin-left: 8px;"> <div style=" background-color: #F4F4F4; border-radius: 50%; flex-grow: 0; height: 20px; width: 20px;"></div> <div style=" width: 0; height: 0; border-top: 2px solid transparent; border-left: 6px solid #f4f4f4; border-bottom: 2px solid transparent; transform: translateX(16px) translateY(-4px) rotate(30deg)"></div></div><div style="margin-left: auto;"> <div style=" width: 0px; border-top: 8px solid #F4F4F4; border-right: 8px solid transparent; transform: translateY(16px);"></div> <div style=" background-color: #F4F4F4; flex-grow: 0; height: 12px; width: 16px; transform: translateY(-4px);"></div> <div style=" width: 0; height: 0; border-top: 8px solid #F4F4F4; border-left: 8px solid transparent; transform: translateY(-4px) translateX(8px);"></div></div></div> <div style="display: flex; flex-direction: column; flex-grow: 1; justify-content: center; margin-bottom: 24px;"> <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; margin-bottom: 6px; width: 224px;"></div> <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; width: 144px;"></div></div></a><p style=" color:#c9c8cd; font-family:Arial,sans-serif; font-size:14px; line-height:17px; margin-bottom:0; margin-top:8px; overflow:hidden; padding:8px 0 7px; text-align:center; text-overflow:ellipsis; white-space:nowrap;"><a href="https://www.instagram.com/p/DPd0SHUibrk/?utm_source=ig_embed&amp;utm_campaign=loading" style=" color:#c9c8cd; font-family:Arial,sans-serif; font-size:14px; font-style:normal; font-weight:normal; line-height:17px; text-decoration:none;" target="_blank">A post shared by Kanvas Ciputra University (@uc_kanvas)</a></p></div></blockquote>
<script async src="//www.instagram.com/embed.js"></script>
    </section> --}}

    <style> 
        /* Hero Section with Background and Gradient Overlay */
        .hero-section {

            position: relative;
            background-image: url('{{ asset("images/bg1.jpg") }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        .hero-section::before {
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
            z-index: 1;
        }

        .hero-section > * {
            position: relative;
            z-index: 2;
        }

        .hero-title {
            font-size: clamp(64px, 10vw, 170px);
            line-height: 1.1;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.3);
        }

        .slogan-text {
            font-size: clamp(28px, 4vw, 48px);
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


        .guideline-num {
            width: 56px;
            height: 56px;
            border-radius: 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, rgba(255, 236, 119, .35), rgba(255, 117, 15, .35));
            color: #fff;
            font-weight: 700;
        }

        /* Section Dividers */
        .section-divider {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1rem;
            padding: 2rem 0;
            max-width: 600px;
            margin: 0 auto;
        }

        .section-divider-dark {
            /* For dark background sections */
        }

        .divider-line {
            flex: 1;
            height: 2px;
            background: linear-gradient(to right, transparent, rgba(255, 255, 255, 0.3), transparent);
        }

        .section-light .divider-line {
            background: linear-gradient(to right, transparent, rgba(0, 0, 0, 0.2), transparent);
        }

        .divider-icon {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, rgba(255, 236, 119, 0.3), rgba(255, 117, 15, 0.3));
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 255, 255, 0.3);
        }

        .section-divider-dark .divider-icon {
            background: linear-gradient(135deg, rgba(255, 236, 119, 0.25), rgba(255, 117, 15, 0.25));
            border: 2px solid rgba(255, 255, 255, 0.2);
        }

        .section-light .divider-icon {
            background: linear-gradient(135deg, rgba(255, 236, 119, 0.5), rgba(255, 117, 15, 0.5));
            border: 2px solid rgba(0, 0, 0, 0.1);
        }

        .divider-icon i {
            font-size: 1.2rem;
            color: #fff;
        }

        .section-light .divider-icon i {
            color: #333;
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

        /* Override text-white-50 to be lighter and closer to white */
        .text-white-50 {
            color: rgb(229, 229, 229) !important;
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
