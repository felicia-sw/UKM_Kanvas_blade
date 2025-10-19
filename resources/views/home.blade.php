@extends('layouts.app')

@section('title', 'Home - UKM Kanvas')

@section('content')
    <div class="hero-wrapper position-relative overflow-hidden">
        <!-- Animated gradient background -->
        <div class="gradient-bg-animated"></div>
        
        <!-- Background cityscape with parallax effect -->
        <div class="cityscape-bg position-absolute w-100" style="bottom: 0; z-index: 1;" data-aos="fade-up" data-aos-duration="1500">
            <img src="{{ asset('images/buildings_blue.png') }}" alt="City Background" class="w-100 parallax-element" style="opacity: 0.5;" data-speed="0.3">
        </div>

        <!-- Enhanced floating clouds with varied speeds -->
        <div class="floating-clouds position-absolute w-100" style="top: 5%; z-index: 2; pointer-events: none;">
            <img src="{{ asset('images/cloud1.png') }}" alt="" class="cloud cloud-1 parallax-element" data-speed="0.5"
                style="position: absolute; left: 5%; width: 450px; opacity: 0.8; animation: floatCloud 20s ease-in-out infinite; filter: drop-shadow(0 10px 20px rgba(0,0,0,0.15));">
            <img src="{{ asset('images/cloud2.png') }}" alt="" class="cloud cloud-2 parallax-element" data-speed="0.4"
                style="position: absolute; right: 8%; width: 400px; opacity: 0.75; animation: floatCloud 25s ease-in-out infinite reverse; filter: drop-shadow(0 10px 20px rgba(0,0,0,0.15));">
            <img src="{{ asset('images/cloud3.png') }}" alt="" class="cloud cloud-3 parallax-element" data-speed="0.6"
                style="position: absolute; left: 35%; top: 25%; width: 350px; opacity: 0.7; animation: floatCloud 30s ease-in-out infinite; filter: drop-shadow(0 10px 20px rgba(0,0,0,0.15));">
            <img src="{{ asset('images/cloud4.png') }}" alt="" class="cloud cloud-4 parallax-element" data-speed="0.45"
                style="position: absolute; right: 30%; top: 40%; width: 300px; opacity: 0.65; animation: floatCloud 28s ease-in-out infinite 2s; filter: drop-shadow(0 10px 20px rgba(0,0,0,0.15));">
            <img src="{{ asset('images/cloud5.png') }}" alt="" class="cloud cloud-5 parallax-element" data-speed="0.55"
                style="position: absolute; left: 20%; top: 50%; width: 280px; opacity: 0.6; animation: floatCloud 32s ease-in-out infinite 1s; filter: drop-shadow(0 10px 20px rgba(0,0,0,0.15));">
        </div>

        <!-- Purple buildings with enhanced styling -->
        <div class="hills-bg position-absolute w-100" style="bottom: 0; z-index: 3;" data-aos="fade-up" data-aos-duration="1200">
            <img src="{{ asset('images/buildings_purple.png') }}" alt="" class="w-100 parallax-element" style="opacity: 0.6;" data-speed="0.2">
        </div>

        <div class="container-fluid px-5 min-vh-100 d-flex align-items-center hero-section position-relative" style="z-index: 4;">
            <div class="center-me w-100">
                <div class="row align-items-center justify-content-center g-0">
                    <!-- Left Content Section -->
                    <div class="col-lg-6 col-12 position-relative pe-0" data-aos="fade-right" data-aos-duration="1000">
                        <!-- Enhanced Street Lamp with dynamic light -->
                        <div class="streetlamp-container position-absolute" style="left: -150px; top: -100px; width: 300px; height: 600px; z-index: 5;">
                            <!-- Animated light beam -->
                            <div class="light-beam-dynamic"></div>
                            
                            <!-- Pulsing lamp glow -->
                            <div class="lamp-glow-enhanced"></div>
                            
                            <!-- Particle effects around light -->
                            <div class="light-particles">
                                <span class="particle"></span>
                                <span class="particle"></span>
                                <span class="particle"></span>
                                <span class="particle"></span>
                                <span class="particle"></span>
                            </div>
                        </div>

                        <!-- Title with glowing effect -->
                        <div class="title-container position-relative mb-4" style="z-index: 10;">
                            <div class="text-glow-overlay"></div>
                            
                            <h1 class="text-start text-white fw-bold hero-title display-1 mb-0 position-relative animate-on-scroll" 
                                data-aos="fade-up" data-aos-delay="200"
                                style="font-size: 8rem; letter-spacing: 0.05em; line-height: 1.1; z-index: 2;">
                                WELCOME
                            </h1>
                            <h1 class="text-start fw-bold hero-title display-1 position-relative gradient-text-animated" 
                                data-aos="fade-up" data-aos-delay="300"
                                style="font-size: 8rem; margin-top: -10px; letter-spacing: 0.05em; line-height: 1.1; z-index: 2;">
                                PEEPS
                            </h1>
                            
                            <!-- Decorative sparkles -->
                            <div class="sparkle sparkle-1"></div>
                            <div class="sparkle sparkle-2"></div>
                            <div class="sparkle sparkle-3"></div>
                        </div>

                        <!-- Enhanced glass card with border animation -->
                        <div class="glass-info-card-enhanced p-4 rounded-4 mb-4" data-aos="fade-up" data-aos-delay="400">
                            <div class="card-border-animation"></div>
                            <div class="d-flex align-items-center mb-3">
                                <div class="icon-box-animated me-3">
                                    <i class="bi bi-palette-fill text-white fs-4"></i>
                                </div>
                                <h3 class="text-white mb-0 fs-3 fw-bold">Apa itu Kanvas?</h3>
                            </div>

                            <p class="text-white fs-5 lh-lg mb-0" style="text-shadow: 1px 1px 3px rgba(0,0,0,0.3);">
                                Kanvas is a Unit Kegiatan Mahasiswa﻿ dedicated to nurturing artistic creativity and design. 
                                We are a home for young artists eager to express themselves through various art mediums.
                            </p>
                        </div>

                        <!-- Slogan with decorative elements -->
                        <div class="slogan-container position-relative mt-5 pt-3 mb-4" data-aos="fade-up" data-aos-delay="500">
                            <div class="quote-mark-animated">"</div>
                            <h2 class="text-white text-start fw-bold slogan-text fs-2 fst-italic">
                                Express. Create. Inspire.
                            </h2>
                            <div class="underline-animation"></div>
                        </div>

                        <!-- Enhanced CTA Buttons -->
                        <div class="mt-5 d-flex gap-3 flex-wrap" data-aos="fade-up" data-aos-delay="600">
                            <a href="{{ route('events') }}" class="btn-enhanced btn-gradient-enhanced px-5 py-3">
                                <span class="btn-text">
                                    <i class="bi bi-calendar-event me-2"></i>View Events
                                </span>
                                <span class="btn-shine"></span>
                            </a>
                            <a href="{{ route('art_gallery') }}" class="btn-enhanced btn-outline-enhanced px-5 py-3">
                                <span class="btn-text">
                                    <i class="bi bi-palette me-2"></i>Art Gallery
                                </span>
                            </a>
                        </div>

                        <!-- Enhanced floating stars -->
                        <div class="star-field">
                            <i class="bi bi-star-fill floating-star star-1"></i>
                            <i class="bi bi-star-fill floating-star star-2"></i>
                            <i class="bi bi-star-fill floating-star star-3"></i>
                            <i class="bi bi-star-fill floating-star star-4"></i>
                        </div>
                    </div>
                {{-- @empty
                    <div class="col-12 text-center">
                        <p class="text-white-50">Belum ada karya yang ditampilkan</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section> --}}

    <style>
        .artwork-card-enhanced {
            height: 300px;
            overflow: hidden;
            border-radius: 1.5rem;
            transition: all 0.4s ease;
            position: relative;
            border: 2px solid rgba(255, 255, 255, 0.1);
        }

        .artwork-card-enhanced::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(255, 236, 119, 0.1), rgba(255, 117, 15, 0.1));
            opacity: 0;
            transition: opacity 0.4s;
            z-index: 1;
            border-radius: 1.5rem;
        }

        .artwork-card-enhanced:hover::before {
            opacity: 1;
        }

        .artwork-image-container-enhanced {
            position: relative;
            height: 100%;
            overflow: hidden;
            border-radius: 1.5rem;
        }

        .artwork-image-enhanced {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .artwork-card-enhanced:hover {
            transform: translateY(-8px);
            border-color: rgba(255, 236, 119, 0.5);
            box-shadow: 0 20px 50px rgba(255, 117, 15, 0.4);
        }

        .artwork-card-enhanced:hover .artwork-image-enhanced {
            transform: scale(1.15);
        }

        .artwork-overlay-enhanced {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to top, rgba(42, 10, 86, 0.95) 0%, transparent 100%);
            opacity: 0;
            transition: opacity 0.4s ease;
            display: flex;
            align-items: flex-end;
            padding: 1.5rem;
            z-index: 2;
        }

        .artwork-card-enhanced:hover .artwork-overlay-enhanced {
            opacity: 1;
        }

        .artwork-info-enhanced {
            transform: translateY(20px);
            transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .artwork-card-enhanced:hover .artwork-info-enhanced {
            transform: translateY(0);
        }

        /* Popup Styles */
        .artwork-popup-home {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) scale(0);
            width: 320px;
            max-width: 90%;
            background: rgba(42, 10, 86, 0.98);
            backdrop-filter: blur(20px);
            border: 2px solid rgba(255, 236, 119, 0.5);
            border-radius: 1rem;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
            z-index: 100;
            opacity: 0;
            transition: all 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            pointer-events: none;
        }

        .artwork-popup-home.active {
            transform: translate(-50%, -50%) scale(1);
            opacity: 1;
            pointer-events: auto;
        }

        .popup-header {
            padding: 1rem 1.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .popup-close {
            background: transparent;
            border: none;
            color: #fff;
            font-size: 1.2rem;
            cursor: pointer;
            padding: 0.25rem 0.5rem;
            transition: all 0.3s;
        }

        .popup-close:hover {
            color: #FFEC77;
            transform: rotate(90deg);
        }

        .popup-body {
            padding: 1.5rem;
        }

        .popup-item {
            display: flex;
            gap: 1rem;
            margin-bottom: 1rem;
            align-items: flex-start;
        }

        .popup-item i {
            font-size: 1.2rem;
            margin-top: 0.25rem;
        }

        .popup-description {
            font-size: 0.9rem;
            line-height: 1.5;
        }

        @media (max-width: 767px) {
            .artwork-card-enhanced {
                height: 250px;
            }
            .artwork-popup-home {
                width: 280px;
            }
        }
    </style>

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
                    <div class="about-card-enhanced p-4">
                        <h2 class="text-white fw-bold mb-4 display-5 text-shadow-md">Tentang Kanvas</h2>
                        <p class="text-white-50 fs-4 mb-4 text-shadow-sm">Kanvas adalah komunitas kreatif di lingkungan kampus yang mendorong eksplorasi seni visual, desain, dan media kreatif lainnya. Kami rutin mengadakan workshop, pameran, serta kolaborasi lintas disiplin untuk memperluas wawasan dan jejaring.</p>
                        <ul class="text-white-50 mb-4 list-unstyled fs-5 text-shadow-sm">
                            <li class="mb-2 feature-list-item"><i class="bi bi-check-circle text-warning me-2"></i>Mentoring dari praktisi</li>
                            <li class="mb-2 feature-list-item"><i class="bi bi-check-circle text-warning me-2"></i>Fasilitas studio dan perangkat</li>
                            <li class="mb-2 feature-list-item"><i class="bi bi-check-circle text-warning me-2"></i>Proyek kolaborasi nyata</li>
                        </ul>
                        <a href="{{ route('about') }}" class="btn btn-gradient px-4 py-2">Pelajari lebih lanjut</a>
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <div class="ratio ratio-16x9 overflow-hidden about-image-container">
                        <img src="{{ asset('images/mascot.png') }}" alt="Tentang Kanvas" class="w-100 h-100 object-fit-cover about-image">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .about-card-enhanced {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 1.5rem;
            transition: all 0.3s ease;
        }

        .about-card-enhanced:hover {
            border-color: rgba(255, 236, 119, 0.3);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
        }

        .feature-list-item {
            transition: all 0.3s ease;
            padding-left: 0.5rem;
        }

        .feature-list-item:hover {
            transform: translateX(10px);
            color: #fff !important;
        }

        .about-image-container {
            border-radius: 1.5rem;
            overflow: hidden;
            border: 2px solid rgba(255, 236, 119, 0.3);
            box-shadow: 0 15px 40px rgba(255, 117, 15, 0.3);
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px);
        }

        .about-image {
            transition: transform 0.5s ease;
        }

        .about-image-container:hover .about-image {
            transform: scale(1.05);
        }
    </style>

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
            <div class="cta-card-enhanced p-5" data-aos="zoom-in">
                <div class="cta-bg-decoration"></div>
                <div class="row align-items-center g-4 position-relative" style="z-index: 2;">
                    <div class="col-lg-8">
                        <h3 class="text-white fw-bold mb-3 display-6 text-shadow-md">Siap bergabung dengan Kanvas?</h3>
                        <p class="text-white-50 mb-0 fs-4 text-shadow-sm">Mari kembangkan potensi kreatifmu bersama komunitas yang suportif.</p>
                    </div>
                    <div class="col-lg-4 d-flex gap-3 justify-content-lg-end">
                        <a href="{{ route('contact') }}" class="btn btn-outline-light btn-lg">Hubungi Kami</a>
                        <a href="{{ route('events') }}" class="btn btn-gradient btn-lg">Lihat Kegiatan</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .cta-card-enhanced {
            position: relative;
            background: linear-gradient(135deg, rgba(255, 236, 119, 0.15), rgba(255, 117, 15, 0.15));
            backdrop-filter: blur(20px);
            border: 2px solid rgba(255, 236, 119, 0.4);
            border-radius: 2rem;
            box-shadow: 0 20px 60px rgba(255, 117, 15, 0.3);
            overflow: hidden;
        }

        .cta-bg-decoration {
            position: absolute;
            top: -50%;
            right: -20%;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(255, 236, 119, 0.3), transparent);
            border-radius: 50%;
            animation: ctaDecoration 10s ease-in-out infinite;
        }

        @keyframes ctaDecoration {
            0%, 100% {
                transform: translate(0, 0) scale(1);
            }
            50% {
                transform: translate(-30px, 30px) scale(1.2);
            }
        }
    </style>

    <!-- Popup functions for home gallery -->
    <script>
        function togglePopupHome(event, artworkId) {
            event.stopPropagation();
            const popup = document.getElementById(`popup-home-${artworkId}`);
            const allPopups = document.querySelectorAll('.artwork-popup-home');

            // Close all other popups
            allPopups.forEach(p => {
                if (p.id !== `popup-home-${artworkId}`) {
                    p.classList.remove('active');
                }
            });

            // Toggle current popup
            popup.classList.toggle('active');
        }

        function closePopupHome(artworkId) {
            const popup = document.getElementById(`popup-home-${artworkId}`);
            popup.classList.remove('active');
        }

        // Close popup when clicking outside
        document.addEventListener('click', function(event) {
            if (!event.target.closest('.artwork-card-enhanced') && !event.target.closest('.btn-gradient')) {
                document.querySelectorAll('.artwork-popup-home').forEach(popup => {
                    popup.classList.remove('active');
                });
            }
        });
    </script>

