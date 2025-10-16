@extends('layouts.app')

@section('title', 'Contact')

@section('content')
    <div style="text-align: center; margin-top: 30px;">
        <a href="{{ route('home') }}" class="btn">Back to Home</a>
        <a href="{{ route('about') }}" class="btn" style="margin-left: 10px;">About Us</a>
    </div>
@endsection
