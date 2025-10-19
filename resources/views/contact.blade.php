@extends('layouts.app')

@section('title', 'Contact')

@section('content')
<div class="contact-page text-white min-vh-100 py-5">
    <div class="container">

        <!-- Page Header -->
        <div class="row justify-content-center text-center mb-5 mt-5 pt-5">
            <div class="col-12 col-md-8">
                <h1 class="page-title display-1 fw-bold text-uppercase mb-4" data-aos="fade-down">CONTACT US</h1>
                <p class="page-subtitle fs-5 mx-auto" style="max-width: 600px;" data-aos="fade-up" data-aos-delay="100">
                    Let's get in touch!
                </p>
            </div>
        </div>

        <!-- Contact Content -->
        <div class="row justify-content-center gy-5">

            <!-- Contact Form -->
            <div class="col-lg-7" data-aos="fade-right">
                <div class="contact-form-card glass-card p-5 rounded-4"
                     style="background: rgba(50, 30, 80, 0.7); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.2);">
                    <h2 class="fw-bold mb-4">Send a Message</h2>
                    <p class="text-white-50 mb-4">Fill in this form and we'll get back to you as soon as possible!</p>

                    <form id="contactForm" novalidate>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label fw-500">Full Name</label>
                                <input type="text" class="form-control form-control-lg contact-input"
                                       id="name" name="name" required placeholder="Enter Your Full Name" autocomplete="name">
                            </div>

                            <div class="col-md-6">
                                <label for="email" class="form-label fw-500">Email</label>
                                <input type="email" class="form-control form-control-lg contact-input"
                                       id="email" name="email" required placeholder="email@example.com" autocomplete="email">
                            </div>

                            <div class="col-md-6">
                                <label for="phone" class="form-label fw-500">Telephone Number</label>
                                <input type="tel" class="form-control form-control-lg contact-input"
                                       id="phone" name="phone" placeholder="+62 xxx xxxx xxxx" autocomplete="tel">
                            </div>

                            <div class="col-md-6">
                                <label for="subject" class="form-label fw-500">Subject</label>
                                <select class="form-select form-select-lg contact-input" id="subject" name="subject" required>
                                    <option value="" disabled selected>Choose a subject</option>
                                    <option value="membership">Informasi Keanggotaan</option>
                                    <option value="event">Pertanyaan Event</option>
                                    <option value="collaboration">Kolaborasi</option>
                                    <option value="other">Lainnya</option>
                                </select>
                            </div>

                            <div class="col-12">
                                <label for="message" class="form-label fw-500">Pesan</label>
                                <textarea class="form-control form-control-lg contact-input" id="message" name="message" rows="5" required placeholder="Your message here"></textarea>
                            </div>

                            <div class="col-12 mt-4">
                                <button type="submit" class="btn btn-gradient btn-lg w-100 py-3">
                                    <i class="bi bi-send me-2"></i>Send a message
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Contact Information -->
            <div class="col-lg-5" data-aos="fade-left">
                <div class="contact-info-card glass-card p-5 rounded-4 mb-4"
                     style="background: rgba(50, 30, 80, 0.7); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.2);">

                    <h3 class="fw-bold mb-4">General Information</h3>

                    <div class="contact-item d-flex align-items-start mb-4">
                        <div class="contact-icon me-3">
                            <i class="bi bi-geo-alt-fill fs-3 text-warning"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-2">Address</h5>
                            <p class="text-white-50 mb-0">
                                Universitas Ciputra Surabaya<br>
                                UC Town, Citraland, Surabaya 60219
                            </p>
                        </div>
                    </div>

                    <div class="contact-item d-flex align-items-start mb-4">
                        <div class="contact-icon me-3">
                            <i class="bi bi-envelope-fill fs-3 text-warning"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-2">Email</h5>
                            <a href="mailto:ukm.kanvas@ciputra.ac.id" class="text-white-50 text-decoration-none">
                                ukm.kanvas@ciputra.ac.id
                            </a>
                        </div>
                    </div>

                    <div class="contact-item d-flex align-items-start mb-4">
                        <div class="contact-icon me-3">
                            <i class="bi bi-telephone-fill fs-3 text-warning"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-2">WhatsApp</h5>
                            <a href="https://wa.me/6281337241083" target="_blank" class="text-white-50 text-decoration-none">
                                +62 813 3724 1083
                            </a>
                        </div>
                    </div>

                    <div class="contact-item d-flex align-items-start">
                        <div class="contact-icon me-3">
                            <i class="bi bi-clock-fill fs-3 text-warning"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-2">Weekly Meeting</h5>
                            <p class="text-white-50 mb-0">Selasa, 17:00 - 19:00</p>
                        </div>
                    </div>
                </div>

                <!-- Social Media -->
                <div class="social-media-card glass-card p-5 rounded-4"
                     style="background: rgba(50, 30, 80, 0.7); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.2);">
                    <h3 class="fw-bold mb-4">Follow Us</h3>
                    <div class="d-flex gap-3 justify-content-center">
                        <a href="https://www.instagram.com/uc_kanvas?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw=="
                           target="_blank"
                           class="social-btn btn btn-outline-light rounded-circle d-flex align-items-center justify-content-center"
                           style="width: 55px; height: 55px;">
                            <i class="bi bi-instagram fs-4"></i>
                        </a>

                        <a href="mailto:ukm.kanvas@ciputra.ac.id"
                           class="social-btn btn btn-outline-light rounded-circle d-flex align-items-center justify-content-center"
                           style="width: 55px; height: 55px;">
                            <i class="bi bi-envelope-fill fs-4"></i>
                        </a>

                        <a href="https://wa.me/6281337241083" target="_blank"
                           class="social-btn btn btn-outline-light rounded-circle d-flex align-items-center justify-content-center"
                           style="width: 55px; height: 55px;">
                            <i class="bi bi-whatsapp fs-4"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Map Section (Optional) -->
        <div class="row justify-content-center mt-5">
            <div class="col-12" data-aos="fade-up">
                <div class="map-card glass-card rounded-4 overflow-hidden"
                     style="background: rgba(50, 30, 80, 0.7); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.2); height: 400px;">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.2847856265947!2d112.63073631477526!3d-7.321416894716374!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fb5e7e9a4e63%3A0x57ae2dfe7e9a1b7a!2sUniversitas%20Ciputra%20Surabaya!5e0!3m2!1sen!2sid!4v1645234567890!5m2!1sen!2sid"
                            width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .contact-page {
        min-height: 100vh;
        background-image: url('{{ asset('images/bg1.jpg') }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed;
        position: relative;
    }

    .contact-page::before {
        content: '';
        position: absolute;
        inset: 0;
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

    .contact-page>* {
        position: relative;
        z-index: 1;
    }

    .page-title {
        letter-spacing: 5px;
        line-height: 1.1;
        color: #ddd;
        text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.3);
        -webkit-text-stroke: 1px rgba(255, 255, 255, 0.8);
    }

    .text-white-50 {
        color: rgba(255, 255, 255, 0.85) !important;
    }

    .contact-input {
        background: rgba(255, 255, 255, 0.1) !important;
        border: 2px solid rgba(255, 255, 255, 0.2) !important;
        color: #fff !important;
        transition: all 0.3s ease;
    }

    .contact-input::placeholder {
        color: rgba(255, 255, 255, 0.5);
    }

    .contact-input:focus {
        background: rgba(255, 255, 255, 0.15) !important;
        border-color: rgba(255, 236, 119, 0.5) !important;
        box-shadow: 0 0 0 0.25rem rgba(255, 236, 119, 0.15) !important;
        color: #fff !important;
    }

    .contact-input option {
        background: #2a0a56;
        color: #fff;
    }

    .contact-item {
        transition: transform 0.3s ease;
    }

    .contact-item:hover {
        transform: translateX(10px);
    }

    .social-btn {
        transition: all 0.3s ease;
        border-width: 2px;
    }

    .social-btn:hover {
        background: linear-gradient(135deg, #FFEC77 0%, #F8B803 100%);
        border-color: transparent;
        color: #1b1b18;
        transform: translateY(-5px);
    }

    @keyframes submitSuccess {
        0% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.05);
        }
        100% {
            transform: scale(1);
        }
    }

    .submit-success {
        animation: submitSuccess 0.5s ease;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('contactForm');

        form.addEventListener('submit', function (e) {
            e.preventDefault();

            // Add success animation
            form.classList.add('submit-success');

            // Show success message
            alert('Terima kasih! Pesan Anda telah terkirim. Kami akan segera menghubungi Anda.');

            // Reset form
            form.reset();

            // Remove animation class
            setTimeout(() => {
                form.classList.remove('submit-success');
            }, 500);
        });
    });
</script>
