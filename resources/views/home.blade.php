@extends('layouts.app')

@section('content')
    <div class="container-fluid px-5 pe-0 min-vh-100 d-flex align-items-center">
        <div class="center-me ps-2 pe-0 " style="width: 100%;">

            <div class="row align-items-center" style="margin-right: 0;">
                <div class="col-xl-7 col-12">
                    <h1 class="text-start text-white fw-bold" style="font-size: 170px;">WELCOME <br>PEEPS</h1>

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

                <div class="col-xl-5 col-12 d-flex justify-content-end align-items-center" style="padding-right: 0;">
                    <img src="{{ asset('images/mascot.png') }}?v=2" alt="Mascot" style="width: 100%; height: auto; margin-right: -50px">
                </div>

            </div>
        </div>
    </div>
@endsection
