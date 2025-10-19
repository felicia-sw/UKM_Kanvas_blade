@extends('layouts.app')

@section('title', 'About Us')

@section('content')
<div class="about-page text-white min-vh-100 py-5">
    <div class="container-fluid">
        
        <!-- Page Header -->
        <div class="row justify-content-center text-center mb-5 mt-5 pt-5">
            <div class="col-12">
                <h1 class="page-title display-1 fw-bold text-uppercase mb-4" data-aos="fade-down">ABOUT US</h1>
                <p class="page-subtitle text-white fs-5 mx-auto" style="max-width: 600px;" data-aos="fade-up" data-aos-delay="100">
                    Getting to know UKM Kanvas and our journey in the world of art
                </p>
            </div>
        </div>

        <!-- About Content -->
        <div class="container py-5">
        <!-- Introduction -->
        <div class="row mb-5 align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0" data-aos="fade-right">
                <div class="about-image-container ">
                    <img src="{{ asset('images/mascot2.png') }}" 
                         alt="Kanvas mascot2" >
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <h2 class="text-white fw-bold mb-4">What is UKM Kanvas?</h2>
                <p class="text-white-50 fs-5 lh-lg mb-4">
                    UKM Kanvas is a Student Activity Unit focused on developing 
                    creativity in art and design. We provide a space for students to 
                    express themselves through various art mediums such as painting, digital art, 
                    photography, and many more.
                </p>
                <p class="text-white-50 fs-5 lh-lg">
                    Since its establishment, Kanvas has become a home for hundreds of talented young artists 
                    and continues to grow into the largest creative community on campus.
                </p>
            </div>
        </div>

        <!-- Vision & Mission -->
        <div class="row g-4 mb-5">
            <div class="col-lg-6" data-aos="fade-up">
                <div class="glass-card p-5 h-100" style="background: rgba(50, 30, 80, 0.7); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.2);">
                    <div class="icon-box mb-4">
                        <i class="bi bi-eye fs-1 text-warning"></i>
                    </div>
                    <h3 class="text-white display-4 fw-bold mb-3">Our Vision</h3>
                    <p class="text-white-50 fs-5 lh-lg">
                        To become the main platform for developing students' artistic talents and producing 
                        quality works that can inspire and provide positive impact to society.
                    </p>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                <div class="glass-card p-5 h-100" style="background: rgba(50, 30, 80, 0.7); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.2);">
                    <div class="icon-box mb-4">
                        <i class="bi bi-bullseye fs-1 text-warning"></i>
                    </div>
                    <h3 class="text-white display-4 fw-bold mb-3">Our Mission</h3>
                    <ul class="text-white-50 fs-5 lh-lg">
                        <li class="mb-2">Developing students' creativity and artistic talents</li>
                        <li class="mb-2">Organizing quality workshops and training</li>
                        <li class="mb-2">Facilitating art exhibitions and competitions</li>
                        <li>Building a solid and supportive artist community</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Values -->
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="text-white fw-bold mb-4">Our Values</h2>
            <p class="text-white-50 fs-5">The principles that are the foundation of UKM Kanvas</p>
        </div>

        <div class="row g-4 mb-5">
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="value-card glass-card p-4 text-center h-100" style="background: rgba(125, 107, 48, 0.7); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.2);">
                    <div class="value-icon mb-3">
                        <i class="bi bi-lightbulb fs-1 text-warning"></i>
                    </div>
                    <h4 class="text-white fw-bold mb-3">Creativity</h4>
                    <p class="text-white-50">
                        Encouraging innovation and out-of-the-box thinking in every work
                    </p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="value-card glass-card p-4 text-center h-100" style="background: rgba(125, 107, 48, 0.7); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.2);">
                    <div class="value-icon mb-3">
                        <i class="bi bi-people fs-1 text-warning"></i>
                    </div>
                    <h4 class="text-white fw-bold mb-3">Collaboration</h4>
                    <p class="text-white-50">
                        Building strong cooperation among members for optimal results
                    </p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="value-card glass-card p-4 text-center h-100" style="background: rgba(125, 107, 48, 0.7); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.2);">
                    <div class="value-icon mb-3">
                        <i class="bi bi-award fs-1 text-warning"></i>
                    </div>
                    <h4 class="text-white fw-bold mb-3">Excellence</h4>
                    <p class="text-white-50">
                        Always striving to give the best in every work and activity
                    </p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
                <div class="value-card glass-card p-4 text-center h-100" style="background: rgba(125, 107, 48, 0.7); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.2);">
                    <div class="value-icon mb-3">
                        <i class="bi bi-heart fs-1 text-warning"></i>
                    </div>
                    <h4 class="text-white fw-bold mb-3">Passion</h4>
                    <p class="text-white-50">
                        Doing every activity with love and full dedication
                    </p>
                </div>
            </div>
        </div>

        <!-- Statistics -->
        <div class="stats-section glass-card p-5 mb-5" style="background: rgba(129, 121, 43, 0.7); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.2);" data-aos="fade-up">
            <div class="row text-center g-4">
                <div class="col-lg-3 col-6">
                    <div class="stat-item">
                        <h2 class="text-warning fw-bold display-4 mb-2">150+</h2>
                        <p class="text-white-50 fs-5">Active Members</p>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="stat-item">
                        <h2 class="text-warning fw-bold display-4 mb-2">20+</h2>
                        <p class="text-white-50 fs-5">Annual Events</p>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="stat-item">
                        <h2 class="text-warning fw-bold display-4 mb-2">100+</h2>
                        <p class="text-white-50 fs-5">Works Exhibited</p>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="stat-item">
                        <h2 class="text-warning fw-bold display-4 mb-2">2+</h2>
                        <p class="text-white-50 fs-5">Years of Experience</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- CTA Section -->
        <div class="glass-card p-5 rounded-4 text-center" style="background: rgba(50, 30, 80, 0.7); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.2);" data-aos="fade-up">
            <h2 class="text-white fw-bold mb-4">Ready to Join Us?</h2>
            <p class="text-white-50 fs-5 mb-4">
                Don't miss the chance to develop your artistic talents with the best community!
            </p>
            <div class="d-flex gap-3 justify-content-center flex-wrap">
                <a href="{{ route('events') }}" class="btn btn-gradient btn-lg px-4 py-3">
                    <i class="bi bi-calendar-event me-2"></i>See Events
                </a>
                <a href="{{ route('contact') }}" class="btn btn-outline-light btn-lg px-4 py-3">
                    <i class="bi bi-envelope me-2"></i>Contact Us
                </a>
            </div>
        </div>
    </div>
</div>
