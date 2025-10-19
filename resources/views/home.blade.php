@extends('layouts.app')

@section('title', 'Home - UKM Kanvas')

@section('content')
    <div class="hero-wrapper position-relative overflow-hidden">
        <!-- Background cityscape -->
        <div class="cityscape-bg position-absolute w-100" style="bottom: 0; z-index: 1;">
            <img src="{{ asset('images/buildings_blue.png') }}" alt="City Background" class="w-100" style="opacity: 0.4;">
        </div>

        <!-- Decorative clouds - Enhanced -->
        <div class="floating-clouds position-absolute w-100" style="top: 5%; z-index: 2; pointer-events: none;">
            <img src="{{ asset('images/cloud1.png') }}" alt="" class="cloud cloud-1"
                style="position: absolute; left: 5%; width: 450px; opacity: 0.8; animation: float 20s ease-in-out infinite; filter: drop-shadow(0 10px 20px rgba(0,0,0,0.15));">
            <img src="{{ asset('images/cloud2.png') }}" alt="" class="cloud cloud-2"
                style="position: absolute; right: 8%; width: 400px; opacity: 0.75; animation: float 25s ease-in-out infinite reverse; filter: drop-shadow(0 10px 20px rgba(0,0,0,0.15));">
            <img src="{{ asset('images/cloud3.png') }}" alt="" class="cloud cloud-3"
                style="position: absolute; left: 35%; top: 25%; width: 350px; opacity: 0.7; animation: float 30s ease-in-out infinite; filter: drop-shadow(0 10px 20px rgba(0,0,0,0.15));">
            <img src="{{ asset('images/cloud4.png') }}" alt="" class="cloud cloud-4"
                style="position: absolute; right: 30%; top: 40%; width: 300px; opacity: 0.65; animation: float 28s ease-in-out infinite 2s; filter: drop-shadow(0 10px 20px rgba(0,0,0,0.15));">
            <img src="{{ asset('images/cloud5.png') }}" alt="" class="cloud cloud-5"
                style="position: absolute; left: 20%; top: 50%; width: 280px; opacity: 0.6; animation: float 32s ease-in-out infinite 1s; filter: drop-shadow(0 10px 20px rgba(0,0,0,0.15));">
        </div>

        <!-- Decorative hills/mountains at bottom -->
        <div class="hills-bg position-absolute w-100" style="bottom: 0; z-index: 3;">
            <img src="{{ asset('images/buildings_purple.png') }}" alt="" class="w-100" style="opacity: 0.5;">
        </div>

        <div class="container-fluid px-5 min-vh-100 d-flex align-items-center hero-section position-relative"
            style="z-index: 4;">
            <div class="center-me w-100">
                <div class="row align-items-center justify-content-center g-0">
                    <!-- Left Content Section -->
                    <div class="col-lg-6 col-12 position-relative pe-0" data-aos="fade-right" data-aos-duration="1000">
                        <!-- Enhanced Street Lamp with Light Beam -->
                        <div class="streetlamp-container position-absolute"
                            style="left: -150px; top: -100px; width: 300px; height: 600px; z-index: 5;">
                            <!-- Light beam emanating from lamp -->
                            <div class="light-beam position-absolute"
                                style="
                            top: 50px; 
                            left: 150px; 
                            width: 600px; 
                            height: 400px; 
                            background: radial-gradient(ellipse at 0% 0%, 
                                rgba(255, 236, 119, 0.4) 0%, 
                                rgba(255, 236, 119, 0.25) 30%, 
                                rgba(255, 236, 119, 0.1) 50%,
                                transparent 70%);
                            transform: rotate(-15deg);
                            transform-origin: top left;
                            filter: blur(15px);
                            animation: lightPulse 3s ease-in-out infinite;
                            pointer-events: none;
                        ">
                            </div>

                            <!-- Light glow at lamp head -->
                            <div class="lamp-glow position-absolute"
                                style="
                            top: 30px;
                            left: 230px;
                            width: 80px;
                            height: 80px;
                            background: radial-gradient(circle, 
                                rgba(255, 236, 119, 0.8) 0%, 
                                rgba(255, 236, 119, 0.4) 40%, 
                                transparent 70%);
                            border-radius: 50%;
                            filter: blur(10px);
                            animation: glowPulse 2s ease-in-out infinite;
                        ">
                            </div>

                            {{-- <!-- Actual streetlamp image -->
                            <img src="{{ asset('images/streetlamp.png') }}" alt="" class="streetlamp"
                                style="
                            width: 280px; 
                            height: auto; 
                            position: relative;
                            z-index: 6;
                            filter: drop-shadow(0 15px 25px rgba(0,0,0,0.3));
                        "> --}}
                        </div>

                        <!-- Title with enhanced styling and lighting effect -->
                        <div class="title-container position-relative mb-4" style="z-index: 10;">
                            <!-- Light overlay on text -->
                            <div class="text-light-overlay position-absolute"
                                style="
                            top: 0;
                            left: 0;
                            width: 100%;
                            height: 100%;
                            background: radial-gradient(ellipse at 20% 30%, 
                                rgba(255, 236, 119, 0.2) 0%, 
                                transparent 50%);
                            pointer-events: none;
                            z-index: 1;
                        ">
                            </div>

                            <h1 class="text-start text-white fw-bold hero-title display-1 mb-0 position-relative"
                                style="
                            font-size: 8rem; 
                            text-shadow: 
                                4px 4px 8px rgba(0,0,0,0.4), 
                                0 0 60px rgba(255,236,119,0.3),
                                -2px -2px 10px rgba(255,236,119,0.2);
                            letter-spacing: 0.05em;
                            line-height: 1.1;
                            z-index: 2;
                        ">
                                WELCOME
                            </h1>
                            <h1 class="text-start fw-bold hero-title display-1 position-relative"
                                style="
                            font-size: 8rem;
                            background: linear-gradient(135deg, #FFEC77 0%, #FF750F 100%); 
                            -webkit-background-clip: text; 
                            -webkit-text-fill-color: transparent; 
                            margin-top: -10px;
                            letter-spacing: 0.05em;
                            line-height: 1.1;
                            filter: drop-shadow(4px 4px 8px rgba(0,0,0,0.3)) drop-shadow(0 0 30px rgba(255,236,119,0.4));
                            z-index: 2;
                        ">
                                PEEPS
                            </h1>
                        </div>

                        <!-- Description Section with enhanced card -->
                        <div class="glass-info-card p-4 rounded-4 mb-4"
                            style="background: rgba(255, 255, 255, 0.15); backdrop-filter: blur(20px); border: 2px solid rgba(255, 255, 255, 0.3); box-shadow: 0 8px 32px rgba(0,0,0,0.2);">
                            <div class="d-flex align-items-center mb-3">
                                <div class="icon-box me-3"
                                    style="background: linear-gradient(135deg, #FFEC77, #FF750F); width: 50px; height: 50px; border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                                    <i class="bi bi-palette-fill text-white fs-4"></i>
                                </div>
                                <h3 class="text-white mb-0 fs-3 fw-bold">Apa itu Kanvas?</h3>
                            </div>

                            <p class="text-white fs-5 lh-lg mb-0" style="text-shadow: 1px 1px 3px rgba(0,0,0,0.3);">
                                Kanvas is a Unit Kegiatan Mahasiswa﻿ (Student Activity Unit) dedicated to nurturing artistic
                                creativity and design. We are a home for young artists eager to express themselves through
                                various art mediums.
                            </p>
                        </div>

                        <!-- Slogan with decorative elements -->
                        <div class="slogan-container position-relative mt-5 pt-3 mb-4">
                            <div class="quote-mark position-absolute"
                                style="left: -30px; top: -20px; font-size: 80px; color: rgba(255,236,119,0.3); font-family: Georgia, serif;">
                                "</div>
                            <h2 class="text-white text-start fw-bold slogan-text fs-2 fst-italic"
                                style="text-shadow: 2px 2px 4px rgba(0,0,0,0.4);">
                                Express. Create. Inspire.
                            </h2>
                            <div class="underline-decoration mt-2"
                                style="width: 200px; height: 4px; background: linear-gradient(90deg, #FFEC77, transparent); border-radius: 2px;">
                            </div>
                        </div>

                        <!-- Enhanced CTA Buttons -->
                        <div class="mt-5 d-flex gap-3 flex-wrap">
                            <a href="{{ route('events') }}"
                                class="btn btn-gradient btn-lg px-5 py-3 position-relative overflow-hidden"
                                style="box-shadow: 0 8px 24px rgba(255,236,119,0.4); border-radius: 50px; font-weight: 600;">
                                <span class="position-relative" style="z-index: 2;">
                                    <i class="bi bi-calendar-event me-2"></i>View Events
                                </span>
                                <span class="button-shine position-absolute"
                                    style="top: 0; left: -100%; width: 100%; height: 100%; background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent); animation: shine 3s infinite;"></span>
                            </a>
                            <a href="{{ route('art_gallery') }}" class="btn btn-outline-light btn-lg px-5 py-3"
                                style="border-width: 2px; border-radius: 50px; font-weight: 600; backdrop-filter: blur(10px); background: rgba(255,255,255,0.1); box-shadow: 0 4px 16px rgba(0,0,0,0.2);">
                                <i class="bi bi-palette me-2"></i>Art Gallery
                            </a>
                        </div>

                        <!-- Floating decorative elements -->
                        <div class="floating-stars position-absolute" style="right: 10%; top: 20%;">
                            <i class="bi bi-star-fill text-warning"
                                style="font-size: 20px; opacity: 0.7; animation: twinkle 2s ease-in-out infinite;"></i>
                        </div>
                        <div class="floating-stars position-absolute" style="right: 5%; top: 50%;">
                            <i class="bi bi-star-fill text-warning"
                                style="font-size: 15px; opacity: 0.5; animation: twinkle 3s ease-in-out infinite 0.5s;"></i>
                        </div>
                    </div>

                    <!-- Right Image Section with enhanced presentation -->
                    <div class="col-lg-5 col-12 d-flex justify-content-start align-items-center mascot-container position-relative ps-lg-0"
                        data-aos="fade-left" data-aos-duration="1000" data-aos-delay="200">

                        <!-- Glow effect behind mascot -->
                        <div class="mascot-glow position-absolute"
                            style="width: 600px; height: 600px; background: radial-gradient(circle, rgba(255,236,119,0.25) 0%, transparent 70%); filter: blur(50px); z-index: 0; left: 50%; transform: translateX(-50%);">
                        </div>

                        <!-- Main mascot -->
                        <div class="mascot-wrapper position-relative" style="z-index: 1; margin-left: 0;">
                            <img src="{{ asset('images/mascot.png') }}?v=2" alt="Kanvas Mascot" class="mascot-image"
                                style="width: 135%; height: 135%; max-width: 800px; filter: drop-shadow(0 20px 40px rgba(0,0,0,0.3)); animation: float 6s ease-in-out infinite;">
                        </div>
                        

                        <!-- Decorative elements around mascot -->
                        <div class="position-absolute" style="bottom: 10%; left: 5%; z-index: 1;">
                            <i class="bi bi-brush-fill text-warning"
                                style="font-size: 40px; opacity: 0.6; animation: rotate 10s linear infinite;"></i>
                        </div>
                        <div class="position-absolute" style="top: 15%; right: 10%; z-index: 1;">
                            <i class="bi bi-palette2 text-warning"
                                style="font-size: 35px; opacity: 0.6; animation: rotate 12s linear infinite reverse;"></i>
                        </div>

                        <!-- More stars around mascot -->
                        <div class="floating-stars position-absolute" style="left: 15%; top: 25%;">
                            <i class="bi bi-star-fill text-warning"
                                style="font-size: 16px; opacity: 0.7; animation: twinkle 2.6s ease-in-out infinite 0.8s;"></i>
                        </div>
                        <div class="floating-stars position-absolute" style="right: 25%; top: 10%;">
                            <i class="bi bi-star-fill text-warning"
                                style="font-size: 14px; opacity: 0.6; animation: twinkle 3.1s ease-in-out infinite 1.2s;"></i>
                        </div>
                        <div class="floating-stars position-absolute" style="left: 8%; top: 60%;">
                            <i class="bi bi-star-fill text-warning"
                                style="font-size: 18px; opacity: 0.75; animation: twinkle 2.4s ease-in-out infinite 0.5s;"></i>
                        </div>
                        <div class="floating-stars position-absolute" style="right: 15%; top: 70%;">
                            <i class="bi bi-star-fill text-warning"
                                style="font-size: 13px; opacity: 0.65; animation: twinkle 2.9s ease-in-out infinite 1.5s;"></i>
                        </div>
                        <div class="floating-stars position-absolute" style="left: 25%; top: 45%;">
                            <i class="bi bi-star-fill text-warning"
                                style="font-size: 15px; opacity: 0.7; animation: twinkle 2.7s ease-in-out infinite 1s;"></i>
                        </div>
                        <div class="floating-stars position-absolute" style="right: 30%; top: 85%;">
                            <i class="bi bi-star-fill text-warning"
                                style="font-size: 12px; opacity: 0.6; animation: twinkle 3.2s ease-in-out infinite 0.3s;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Enhanced animations */
        @keyframes float {

            0%,
            100% {
                transform: translateY(0px) translateX(0px);
            }

            33% {
                transform: translateY(-25px) translateX(10px);
            }

            66% {
                transform: translateY(-15px) translateX(-10px);
            }
        }

        @keyframes lightPulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.7;
            }
        }

        @keyframes glowPulse {

            0%,
            100% {
                opacity: 1;
                transform: scale(1);
            }

            50% {
                opacity: 0.6;
                transform: scale(1.1);
            }
        }

        @keyframes twinkle {

            0%,
            100% {
                opacity: 0.3;
                transform: scale(1);
            }

            50% {
                opacity: 1;
                transform: scale(1.2);
            }
        }

        @keyframes rotate {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        @keyframes shine {
            0% {
                left: -100%;
            }

            100% {
                left: 200%;
            }
        }

        /* Cloud floating animation with depth */
        .cloud {
            filter: drop-shadow(0 8px 16px rgba(0, 0, 0, 0.2));
            will-change: transform;
        }

        .cloud-1 {
            animation-duration: 20s !important;
        }

        .cloud-2 {
            animation-duration: 25s !important;
        }

        .cloud-3 {
            animation-duration: 30s !important;
        }

        .cloud-4 {
            animation-duration: 28s !important;
        }

        .cloud-5 {
            animation-duration: 32s !important;
        }

        /* Responsive adjustments */
        @media (max-width: 1200px) {
            .hero-title {
                font-size: 6rem !important;
            }

            .mascot-image {
                max-width: 450px !important;
            }

            .mascot-wrapper {
                margin-left: 0 !important;
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

            .glass-info-card {
                margin-top: 2rem;
            }

            .floating-clouds img {
                width: 200px !important;
            }

            .mascot-wrapper {
                margin-top: 2rem;
            }

            .mascot-image {
                max-width: 350px !important;
            }
        }

        /* Button hover effects */
        .btn-gradient {
            transition: all 0.3s ease;
        }

        .btn-gradient:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 32px rgba(255, 236, 119, 0.6) !important;
        }

        .btn-outline-light:hover {
            transform: translateY(-3px);
            background: rgba(255, 255, 255, 0.2) !important;
        }

        /* Glass card hover effect */
        .glass-info-card {
            transition: all 0.3s ease;
        }

        .glass-info-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 48px rgba(0, 0, 0, 0.3);
        }
    </style>

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
    <section id="features" class="features-section py-5 position-relative">
        <!-- Floating clouds for Features Section -->
        <div class="floating-clouds position-absolute w-100" style="top: 0; left: 0; right: 0; bottom: 0; z-index: 1; pointer-events: none; overflow: hidden;">
            <img src="{{ asset('images/cloud1.png') }}" alt="" class="cloud"
                style="position: absolute; left: 10%; top: 15%; width: 300px; opacity: 0.6; animation: float 22s ease-in-out infinite;">
            <img src="{{ asset('images/cloud3.png') }}" alt="" class="cloud"
                style="position: absolute; right: 5%; top: 40%; width: 250px; opacity: 0.5; animation: float 26s ease-in-out infinite reverse;">
            <img src="{{ asset('images/cloud5.png') }}" alt="" class="cloud"
                style="position: absolute; left: 60%; top: 70%; width: 200px; opacity: 0.4; animation: float 28s ease-in-out infinite 1s;">
        </div>
        <div class="container position-relative" style="z-index: 2;">
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
                    <div class="feature-card p-4 h-100 text-center">
                        <div class="feature-icon mb-3">
                            <i class="bi bi-brush text-warning"></i>
                        </div>
                        <h4 class="text-white mb-3 fs-3 text-shadow-sm">Regular Workshops</h4>
                        <p class="text-white-50 fs-5 text-shadow-sm">
                            Join recurring workshops led by professional artists to enhance your skills.
                        </p>
                    </div>
                </div>

                <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="feature-card p-4 h-100 text-center">
                        <div class="feature-icon mb-3">
                            <i class="bi bi-people text-warning"></i>
                        </div>
                        <h4 class="text-white mb-3 fs-3 text-shadow-sm">Creative Community</h4>
                        <p class="text-white-50 fs-5 text-shadow-sm">
                            Be part of a passionate and inspiring community of young artists.
                        </p>
                    </div>
                </div>

                <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="feature-card p-4 h-100 text-center">
                        <div class="feature-icon mb-3">
                            <i class="bi bi-trophy text-warning"></i>
                        </div>
                        <h4 class="text-white mb-3 fs-3 text-shadow-sm">Exhibitions & Competitions</h4>
                        <p class="text-white-50 fs-5 text-shadow-sm">
                            Showcase your work on an international/national scale and participate in national to
                            international-level competitions.
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
    <section class="py-5 position-relative">
        <!-- Floating clouds for Values Section -->
        <div class="floating-clouds position-absolute w-100" style="top: 0; left: 0; right: 0; bottom: 0; z-index: 1; pointer-events: none; overflow: hidden;">
            <img src="{{ asset('images/cloud2.png') }}" alt="" class="cloud"
                style="position: absolute; right: 15%; top: 10%; width: 350px; opacity: 0.5; animation: float 24s ease-in-out infinite;">
            <img src="{{ asset('images/cloud4.png') }}" alt="" class="cloud"
                style="position: absolute; left: 8%; top: 50%; width: 280px; opacity: 0.45; animation: float 30s ease-in-out infinite reverse;">
            <img src="{{ asset('images/cloud1.png') }}" alt="" class="cloud"
                style="position: absolute; right: 40%; top: 75%; width: 220px; opacity: 0.4; animation: float 27s ease-in-out infinite 2s;">
        </div>
        <div class="container position-relative" style="z-index: 2;">
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
                        <p class="text-white-50 mb-0 fs-5 text-shadow-sm">We celebrate and nurture creative expression
                            across mediums and
                            styles.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="glass-card p-4 h-100">
                        <div class="icon-bg mb-3">
                            <i class="bi bi-people text-white fs-4"></i>
                        </div>
                        <h5 class="text-white mb-3 fs-4 text-shadow-sm">Inclusive Community</h5>
                        <p class="text-white-50 mb-0 fs-5 text-shadow-sm">Welcoming all skill levels, fostering a
                            supportive environment to
                            grow.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="150">
                    <div class="glass-card p-4 h-100">
                        <div class="icon-bg mb-3">
                            <i class="bi bi-trophy text-white fs-4"></i>
                        </div>
                        <h5 class="text-white mb-3 fs-4 text-shadow-sm">Excellence</h5>
                        <p class="text-white-50 mb-0 fs-5 text-shadow-sm">We strive for high standards while embracing
                            experimentation.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="glass-card p-4 h-100">
                        <div class="icon-bg mb-3">
                            <i class="bi bi-heart text-white fs-4"></i>
                        </div>
                        <h5 class="text-white mb-3 fs-4 text-shadow-sm">Passion for Art</h5>
                        <p class="text-white-50 mb-0 fs-5 text-shadow-sm">We share our enthusiasm through workshops,
                            showcases, and
                            collaborations.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="250">
                    <div class="glass-card p-4 h-100">
                        <div class="icon-bg mb-3">
                            <i class="bi bi-lightbulb text-white fs-4"></i>
                        </div>
                        <h5 class="text-white mb-3 fs-4 text-shadow-sm">Innovation</h5>
                        <p class="text-white-50 mb-0 fs-5 text-shadow-sm">We explore new media and techniques to discover
                            unique artistic
                            voices.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="glass-card p-4 h-100">
                        <div class="icon-bg mb-3">
                            <i class="bi bi-bullseye text-white fs-4"></i>
                        </div>
                        <h5 class="text-white mb-3 fs-4 text-shadow-sm">Goal-Oriented</h5>
                        <p class="text-white-50 mb-0 fs-5 text-shadow-sm">We set clear goals for growth, events, and
                            meaningful achievements.
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
    <section class="py-5 position-relative">
        <!-- Floating clouds for Guidelines Section -->
        <div class="floating-clouds position-absolute w-100" style="top: 0; left: 0; right: 0; bottom: 0; z-index: 1; pointer-events: none; overflow: hidden;">
            <img src="{{ asset('images/cloud5.png') }}" alt="" class="cloud"
                style="position: absolute; left: 5%; top: 20%; width: 260px; opacity: 0.5; animation: float 25s ease-in-out infinite;">
            <img src="{{ asset('images/cloud3.png') }}" alt="" class="cloud"
                style="position: absolute; right: 10%; top: 60%; width: 300px; opacity: 0.45; animation: float 29s ease-in-out infinite reverse;">
        </div>
        <div class="container position-relative" style="z-index: 2;">
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
                            <p class="text-white-50 mb-0 fs-5 text-shadow-sm">Treat all members with respect and provide
                                constructive feedback.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="glass-card p-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="d-flex align-items-start gap-3">
                        <div class="guideline-num fs-5">02</div>
                        <div>
                            <h5 class="text-white mb-2 fs-4 text-shadow-sm">Active Participation</h5>
                            <p class="text-white-50 mb-0 fs-5 text-shadow-sm">Aim to attend club activities and events
                                regularly.</p>
                        </div>
                    </div>
                </div>
                <div class="glass-card p-4" data-aos="fade-up" data-aos-delay="150">
                    <div class="d-flex align-items-start gap-3">
                        <div class="guideline-num fs-5">03</div>
                        <div>
                            <h5 class="text-white mb-2 fs-4 text-shadow-sm">Original Work</h5>
                            <p class="text-white-50 mb-0 fs-5 text-shadow-sm">All submitted artworks must be original
                                creations.</p>
                        </div>
                    </div>
                </div>
                <div class="glass-card p-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="d-flex align-items-start gap-3">
                        <div class="guideline-num fs-5">04</div>
                        <div>
                            <h5 class="text-white mb-2 fs-4 text-shadow-sm">Studio Care</h5>
                            <p class="text-white-50 mb-0 fs-5 text-shadow-sm">Keep the studio clean and return all
                                materials after use.</p>
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
    <section class="py-5 position-relative">
        <!-- Floating clouds for Mission Section -->
        <div class="floating-clouds position-absolute w-100" style="top: 0; left: 0; right: 0; bottom: 0; z-index: 1; pointer-events: none; overflow: hidden;">
            <img src="{{ asset('images/cloud2.png') }}" alt="" class="cloud"
                style="position: absolute; left: 20%; top: 25%; width: 320px; opacity: 0.55; animation: float 23s ease-in-out infinite;">
            <img src="{{ asset('images/cloud4.png') }}" alt="" class="cloud"
                style="position: absolute; right: 25%; top: 50%; width: 240px; opacity: 0.5; animation: float 31s ease-in-out infinite reverse;">
        </div>
        <div class="container position-relative" style="z-index: 2;">
            <div class="glass-card p-5" data-aos="zoom-in">
                <h2 class="text-center text-white fw-bold mb-4 display-5 text-shadow-md">Our Mission</h2>
                <p class="text-center text-white-50 mb-0 fs-4 text-shadow-sm">To create an inclusive platform where
                    students can explore,
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
    <section id="events" class="py-5 position-relative">
        <!-- Floating clouds for Events Section -->
        <div class="floating-clouds position-absolute w-100" style="top: 0; left: 0; right: 0; bottom: 0; z-index: 1; pointer-events: none; overflow: hidden;">
            <img src="{{ asset('images/cloud1.png') }}" alt="" class="cloud"
                style="position: absolute; right: 12%; top: 8%; width: 290px; opacity: 0.6; animation: float 26s ease-in-out infinite;">
            <img src="{{ asset('images/cloud3.png') }}" alt="" class="cloud"
                style="position: absolute; left: 15%; top: 35%; width: 260px; opacity: 0.5; animation: float 28s ease-in-out infinite reverse;">
            <img src="{{ asset('images/cloud5.png') }}" alt="" class="cloud"
                style="position: absolute; right: 35%; top: 70%; width: 230px; opacity: 0.45; animation: float 24s ease-in-out infinite 1.5s;">
        </div>
        <div class="container position-relative" style="z-index: 2;">
            <div class="row align-items-end mb-4">
                <div class="col">
                    <h2 class="text-white fw-bold display-5 text-shadow-md" data-aos="fade-up">Upcoming Events</h2>
                    <p class="text-white-50 mb-0 fs-4 text-shadow-sm" data-aos="fade-up" data-aos-delay="100">Ikuti
                        kegiatan Kanvas terbaru dan
                        tingkatkan jaringan kreatifmu</p>
                </div>
                <div class="col-auto">
                    <a href="{{ route('events') }}" class="btn btn-outline-light">Lihat Semua</a>
                </div>
            </div>

            <div class="row g-4">
                @forelse($upcomingEvents as $index => $event)
                    <div class="col-md-4" data-aos="fade-up" data-aos-delay="{{ 100 + ($index * 100) }}">
                        <x-event-card :event="$event" layout="home" />
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <i class="bi bi-calendar-x display-3 text-white-50 mb-3"></i>
                        <p class="text-white-50 fs-5">No upcoming events at the moment. Check back soon!</p>
                    </div>
                @endforelse
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
    <section id="gallery" class="py-5 position-relative">
        <!-- Floating clouds for Gallery Section -->
        <div class="floating-clouds position-absolute w-100" style="top: 0; left: 0; right: 0; bottom: 0; z-index: 1; pointer-events: none; overflow: hidden;">
            <img src="{{ asset('images/cloud4.png') }}" alt="" class="cloud"
                style="position: absolute; left: 8%; top: 12%; width: 310px; opacity: 0.55; animation: float 27s ease-in-out infinite;">
            <img src="{{ asset('images/cloud2.png') }}" alt="" class="cloud"
                style="position: absolute; right: 10%; top: 45%; width: 270px; opacity: 0.5; animation: float 25s ease-in-out infinite reverse;">
            <img src="{{ asset('images/cloud1.png') }}" alt="" class="cloud"
                style="position: absolute; left: 50%; top: 75%; width: 240px; opacity: 0.45; animation: float 30s ease-in-out infinite 2s;">
        </div>
        <div class="container position-relative" style="z-index: 2;">
            <div class="d-flex align-items-end justify-content-between mb-4">
                <div>
                    <h2 class="text-white fw-bold display-5 text-shadow-md" data-aos="fade-up">Galeri Karya</h2>
                    <p class="text-white-50 mb-0 fs-4 text-shadow-sm" data-aos="fade-up" data-aos-delay="100">Karya
                        terbaru dari anggota
                        Kanvas</p>
                </div>
                <a href="{{ route('art_gallery') }}" class="btn btn-outline-light">Lihat Galeri</a>
            </div>

            <div class="row g-4">
                @forelse($featuredArtworks->take(4) as $index => $artwork)
                    <div class="col-6 col-md-3" data-aos="zoom-in" data-aos-delay="{{ ($index + 1) * 50 }}">
                        <div class="artwork-card-home" style="cursor: pointer; position: relative;">
                            <div class="artwork-image-container-home">
                                <img src="{{ asset($artwork->image_path) }}" alt="{{ $artwork->title }}"
                                    class="artwork-image-home">
                                <div class="artwork-overlay-home">
                                    <div class="artwork-info-home">
                                        <h6 class="text-white fw-bold mb-1">{{ $artwork->title }}</h6>
                                        <p class="text-white-50 small mb-0">By: {{ $artwork->artist_name }}</p>
                                        <a href="{{ route('art_gallery') }}" class="btn btn-sm btn-gradient mt-2">
                                            <i class="bi bi-eye me-1"></i>View Details
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Compact Popup -->
                            <div class="artwork-popup-home" id="popup-home-{{ $artwork->id }}">
                                <div class="popup-header">
                                    <h6 class="text-white mb-0 fw-bold">{{ $artwork->title }}</h6>
                                    <button type="button" class="popup-close"
                                        onclick="closePopupHome({{ $artwork->id }})">
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
                                            <strong
                                                class="text-white">{{ $artwork->created_date->format('M d, Y') }}</strong>
                                        </div>
                                    </div>
                                    @if ($artwork->description)
                                        <div class="popup-item">
                                            <i class="bi bi-file-text-fill text-warning"></i>
                                            <div>
                                                <small class="text-white-50 d-block">Description</small>
                                                <p class="text-white mb-0 popup-description">
                                                    {{ Str::limit($artwork->description, 150) }}</p>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p class="text-white-50">Belum ada karya yang ditampilkan</p>
                    </div>
                @endforelse
            </div>

            <style>
                .artwork-card-home {
                    height: 300px;
                    overflow: hidden;
                    border-radius: 1rem;
                    transition: all 0.3s ease;
                    position: relative;
                }

                .artwork-image-container-home {
                    position: relative;
                    height: 100%;
                    overflow: hidden;
                    border-radius: 1rem;
                }

                .artwork-image-home {
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                    transition: transform 0.5s ease;
                }

                .artwork-card-home:hover .artwork-image-home {
                    transform: scale(1.1);
                }

                .artwork-overlay-home {
                    position: absolute;
                    top: 0;
                    left: 0;
                    right: 0;
                    bottom: 0;
                    background: linear-gradient(to top, rgba(42, 10, 86, 0.95) 0%, transparent 100%);
                    opacity: 0;
                    transition: opacity 0.3s ease;
                    display: flex;
                    align-items: flex-end;
                    padding: 1.5rem;
                }

                .artwork-card-home:hover .artwork-overlay-home {
                    opacity: 1;
                }

                .artwork-info-home {
                    transform: translateY(20px);
                    transition: transform 0.3s ease;
                }

                .artwork-card-home:hover .artwork-info-home {
                    transform: translateY(0);
                }

                /* Popup Styles for Home Gallery */
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

                @media (max-width: 767px) {
                    .artwork-card-home {
                        height: 250px;
                    }

                    .artwork-popup-home {
                        width: 280px;
                    }
                }
            </style>
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
    <section id="about" class="py-5 position-relative">
        <!-- Floating clouds for About Section -->
        <div class="floating-clouds position-absolute w-100" style="top: 0; left: 0; right: 0; bottom: 0; z-index: 1; pointer-events: none; overflow: hidden;">
            <img src="{{ asset('images/cloud5.png') }}" alt="" class="cloud"
                style="position: absolute; right: 18%; top: 18%; width: 280px; opacity: 0.55; animation: float 29s ease-in-out infinite;">
            <img src="{{ asset('images/cloud3.png') }}" alt="" class="cloud"
                style="position: absolute; left: 12%; top: 55%; width: 250px; opacity: 0.5; animation: float 26s ease-in-out infinite reverse;">
        </div>
        <div class="container position-relative" style="z-index: 2;">
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
                        <img src="{{ asset('images/bg2.jpg') }}" alt="Tentang Kanvas" class="w-100 h-100 object-fit-cover about-image">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .about-card-enhanced {
            background: rgba(93, 64, 97, 0.8) !important;
            backdrop-filter: blur(20px);
            border: 2px solid rgba(255, 236, 119, 0.4);
            border-radius: 1.5rem;
            transition: all 0.3s ease;
        }

        .about-card-enhanced:hover {
            border-color: rgba(255, 236, 119, 0.6);
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




    {{-- yg kemarin coba" embed  --}}

    {{-- <section>
        
<br><br>
<iframe data-testid="embed-iframe" style="border-radius:12px" src="https://open.spotify.com/embed/track/1CPZ5BxNNd0n0nF4Orb9JS?utm_source=generator" width="100%" height="152" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy">
</iframe>
<iframe width="2033" height="937" src="https://www.youtube.com/embed/SdSSPF1S-Uc" title="Live NOW: Victoria&#39;s Secret Fashion Show 2025" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>

<blockquote class="instagram-media" data-instgrm-captioned data-instgrm-permalink="https://www.instagram.com/p/DPd0SHUibrk/?utm_source=ig_embed&amp;utm_campaign=loading" data-instgrm-version="14" style=" background:#ff9c9c; border:0; border-radius:3px; box-shadow:0 0 1px 0 rgba(0,0,0,0.5),0 1px 10px 0 rgba(0,0,0,0.15); margin: 1px; max-width:540px; min-width:326px; padding:0; width:99.375%; width:-webkit-calc(100% - 2px); width:calc(100% - 2px);"><div style="padding:16px;"> <a href="https://www.instagram.com/p/DPd0SHUibrk/?utm_source=ig_embed&amp;utm_campaign=loading" style=" background:#FFFFFF; line-height:0; padding:0 0; text-align:center; text-decoration:none; width:100%;" target="_blank"> <div style=" display: flex; flex-direction: row; align-items: center;"> <div style="background-color: #F4F4F4; border-radius: 50%; flex-grow: 0; height: 40px; margin-right: 14px; width: 40px;"></div> <div style="display: flex; flex-direction: column; flex-grow: 1; justify-content: center;"> <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; margin-bottom: 6px; width: 100px;"></div> <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; width: 60px;"></div></div></div><div style="padding: 19% 0;"></div> <div style="display:block; height:50px; margin:0 auto 12px; width:50px;"><svg width="50px" height="50px" viewBox="0 0 60 60" version="1.1" xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g transform="translate(-511.000000, -20.000000)" fill="#000000"><g><path d="M556.869,30.41 C554.814,30.41 553.148,32.076 553.148,34.131 C553.148,36.186 554.814,37.852 556.869,37.852 C558.924,37.852 560.59,36.186 560.59,34.131 C560.59,32.076 558.924,30.41 556.869,30.41 M541,60.657 C535.114,60.657 530.342,55.887 530.342,50 C530.342,44.114 535.114,39.342 541,39.342 C546.887,39.342 551.658,44.114 551.658,50 C551.658,55.887 546.887,60.657 541,60.657 M541,33.886 C532.1,33.886 524.886,41.1 524.886,50 C524.886,58.899 532.1,66.113 541,66.113 C549.9,66.113 557.115,58.899 557.115,50 C557.115,41.1 549.9,33.886 541,33.886 M565.378,62.101 C565.244,65.022 564.756,66.606 564.346,67.663 C563.803,69.06 563.154,70.057 562.106,71.106 C561.058,72.155 560.06,72.803 558.662,73.347 C557.607,73.757 556.021,74.244 553.102,74.378 C549.944,74.521 548.997,74.552 541,74.552 C533.003,74.552 532.056,74.521 528.898,74.378 C525.979,74.244 524.393,73.757 523.338,73.347 C521.94,72.803 520.942,72.155 519.894,71.106 C518.846,70.057 518.197,69.06 517.654,67.663 C517.244,66.606 516.755,65.022 516.623,62.101 C516.479,58.943 516.448,57.996 516.448,50 C516.448,42.003 516.479,41.056 516.623,37.899 C516.755,34.978 517.244,33.391 517.654,32.338 C518.197,30.938 518.846,29.942 519.894,28.894 C520.942,27.846 521.94,27.196 523.338,26.654 C524.393,26.244 525.979,25.756 528.898,25.623 C532.057,25.479 533.004,25.448 541,25.448 C548.997,25.448 549.943,25.479 553.102,25.623 C556.021,25.756 557.607,26.244 558.662,26.654 C560.06,27.196 561.058,27.846 562.106,28.894 C563.154,29.942 563.803,30.938 564.346,32.338 C564.756,33.391 565.244,34.978 565.378,37.899 C565.522,41.056 565.552,42.003 565.552,50 C565.552,57.996 565.522,58.943 565.378,62.101 M570.82,37.631 C570.674,34.438 570.167,32.258 569.425,30.349 C568.659,28.377 567.633,26.702 565.965,25.035 C564.297,23.368 562.623,22.342 560.652,21.575 C558.743,20.834 556.562,20.326 553.369,20.18 C550.169,20.033 549.148,20 541,20 C532.853,20 531.831,20.033 528.631,20.18 C525.438,20.326 523.257,20.834 521.349,21.575 C519.376,22.342 517.703,23.368 516.035,25.035 C514.368,26.702 513.342,28.377 512.574,30.349 C511.834,32.258 511.326,34.438 511.181,37.631 C511.035,40.831 511,41.851 511,50 C511,58.147 511.035,59.17 511.181,62.369 C511.326,65.562 511.834,67.743 512.574,69.651 C513.342,71.625 514.368,73.296 516.035,74.965 C517.703,76.634 519.376,77.658 521.349,78.425 C523.257,79.167 525.438,79.673 528.631,79.82 C531.831,79.965 532.853,80.001 541,80.001 C549.148,80.001 550.169,79.965 553.369,79.82 C556.562,79.673 558.743,79.167 560.652,78.425 C562.623,77.658 564.297,76.634 565.965,74.965 C567.633,73.296 568.659,71.625 569.425,69.651 C570.167,67.743 570.674,65.562 570.82,62.369 C570.966,59.17 571,58.147 571,50 C571,41.851 570.966,40.831 570.82,37.631"></path></g></g></g></svg></div><div style="padding-top: 8px;"> <div style=" color:#3897f0; font-family:Arial,sans-serif; font-size:14px; font-style:normal; font-weight:550; line-height:18px;">View this post on Instagram</div></div><div style="padding: 12.5% 0;"></div> <div style="display: flex; flex-direction: row; margin-bottom: 14px; align-items: center;"><div> <div style="background-color: #F4F4F4; border-radius: 50%; height: 12.5px; width: 12.5px; transform: translateX(0px) translateY(7px);"></div> <div style="background-color: #F4F4F4; height: 12.5px; transform: rotate(-45deg) translateX(3px) translateY(1px); width: 12.5px; flex-grow: 0; margin-right: 14px; margin-left: 2px;"></div> <div style="background-color: #F4F4F4; border-radius: 50%; height: 12.5px; width: 12.5px; transform: translateX(9px) translateY(-18px);"></div></div><div style="margin-left: 8px;"> <div style=" background-color: #F4F4F4; border-radius: 50%; flex-grow: 0; height: 20px; width: 20px;"></div> <div style=" width: 0; height: 0; border-top: 2px solid transparent; border-left: 6px solid #f4f4f4; border-bottom: 2px solid transparent; transform: translateX(16px) translateY(-4px) rotate(30deg)"></div></div><div style="margin-left: auto;"> <div style=" width: 0px; border-top: 8px solid #F4F4F4; border-right: 8px solid transparent; transform: translateY(16px);"></div> <div style=" background-color: #F4F4F4; flex-grow: 0; height: 12px; width: 16px; transform: translateY(-4px);"></div> <div style=" width: 0; height: 0; border-top: 8px solid #F4F4F4; border-left: 8px solid transparent; transform: translateY(-4px) translateX(8px);"></div></div></div> <div style="display: flex; flex-direction: column; flex-grow: 1; justify-content: center; margin-bottom: 24px;"> <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; margin-bottom: 6px; width: 224px;"></div> <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; width: 144px;"></div></div></a><p style=" color:#c9c8cd; font-family:Arial,sans-serif; font-size:14px; line-height:17px; margin-bottom:0; margin-top:8px; overflow:hidden; padding:8px 0 7px; text-align:center; text-overflow:ellipsis; white-space:nowrap;"><a href="https://www.instagram.com/p/DPd0SHUibrk/?utm_source=ig_embed&amp;utm_campaign=loading" style=" color:#c9c8cd; font-family:Arial,sans-serif; font-size:14px; font-style:normal; font-weight:normal; line-height:17px; text-decoration:none;" target="_blank">A post shared by Kanvas Ciputra University (@uc_kanvas)</a></p></div></blockquote>
<script async src="//www.instagram.com/embed.js"></script>
    </section> --}}

    <script>
        // Popup functions for home gallery
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
            if (!event.target.closest('.artwork-card-home') && !event.target.closest('.btn-gradient')) {
                document.querySelectorAll('.artwork-popup-home').forEach(popup => {
                    popup.classList.remove('active');
                });
            }
        });
    </script>


@endsection