@endsection>

                    <!-- Right Image Section with enhanced effects -->
                    <div class="col-lg-5 col-12 d-flex justify-content-start align-items-center mascot-container position-relative ps-lg-0" 
                         data-aos="fade-left" data-aos-duration="1000" data-aos-delay="200">

                        <!-- Enhanced glow effect -->
                        <div class="mascot-glow-enhanced"></div>
                        
                        <!-- Animated ring effect -->
                        <div class="mascot-ring-effect"></div>

                        <!-- Main mascot with hover effect -->
                        <div class="mascot-wrapper position-relative" style="z-index: 2; margin-left: -50px;">
                            <img src="{{ asset('images/mascot.png') }}?v=2" alt="Kanvas Mascot" class="mascot-image-enhanced">
                        </div>

                        <!-- Animated decorative elements -->
                        <div class="decoration-orbit">
                            <i class="bi bi-brush-fill orbit-icon orbit-1"></i>
                            <i class="bi bi-palette2 orbit-icon orbit-2"></i>
                            <i class="bi bi-heart-fill orbit-icon orbit-3"></i>
                        </div>

                        <!-- Enhanced stars around mascot -->
                        <div class="mascot-stars">
                            <i class="bi bi-star-fill mascot-star mascot-star-1"></i>
                            <i class="bi bi-star-fill mascot-star mascot-star-2"></i>
                            <i class="bi bi-star-fill mascot-star mascot-star-3"></i>
                            <i class="bi bi-star-fill mascot-star mascot-star-4"></i>
                            <i class="bi bi-star-fill mascot-star mascot-star-5"></i>
                            <i class="bi bi-star-fill mascot-star mascot-star-6"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Animated gradient background */
        .gradient-bg-animated {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, 
                #2a0a56 0%, 
                #4a1a76 25%, 
                #6a2a96 50%, 
                #4a1a76 75%, 
                #2a0a56 100%);
            background-size: 400% 400%;
            animation: gradientShift 15s ease infinite;
            z-index: 0;
        }

        @keyframes gradientShift {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }

        /* Enhanced cloud floating */
        @keyframes floatCloud {
            0%, 100% {
                transform: translateY(0px) translateX(0px);
            }
            25% {
                transform: translateY(-30px) translateX(15px);
            }
            50% {
                transform: translateY(-20px) translateX(-15px);
            }
            75% {
                transform: translateY(-35px) translateX(10px);
            }
        }

        /* Dynamic light beam */
        .light-beam-dynamic {
            position: absolute;
            top: 50px;
            left: 150px;
            width: 600px;
            height: 400px;
            background: radial-gradient(ellipse at 0% 0%, 
                rgba(255, 236, 119, 0.5) 0%, 
                rgba(255, 236, 119, 0.3) 30%, 
                rgba(255, 236, 119, 0.15) 50%,
                transparent 70%);
            transform: rotate(-15deg);
            transform-origin: top left;
            filter: blur(15px);
            animation: lightBeamPulse 3s ease-in-out infinite;
        }

        @keyframes lightBeamPulse {
            0%, 100% {
                opacity: 1;
                transform: rotate(-15deg) scale(1);
            }
            50% {
                opacity: 0.7;
                transform: rotate(-15deg) scale(1.05);
            }
        }

        /* Enhanced lamp glow */
        .lamp-glow-enhanced {
            position: absolute;
            top: 30px;
            left: 230px;
            width: 100px;
            height: 100px;
            background: radial-gradient(circle, 
                rgba(255, 236, 119, 0.9) 0%, 
                rgba(255, 236, 119, 0.5) 40%, 
                transparent 70%);
            border-radius: 50%;
            filter: blur(12px);
            animation: glowPulseEnhanced 2s ease-in-out infinite;
        }

        @keyframes glowPulseEnhanced {
            0%, 100% {
                opacity: 1;
                transform: scale(1);
            }
            50% {
                opacity: 0.6;
                transform: scale(1.15);
            }
        }

        /* Light particles */
        .light-particles {
            position: absolute;
            top: 50px;
            left: 230px;
            width: 100px;
            height: 100px;
        }

        .particle {
            position: absolute;
            width: 4px;
            height: 4px;
            background: rgba(255, 236, 119, 0.8);
            border-radius: 50%;
            animation: particleFloat 3s ease-in-out infinite;
        }

        .particle:nth-child(1) { left: 20%; animation-delay: 0s; }
        .particle:nth-child(2) { left: 40%; animation-delay: 0.5s; }
        .particle:nth-child(3) { left: 60%; animation-delay: 1s; }
        .particle:nth-child(4) { left: 80%; animation-delay: 1.5s; }
        .particle:nth-child(5) { left: 50%; animation-delay: 2s; }

        @keyframes particleFloat {
            0% {
                transform: translateY(0) scale(1);
                opacity: 1;
            }
            100% {
                transform: translateY(-100px) scale(0);
                opacity: 0;
            }
        }

        /* Gradient text animation */
        .gradient-text-animated {
            background: linear-gradient(135deg, #FFEC77 0%, #FF750F 50%, #FFEC77 100%);
            background-size: 200% 200%;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            filter: drop-shadow(4px 4px 8px rgba(0,0,0,0.3)) drop-shadow(0 0 30px rgba(255,236,119,0.4));
            animation: gradientTextFlow 3s ease infinite;
        }

        @keyframes gradientTextFlow {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }

        /* Sparkles */
        .sparkle {
            position: absolute;
            width: 20px;
            height: 20px;
            background: radial-gradient(circle, #FFEC77, transparent);
            border-radius: 50%;
            animation: sparkleAnimation 2s ease-in-out infinite;
        }

        .sparkle-1 { top: 10%; right: 20%; animation-delay: 0s; }
        .sparkle-2 { top: 30%; right: 5%; animation-delay: 0.7s; }
        .sparkle-3 { bottom: 20%; right: 15%; animation-delay: 1.4s; }

        @keyframes sparkleAnimation {
            0%, 100% {
                opacity: 0;
                transform: scale(0);
            }
            50% {
                opacity: 1;
                transform: scale(1);
            }
        }

        /* Enhanced glass card */
        .glass-info-card-enhanced {
            position: relative;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            border: 2px solid transparent;
            box-shadow: 0 8px 32px rgba(0,0,0,0.2);
            transition: all 0.4s ease;
            overflow: hidden;
        }

        .glass-info-card-enhanced::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            border-radius: 1rem;
            padding: 2px;
            background: linear-gradient(135deg, #FFEC77, #FF750F, #FFEC77);
            background-size: 200% 200%;
            -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor;
            mask-composite: exclude;
            animation: borderFlow 3s linear infinite;
            opacity: 0;
            transition: opacity 0.4s;
        }

        .glass-info-card-enhanced:hover::before {
            opacity: 1;
        }

        @keyframes borderFlow {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }

        /* Animated icon box */
        .icon-box-animated {
            background: linear-gradient(135deg, #FFEC77, #FF750F);
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            animation: iconPulse 2s ease-in-out infinite;
            box-shadow: 0 4px 15px rgba(255, 236, 119, 0.4);
        }

        @keyframes iconPulse {
            0%, 100% {
                transform: scale(1);
                box-shadow: 0 4px 15px rgba(255, 236, 119, 0.4);
            }
            50% {
                transform: scale(1.05);
                box-shadow: 0 6px 25px rgba(255, 236, 119, 0.6);
            }
        }

        /* Animated underline */
        .underline-animation {
            width: 0;
            height: 4px;
            background: linear-gradient(90deg, #FFEC77, #FF750F);
            border-radius: 2px;
            margin-top: 0.5rem;
            animation: underlineGrow 2s ease-in-out forwards;
        }

        @keyframes underlineGrow {
            to { width: 200px; }
        }

        /* Enhanced buttons */
        .btn-enhanced {
            position: relative;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 50px;
            font-weight: 600;
            overflow: hidden;
            text-decoration: none;
            transition: all 0.3s ease;
            border: none;
        }

        .btn-gradient-enhanced {
            background: linear-gradient(135deg, #FFEC77, #FF750F);
            color: #fff;
            box-shadow: 0 8px 24px rgba(255, 117, 15, 0.4);
        }

        .btn-gradient-enhanced:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 32px rgba(255, 117, 15, 0.6);
        }

        .btn-outline-enhanced {
            background: rgba(255, 255, 255, 0.1);
            border: 2px solid #fff;
            color: #fff;
            backdrop-filter: blur(10px);
        }

        .btn-outline-enhanced:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-3px);
        }

        .btn-shine {
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
            animation: shine 3s infinite;
        }

        @keyframes shine {
            0% { left: -100%; }
            100% { left: 200%; }
        }

        /* Floating stars */
        .star-field {
            position: absolute;
            top: 0;
            right: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
        }

        .floating-star {
            position: absolute;
            color: #FFEC77;
            animation: starTwinkle 2s ease-in-out infinite;
        }

        .star-1 {
            top: 20%;
            right: 10%;
            font-size: 20px;
            animation-delay: 0s;
        }

        .star-2 {
            top: 50%;
            right: 5%;
            font-size: 15px;
            animation-delay: 0.5s;
        }

        .star-3 {
            top: 35%;
            right: 25%;
            font-size: 18px;
            animation-delay: 1s;
        }

        .star-4 {
            top: 65%;
            right: 15%;
            font-size: 14px;
            animation-delay: 1.5s;
        }

        @keyframes starTwinkle {
            0%, 100% {
                opacity: 0.3;
                transform: scale(1) rotate(0deg);
            }
            50% {
                opacity: 1;
                transform: scale(1.3) rotate(180deg);
            }
        }

        /* Enhanced mascot effects */
        .mascot-glow-enhanced {
            position: absolute;
            width: 650px;
            height: 650px;
            background: radial-gradient(circle, 
                rgba(255, 236, 119, 0.3) 0%, 
                rgba(255, 117, 15, 0.2) 40%,
                transparent 70%);
            filter: blur(60px);
            z-index: 0;
            left: 50%;
            transform: translateX(-50%);
            animation: glowPulse 4s ease-in-out infinite;
        }

        @keyframes glowPulse {
            0%, 100% {
                transform: translateX(-50%) scale(1);
                opacity: 1;
            }
            50% {
                transform: translateX(-50%) scale(1.1);
                opacity: 0.8;
            }
        }

        /* Ring effect around mascot */
        .mascot-ring-effect {
            position: absolute;
            width: 500px;
            height: 500px;
            border: 3px solid rgba(255, 236, 119, 0.3);
            border-radius: 50%;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            z-index: 1;
            animation: ringPulse 3s ease-in-out infinite;
        }

        @keyframes ringPulse {
            0%, 100% {
                transform: translate(-50%, -50%) scale(1);
                opacity: 0.3;
            }
            50% {
                transform: translate(-50%, -50%) scale(1.15);
                opacity: 0.6;
            }
        }

        /* Enhanced mascot image */
        .mascot-image-enhanced {
            width: 100%;
            height: auto;
            max-width: 550px;
            filter: drop-shadow(0 20px 40px rgba(0,0,0,0.3));
            animation: mascotFloat 6s ease-in-out infinite;
            transition: all 0.3s ease;
        }

        .mascot-wrapper:hover .mascot-image-enhanced {
            transform: scale(1.05);
        }

        @keyframes mascotFloat {
            0%, 100% {
                transform: translateY(0px) rotate(0deg);
            }
            50% {
                transform: translateY(-20px) rotate(2deg);
            }
        }

        /* Orbiting decorations */
        .decoration-orbit {
            position: absolute;
            width: 400px;
            height: 400px;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            animation: orbitRotate 20s linear infinite;
        }

        .orbit-icon {
            position: absolute;
            font-size: 35px;
            color: #FFEC77;
            opacity: 0.7;
        }

        .orbit-1 {
            top: 0;
            left: 50%;
            transform: translateX(-50%);
        }

        .orbit-2 {
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
        }

        .orbit-3 {
            top: 50%;
            right: 0;
            transform: translateY(-50%);
        }

        @keyframes orbitRotate {
            from { transform: translate(-50%, -50%) rotate(0deg); }
            to { transform: translate(-50%, -50%) rotate(360deg); }
        }

        /* Enhanced mascot stars */
        .mascot-stars {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
        }

        .mascot-star {
            position: absolute;
            color: #FFEC77;
            animation: starFloat 3s ease-in-out infinite;
        }

        .mascot-star-1 {
            left: 15%;
            top: 25%;
            font-size: 18px;
            animation-delay: 0s;
        }

        .mascot-star-2 {
            right: 25%;
            top: 10%;
            font-size: 16px;
            animation-delay: 0.5s;
        }

        .mascot-star-3 {
            left: 8%;
            top: 60%;
            font-size: 20px;
            animation-delay: 1s;
        }

        .mascot-star-4 {
            right: 15%;
            top: 70%;
            font-size: 15px;
            animation-delay: 1.5s;
        }

        .mascot-star-5 {
            left: 25%;
            top: 45%;
            font-size: 17px;
            animation-delay: 2s;
        }

        .mascot-star-6 {
            right: 30%;
            top: 85%;
            font-size: 14px;
            animation-delay: 2.5s;
        }

        @keyframes starFloat {
            0%, 100% {
                opacity: 0.4;
                transform: translateY(0) scale(1) rotate(0deg);
            }
            50% {
                opacity: 1;
                transform: translateY(-15px) scale(1.2) rotate(180deg);
            }
        }

        /* Parallax effect */
        .parallax-element {
            transition: transform 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        /* Responsive adjustments */
        @media (max-width: 1200px) {
            .hero-title {
                font-size: 6rem !important;
            }
            .mascot-image-enhanced {
                max-width: 450px !important;
            }
        }

        @media (max-width: 992px) {
            .mascot-container {
                justify-content: center !important;
                margin-top: 3rem;
            }
            .mascot-wrapper {
                margin-left: 0 !important;
            }
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 3.5rem !important;
            }
            .floating-clouds img {
                width: 200px !important;
            }
            .mascot-image-enhanced {
                max-width: 350px !important;
            }
        }
    </style>

    <!-- Parallax scrolling effect -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const parallaxElements = document.querySelectorAll('.parallax-element');
            
            window.addEventListener('scroll', function() {
                const scrolled = window.pageYOffset;
                
                parallaxElements.forEach(element => {
                    const speed = element.dataset.speed || 0.5;
                    const yPos = -(scrolled * speed);
                    element.style.transform = `translateY(${yPos}px)`;
                });
            });
        });
    </script>

    <!-- Rest of your sections remain the same -->
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
                    <h2 class="text-white fw-bold mb-4 display-5 text-shadow-md">Why Join Kanvas?</h2>
                    <p class="text-white-50 fs-4 text-shadow-sm" data-aos="fade-up" data-aos-delay="100">
                        Discover why Kanvas is the perfect place to develop your artistic talents.
                    </p>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="feature-card-enhanced p-4 h-100 text-center">
                        <div class="feature-icon-enhanced mb-3">
                            <i class="bi bi-brush text-warning"></i>
                        </div>
                        <h4 class="text-white mb-3 fs-3 text-shadow-sm">Regular Workshops</h4>
                        <p class="text-white-50 fs-5 text-shadow-sm">
                            Join recurring workshops led by professional artists to enhance your skills.
                        </p>
                    </div>
                </div>

                <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="feature-card-enhanced p-4 h-100 text-center">
                        <div class="feature-icon-enhanced mb-3">
                            <i class="bi bi-people text-warning"></i>
                        </div>
                        <h4 class="text-white mb-3 fs-3 text-shadow-sm">Creative Community</h4>
                        <p class="text-white-50 fs-5 text-shadow-sm">
                            Be part of a passionate and inspiring community of young artists.
                        </p>
                    </div>
                </div>

                <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="feature-card-enhanced p-4 h-100 text-center">
                        <div class="feature-icon-enhanced mb-3">
                            <i class="bi bi-trophy text-warning"></i>
                        </div>
                        <h4 class="text-white mb-3 fs-3 text-shadow-sm">Exhibitions & Competitions</h4>
                        <p class="text-white-50 fs-5 text-shadow-sm">
                            Showcase your work on an international/national scale and participate in competitions.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        /* Enhanced feature cards */
        .feature-card-enhanced {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 1.5rem;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .feature-card-enhanced::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(255, 236, 119, 0.1), rgba(255, 117, 15, 0.1));
            opacity: 0;
            transition: opacity 0.4s;
        }

        .feature-card-enhanced:hover {
            transform: translateY(-10px);
            border-color: rgba(255, 236, 119, 0.5);
            box-shadow: 0 20px 50px rgba(255, 117, 15, 0.3);
        }

        .feature-card-enhanced:hover::before {
            opacity: 1;
        }

        .feature-icon-enhanced {
            width: 80px;
            height: 80px;
            margin: 0 auto;
            background: linear-gradient(135deg, #FFEC77, #FF750F);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            box-shadow: 0 8px 25px rgba(255, 117, 15, 0.4);
            transition: all 0.4s;
        }

        .feature-card-enhanced:hover .feature-icon-enhanced {
            transform: scale(1.1) rotate(5deg);
            box-shadow: 0 12px 35px rgba(255, 117, 15, 0.6);
        }
    </style>

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
                    <div class="glass-card-hover p-4 h-100">
                        <div class="icon-bg-animated mb-3">
                            <i class="bi bi-palette2 text-white fs-4"></i>
                        </div>
                        <h5 class="text-white mb-3 fs-4 text-shadow-sm">Creativity First</h5>
                        <p class="text-white-50 mb-0 fs-5 text-shadow-sm">We celebrate and nurture creative expression across mediums and styles.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="glass-card-hover p-4 h-100">
                        <div class="icon-bg-animated mb-3">
                            <i class="bi bi-people text-white fs-4"></i>
                        </div>
                        <h5 class="text-white mb-3 fs-4 text-shadow-sm">Inclusive Community</h5>
                        <p class="text-white-50 mb-0 fs-5 text-shadow-sm">Welcoming all skill levels, fostering a supportive environment to grow.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="150">
                    <div class="glass-card-hover p-4 h-100">
                        <div class="icon-bg-animated mb-3">
                            <i class="bi bi-trophy text-white fs-4"></i>
                        </div>
                        <h5 class="text-white mb-3 fs-4 text-shadow-sm">Excellence</h5>
                        <p class="text-white-50 mb-0 fs-5 text-shadow-sm">We strive for high standards while embracing experimentation.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="glass-card-hover p-4 h-100">
                        <div class="icon-bg-animated mb-3">
                            <i class="bi bi-heart text-white fs-4"></i>
                        </div>
                        <h5 class="text-white mb-3 fs-4 text-shadow-sm">Passion for Art</h5>
                        <p class="text-white-50 mb-0 fs-5 text-shadow-sm">We share our enthusiasm through workshops, showcases, and collaborations.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="250">
                    <div class="glass-card-hover p-4 h-100">
                        <div class="icon-bg-animated mb-3">
                            <i class="bi bi-lightbulb text-white fs-4"></i>
                        </div>
                        <h5 class="text-white mb-3 fs-4 text-shadow-sm">Innovation</h5>
                        <p class="text-white-50 mb-0 fs-5 text-shadow-sm">We explore new media and techniques to discover unique artistic voices.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="glass-card-hover p-4 h-100">
                        <div class="icon-bg-animated mb-3">
                            <i class="bi bi-bullseye text-white fs-4"></i>
                        </div>
                        <h5 class="text-white mb-3 fs-4 text-shadow-sm">Goal-Oriented</h5>
                        <p class="text-white-50 mb-0 fs-5 text-shadow-sm">We set clear goals for growth, events, and meaningful achievements.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .glass-card-hover {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 1rem;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .glass-card-hover::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 236, 119, 0.1), transparent);
            transition: left 0.5s;
        }

        .glass-card-hover:hover {
            transform: translateY(-5px);
            border-color: rgba(255, 236, 119, 0.3);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
        }

        .glass-card-hover:hover::after {
            left: 100%;
        }

        .icon-bg-animated {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, rgba(255, 236, 119, 0.3), rgba(255, 117, 15, 0.3));
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
        }

        .glass-card-hover:hover .icon-bg-animated {
            background: linear-gradient(135deg, #FFEC77, #FF750F);
            transform: rotate(10deg) scale(1.1);
        }
    </style>

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
                <div class="guideline-card-enhanced p-4" data-aos="fade-up" data-aos-delay="50">
                    <div class="d-flex align-items-start gap-3">
                        <div class="guideline-num-enhanced">01</div>
                        <div>
                            <h5 class="text-white mb-2 fs-4 text-shadow-sm">Respect & Support</h5>
                            <p class="text-white-50 mb-0 fs-5 text-shadow-sm">Treat all members with respect and provide constructive feedback.</p>
                        </div>
                    </div>
                </div>
                <div class="guideline-card-enhanced p-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="d-flex align-items-start gap-3">
                        <div class="guideline-num-enhanced">02</div>
                        <div>
                            <h5 class="text-white mb-2 fs-4 text-shadow-sm">Active Participation</h5>
                            <p class="text-white-50 mb-0 fs-5 text-shadow-sm">Aim to attend club activities and events regularly.</p>
                        </div>
                    </div>
                </div>
                <div class="guideline-card-enhanced p-4" data-aos="fade-up" data-aos-delay="150">
                    <div class="d-flex align-items-start gap-3">
                        <div class="guideline-num-enhanced">03</div>
                        <div>
                            <h5 class="text-white mb-2 fs-4 text-shadow-sm">Original Work</h5>
                            <p class="text-white-50 mb-0 fs-5 text-shadow-sm">All submitted artworks must be original creations.</p>
                        </div>
                    </div>
                </div>
                <div class="guideline-card-enhanced p-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="d-flex align-items-start gap-3">
                        <div class="guideline-num-enhanced">04</div>
                        <div>
                            <h5 class="text-white mb-2 fs-4 text-shadow-sm">Studio Care</h5>
                            <p class="text-white-50 mb-0 fs-5 text-shadow-sm">Keep the studio clean and return all materials after use.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .guideline-card-enhanced {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 1rem;
            transition: all 0.3s ease;
            position: relative;
        }

        .guideline-card-enhanced::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 4px;
            background: linear-gradient(180deg, #FFEC77, #FF750F);
            border-radius: 1rem 0 0 1rem;
            transform: scaleY(0);
            transition: transform 0.3s ease;
        }

        .guideline-card-enhanced:hover {
            transform: translateX(10px);
            border-color: rgba(255, 236, 119, 0.3);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }

        .guideline-card-enhanced:hover::before {
            transform: scaleY(1);
        }

        .guideline-num-enhanced {
            font-size: 2.5rem;
            font-weight: 700;
            background: linear-gradient(135deg, #FFEC77, #FF750F);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            min-width: 80px;
            text-align: center;
        }
    </style>

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
            <div class="mission-card-enhanced p-5" data-aos="zoom-in">
                <div class="mission-decoration"></div>
                <h2 class="text-center text-white fw-bold mb-4 display-5 text-shadow-md">Our Mission</h2>
                <p class="text-center text-white-50 mb-0 fs-4 text-shadow-sm">To create an inclusive platform where students can explore, develop, and showcase their artistic talents while fostering a supportive community that celebrates creativity, innovation, and excellence.</p>
            </div>
        </div>
    </section>

    <style>
        .mission-card-enhanced {
            position: relative;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            border: 2px solid rgba(255, 236, 119, 0.3);
            border-radius: 2rem;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            overflow: hidden;
        }

        .mission-decoration {
            position: absolute;
            top: -50%;
            right: -10%;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(255, 236, 119, 0.2), transparent);
            border-radius: 50%;
            animation: decorationFloat 8s ease-in-out infinite;
        }

        @keyframes decorationFloat {
            0%, 100% {
                transform: translate(0, 0) scale(1);
            }
            50% {
                transform: translate(-50px, 50px) scale(1.1);
            }
        }
    </style>

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
                    <p class="text-white-50 mb-0 fs-4 text-shadow-sm" data-aos="fade-up" data-aos-delay="100">Ikuti kegiatan Kanvas terbaru dan tingkatkan jaringan kreatifmu</p>
                </div>
                <div class="col-auto">
                    <a href="{{ route('events') }}" class="btn btn-outline-light">Lihat Semua</a>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="event-card-enhanced border-0 h-100">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center mb-3">
                                <span class="badge-enhanced bg-warning text-dark me-2">Workshop</span>
                                <small class="text-white-50 event-badge text-shadow-sm">Sab, 26 Okt</small>
                            </div>
                            <h5 class="card-title text-white fs-3 text-shadow-sm">Dasar Ilustrasi Digital</h5>
                            <p class="card-text text-white-50 fs-5 text-shadow-sm">Belajar workflow ilustrasi dari sketsa hingga final render.</p>
                            <a href="{{ route('events') }}" class="link-enhanced">Detail event →</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="event-card-enhanced border-0 h-100">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center mb-3">
                                <span class="badge-enhanced bg-warning text-dark me-2">Talkshow</span>
                                <small class="text-white-50 event-badge text-shadow-sm">Min, 3 Nov</small>
                            </div>
                            <h5 class="card-title text-white fs-3 text-shadow-sm">Career in Creative Industry</h5>
                            <p class="card-text text-white-50 fs-5 text-shadow-sm">Ngobrol bareng praktisi industri desain dan ilustrasi.</p>
                            <a href="{{ route('events') }}" class="link-enhanced">Detail event →</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="event-card-enhanced border-0 h-100">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center mb-3">
                                <span class="badge-enhanced bg-warning text-dark me-2">Exhibition</span>
                                <small class="text-white-50 event-badge text-shadow-sm">Sab, 16 Nov</small>
                            </div>
                            <h5 class="card-title text-white fs-3 text-shadow-sm">Kanvas Art Showcase</h5>
                            <p class="card-text text-white-50 fs-5 text-shadow-sm">Pameran karya anggota Kanvas terbaik bulan ini.</p>
                            <a href="{{ route('events') }}" class="link-enhanced">Detail event →</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .event-card-enhanced {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 1.5rem;
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
        }

        .event-card-enhanced::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #FFEC77, #FF750F);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.4s ease;
        }

        .event-card-enhanced:hover {
            transform: translateY(-8px);
            border-color: rgba(255, 236, 119, 0.4);
            box-shadow: 0 15px 45px rgba(255, 117, 15, 0.3);
        }

        .event-card-enhanced:hover::before {
            transform: scaleX(1);
        }

        .badge-enhanced {
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.85rem;
        }

        .link-enhanced {
            color: #FFEC77;
            text-decoration: none;
            font-weight: 600;
            font-size: 1.1rem;
            position: relative;
            display: inline-block;
            transition: all 0.3s ease;
        }

        .link-enhanced::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, #FFEC77, #FF750F);
            transition: width 0.3s ease;
        }

        .link-enhanced:hover {
            color: #FF750F;
            transform: translateX(5px);
        }

        .link-enhanced:hover::after {
            width: 100%;
        }
    </style>

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
                    <p class="text-white-50 mb-0 fs-4 text-shadow-sm" data-aos="fade-up" data-aos-delay="100">Karya terbaru dari anggota Kanvas</p>
                </div>
                <a href="{{ route('art_gallery') }}" class="btn btn-outline-light">Lihat Galeri</a>
            </div>

            <div class="row g-4">
                @forelse($featuredArtworks->take(4) as $index => $artwork)
                    <div class="col-6 col-md-3" data-aos="zoom-in" data-aos-delay="{{ ($index + 1) * 50 }}">
                        <div class="artwork-card-enhanced" style="cursor: pointer; position: relative;">
                            <div class="artwork-image-container-enhanced">
                                <img src="{{ asset($artwork->image_path) }}" alt="{{ $artwork->title }}" class="artwork-image-enhanced">
                                <div class="artwork-overlay-enhanced">
                                    <div class="artwork-info-enhanced">
                                        <h6 class="text-white fw-bold mb-1">{{ $artwork->title }}</h6>
                                        <p class="text-white-50 small mb-0">By: {{ $artwork->artist_name }}</p>
                                        <button class="btn btn-sm btn-gradient mt-2" onclick="togglePopupHome(event, {{ $artwork->id }})">
                                            <i class="bi bi-eye me-1"></i>View Details
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Compact Popup -->
                            <div class="artwork-popup-home" id="popup-home-{{ $artwork->id }}">
                                <div class="popup-header">
                                    <h6 class="text-white mb-0 fw-bold">{{ $artwork->title }}</h6>
                                    <button type="button" class="popup-close" onclick="closePopupHome({{ $artwork->id }})">
                                        <i class="bi bi-x-lg"></i>
                                    </button>
                                </div>
                                <div class="popup-body">
                                    <div class="popup-item">
                                        <i class="bi bi-person-fill text-warning"></i>
                                        <div>
                                            <small class="text-white-50 d-block">Artist</small>
                                            <strong class="text-white">{{ $artwork->artist_name }}</strong>
                                        </div>
                                    </div>
                                    <div class="popup-item">
                                        <i class="bi bi-tag-fill text-warning"></i>
                                        <div>
                                            <small class="text-white-50 d-block">Category</small>
                                            <strong class="text-white">{{ $artwork->category->name }}</strong>
                                        </div>
                                    </div>
                                    <div class="popup-item">
                                        <i class="bi bi-calendar-fill text-warning"></i>
                                        <div>
                                            <small class="text-white-50 d-block">Created</small>
                                            <strong class="text-white">{{ $artwork->created_date->format('M d, Y') }}</strong>
                                        </div>
                                    </div>
                                    @if ($artwork->description)
                                        <div class="popup-item">
                                            <i class="bi bi-file-text-fill text-warning"></i>
                                            <div>
                                                <small class="text-white-50 d-block">Description</small>
                                                <p class="text-white mb-0 popup-description">{{ Str::limit($artwork->description, 150) }}</p>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection