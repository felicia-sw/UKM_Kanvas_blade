@extends('layouts.app')

@section('title', 'Events')

@section('content')
<div class="page-bg-image text-white min-vh-100 py-5 w-100" style="overflow-x: hidden;">
  <div class="container-fluid px-3 px-md-4" style="overflow: visible;">

    <div class="row justify-content-center text-center mb-5 mt-5 pt-5">
      <div class="col-12 px-2">
        <h1 class="page-title display-1 fw-bold text-uppercase mb-4">EVENTS</h1>
        <p class="page-subtitle text-white fs-5 mx-auto px-3">
          Discover upcoming events that will inspire and challenge you. 
          Explore the maze of opportunities waiting ahead.
        </p>
      </div>
    </div>

    <!-- Filter Buttons -->
    <div class="row justify-content-center mb-4">
      <div class="col-auto">
        <div class="btn-group btn-group-toggle" data-toggle="buttons">
          <a href="{{ route('events', ['filter' => 'all']) }}" class="btn btn-filter btn-lg px-4 py-2 {{ ($filter ?? 'upcoming') === 'all' ? 'active' : '' }}">All Events</a>
          <a href="{{ route('events', ['filter' => 'upcoming']) }}" class="btn btn-filter btn-lg px-4 py-2 {{ ($filter ?? 'upcoming') === 'upcoming' ? 'active' : '' }}">Now & Upcoming</a>
          <a href="{{ route('events', ['filter' => 'past']) }}" class="btn btn-filter btn-lg px-4 py-2 {{ ($filter ?? 'upcoming') === 'past' ? 'active' : '' }}">Past Events</a>
        </div>
      </div>
    </div>

    <div class="row justify-content-center mt-5 pt-5">
      <div class="col-12 col-xl-10 col-xxl-8 px-2 px-md-3" style="overflow: visible;">
        <div class="timeline-container position-relative overflow-visible">

          @forelse($events as $event)
            <x-event-card :event="$event" layout="timeline" :filter="$filter ?? 'upcoming'" />
          @empty
          <div class="row justify-content-center">
            <div class="col-12 text-center py-5">
              <i class="bi bi-calendar-x display-1 text-white-50 mb-4"></i>
              <h3 class="mb-3 text-white">
                @if(($filter ?? 'upcoming') === 'past')
                  No Past Events
                @else
                  No Active Events
                @endif
              </h3>
              <p class="fs-5 text-white-50">
                @if(($filter ?? 'upcoming') === 'past')
                  There are no past events to show.
                @else
                  Check back soon for upcoming events!
                @endif
              </p>
            </div>
          </div>
          @endforelse
        </div>
      </div>
    </div>
  </div>
</div>

<link rel="stylesheet" href="{{ asset('css/pages/events.css') }}">

<script src="{{ asset('js/pages/events.js') }}"></script>
@endsection
