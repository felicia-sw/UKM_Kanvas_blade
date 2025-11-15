@extends('layouts.app')

@section('title', 'Notifications')

@section('content')
<div class="container py-5" style="padding-top: 100px; min-height: 100vh;">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="text-white">My Notifications</h1>
                @if($notifications->where('is_read', false)->count() > 0)
                <form action="{{ route('notifications.mark-all-read') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-outline-light">Mark All as Read</button>
                </form>
                @endif
            </div>

            @if($notifications->count() > 0)
                <div class="notification-list">
                    @foreach($notifications as $notification)
                    <div class="notification-card mb-3 p-4 rounded {{ $notification->is_read ? 'bg-dark bg-opacity-50' : 'bg-primary bg-opacity-25' }}" 
                         style="border-left: 4px solid {{ $notification->is_read ? '#6c757d' : '#0d6efd' }};">
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="flex-grow-1">
                                <div class="d-flex align-items-center mb-2">
                                    @if($notification->type === 'registration')
                                        <i class="bi bi-check-circle-fill text-success me-2"></i>
                                    @elseif($notification->type === 'reminder_1day')
                                        <i class="bi bi-calendar-event text-warning me-2"></i>
                                    @elseif($notification->type === 'reminder_today')
                                        <i class="bi bi-exclamation-circle-fill text-danger me-2"></i>
                                    @endif
                                    <span class="badge {{ $notification->is_read ? 'bg-secondary' : 'bg-primary' }}">
                                        {{ ucfirst(str_replace('_', ' ', $notification->type)) }}
                                    </span>
                                </div>
                                <p class="text-white mb-2">{{ $notification->message }}</p>
                                <small class="text-white-50">
                                    {{ $notification->created_at->diffForHumans() }}
                                </small>
                                @if($notification->event)
                                <div class="mt-2">
                                    <a href="{{ route('events.show', $notification->event->id) }}" class="btn btn-sm btn-outline-light">
                                        View Event
                                    </a>
                                </div>
                                @endif
                            </div>
                            @if(!$notification->is_read)
                            <form action="{{ route('notifications.mark-read', $notification) }}" method="POST" class="ms-3">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-sm btn-light" title="Mark as Read">
                                    <i class="bi bi-check2"></i>
                                </button>
                            </form>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="mt-4">
                    {{ $notifications->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="bi bi-bell-slash display-1 text-white-50 mb-3"></i>
                    <h3 class="text-white">No notifications yet</h3>
                    <p class="text-white-50">You'll see notifications here when you register for events.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
