@extends('layouts.app')

@section('title', 'Contact')

@section('content')
<div class="contact-section">
    <h1>Contact Us</h1>
    
    <div class="card">
        <h2>Get in Touch</h2>
        <p>We'd love to hear from you! Send us a message and we'll respond as soon as possible.</p>
        
        <form style="max-width: 600px; margin: 0 auto;">
            <div style="margin-bottom: 20px;">
                <label for="name" style="display: block; margin-bottom: 5px; font-weight: 500;">Name</label>
                <input type="text" id="name" name="name" required 
                       style="width: 100%; padding: 12px; border: 2px solid #e1e5e9; border-radius: 8px; font-size: 16px;">
            </div>
            
            <div style="margin-bottom: 20px;">
                <label for="email" style="display: block; margin-bottom: 5px; font-weight: 500;">Email</label>
                <input type="email" id="email" name="email" required 
                       style="width: 100%; padding: 12px; border: 2px solid #e1e5e9; border-radius: 8px; font-size: 16px;">
            </div>
            
            <div style="margin-bottom: 20px;">
                <label for="subject" style="display: block; margin-bottom: 5px; font-weight: 500;">Subject</label>
                <input type="text" id="subject" name="subject" required 
                       style="width: 100%; padding: 12px; border: 2px solid #e1e5e9; border-radius: 8px; font-size: 16px;">
            </div>
            
            <div style="margin-bottom: 20px;">
                <label for="message" style="display: block; margin-bottom: 5px; font-weight: 500;">Message</label>
                <textarea id="message" name="message" rows="5" required 
                          style="width: 100%; padding: 12px; border: 2px solid #e1e5e9; border-radius: 8px; font-size: 16px; resize: vertical;"></textarea>
            </div>
            
            <button type="submit" class="btn" style="width: 100%;">Send Message</button>
        </form>
    </div>

    <div class="card">
        <h2>Contact Information</h2>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px;">
            <div>
                <h4>📧 Email</h4>
                <p>hello@example.com</p>
            </div>
            <div>
                <h4>📱 Phone</h4>
                <p>+1 (555) 123-4567</p>
            </div>
            <div>
                <h4>📍 Address</h4>
                <p>123 Web Development St<br>Digital City, DC 12345</p>
            </div>
        </div>
    </div>

    <div style="text-align: center; margin-top: 30px;">
        <a href="{{ route('home') }}" class="btn">Back to Home</a>
        <a href="{{ route('about') }}" class="btn" style="margin-left: 10px;">About Us</a>
    </div>
</div>
@endsection
