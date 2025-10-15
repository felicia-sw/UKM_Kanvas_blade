@extends('layouts.app')

@section('content')
    <div class="container-fluid px-10 mx-5 min-vh-100 d-flex align-items-center">
        <div class="center-me ps-2 pe-3">

            <div class="row align-items-center">
                <div class="col-xl-7 col-12">
                    <h1 class="text-start text-white fw-bold" style="font-size: clamp(60px, 10vw, 170px); line-height: 1.1;">WELCOME <br>PEEPS</h1>

                    <!-- desc -->
                    <div class="text-white border-start border-4 border-white ps-3 mt-4">
                        <h4 class="text-start">Apa itu kanvas</h4>
                    </div>

                    <br>
                    <h4 class="text-start text-white">Kanvas adalah</h4>
                    <h4 class="text-start text-white">Feli ⚔️</h4>

                    <div class="mt-5 pt-3">
                        <h2 class="text-black text-start fw-bold" style="font-size: clamp(32px, 4vw, 48px);">SLOGAN</h2>
                    </div>
                </div>

                <div class="col-xl-5 col-12 d-flex justify-content-center align-items-center">
                    <img src="{{ asset('images/mascot.png') }}" alt="Mascot" class="img-fluid" style="max-width: 100%; height: auto;">
                </div>

            </div>
        </div>
    </div>
@endsection
