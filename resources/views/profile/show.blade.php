@extends('layouts.app')

@section('title', 'My Profile')

@section('content')
    <div class="container py-5">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-lg-3 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <div class="mb-3">
                            <i class="bi bi-person-circle" style="font-size: 5rem; color: #6c757d;"></i>
                        </div>
                        <h5 class="card-title mb-1">{{ $user->name }}</h5>
                        <p class="text-muted small mb-3">{{ $user->email }}</p>
                        <hr>
                        <div class="list-group list-group-flush">
                            <a href="#profile-info" class="list-group-item list-group-item-action active">
                                <i class="bi bi-person me-2"></i>Profile Information
                            </a>
                            <a href="#notifications" class="list-group-item list-group-item-action">
                                <i class="bi bi-bell me-2"></i>Notifications
                                @php
                                    $unreadCount = $user->unreadCustomNotifications()->count();
                                @endphp
                                @if ($unreadCount > 0)
                                    <span class="badge bg-danger ms-2">{{ $unreadCount }}</span>
                                @endif
                            </a>
                            <a href="#dues" class="list-group-item list-group-item-action">
                                <i class="bi bi-wallet2 me-2"></i>Dues Payments
                            </a>
                            <a href="#change-password" class="list-group-item list-group-item-action">
                                <i class="bi bi-key me-2"></i>Change Password
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-lg-9">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <!-- Profile Information Section -->
                <div class="card shadow-sm mb-4" id="profile-info">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="bi bi-person me-2"></i>Profile Information</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('profile.update') }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Full Name <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="name" name="name" value="{{ old('name', $user->name) }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Email <span
                                            class="text-danger">*</span></label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        id="email" name="email" value="{{ old('email', $user->email) }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="nim" class="form-label">NIM</label>
                                    <input type="text" class="form-control @error('nim') is-invalid @enderror"
                                        id="nim" name="nim" value="{{ old('nim', $profile->nim ?? '') }}">
                                    @error('nim')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="jurusan" class="form-label">Jurusan</label>
                                    <input type="text" class="form-control @error('jurusan') is-invalid @enderror"
                                        id="jurusan" name="jurusan"
                                        value="{{ old('jurusan', $profile->jurusan ?? '') }}">
                                    @error('jurusan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="asal_universitas" class="form-label">Asal Universitas</label>
                                    <input type="text"
                                        class="form-control @error('asal_universitas') is-invalid @enderror"
                                        id="asal_universitas" name="asal_universitas"
                                        value="{{ old('asal_universitas', $profile->asal_universitas ?? '') }}">
                                    @error('asal_universitas')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="no_telp" class="form-label">Phone Number</label>
                                    <input type="text" class="form-control @error('no_telp') is-invalid @enderror"
                                        id="no_telp" name="no_telp"
                                        value="{{ old('no_telp', $profile->no_telp ?? '') }}">
                                    @error('no_telp')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save me-2"></i>Update Profile
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Notifications Section -->
                <div class="card shadow-sm mb-4" id="notifications">
                    <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0"><i class="bi bi-bell me-2"></i>Notifications</h5>
                        @if ($notifications->total() > 0)
                            <form action="{{ route('notifications.mark-all-read') }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-sm btn-light">
                                    <i class="bi bi-check2-all me-1"></i>Mark All as Read
                                </button>
                            </form>
                        @endif
                    </div>
                    <div class="card-body">
                        @if ($notifications->count() > 0)
                            <div class="list-group list-group-flush">
                                @foreach ($notifications as $notification)
                                    <div class="list-group-item {{ !$notification->is_read ? 'bg-light' : '' }}">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div class="flex-grow-1">
                                                <div class="d-flex align-items-center mb-1">
                                                    @if (!$notification->is_read)
                                                        <span class="badge bg-primary me-2">New</span>
                                                    @endif
                                                    <span
                                                        class="badge bg-secondary">{{ ucfirst(str_replace('_', ' ', $notification->type)) }}</span>
                                                </div>
                                                <p class="mb-1">{{ $notification->message }}</p>
                                                <small
                                                    class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                                            </div>
                                            @if (!$notification->is_read)
                                                <form action="{{ route('notifications.mark-read', $notification) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-sm btn-outline-primary">
                                                        <i class="bi bi-check2"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="mt-3">
                                {{ $notifications->appends(['dues_page' => request('dues_page')])->links() }}
                            </div>
                        @else
                            <div class="text-center py-5">
                                <i class="bi bi-bell-slash" style="font-size: 3rem; color: #6c757d;"></i>
                                <p class="text-muted mt-3">No notifications yet</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Dues Payments Section -->
                <div class="card shadow-sm mb-4" id="dues">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0"><i class="bi bi-wallet2 me-2"></i>Dues Payments History</h5>
                    </div>
                    <div class="card-body">
                        @if ($duesPayments->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Period</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <th>Payment Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($duesPayments as $payment)
                                            <tr>
                                                <td>
                                                    <strong>{{ $payment->duesPeriod->name }}</strong><br>
                                                    <small
                                                        class="text-muted">{{ $payment->duesPeriod->start_date->format('M Y') }}
                                                        - {{ $payment->duesPeriod->end_date->format('M Y') }}</small>
                                                </td>
                                                <td>Rp {{ number_format($payment->duesPeriod->amount, 0, ',', '.') }}
                                                </td>
                                                <td>
                                                    @if ($payment->payment_status === 'verified')
                                                        <span class="badge bg-success">Verified</span>
                                                    @elseif($payment->payment_status === 'pending')
                                                        <span class="badge bg-warning">Pending</span>
                                                    @else
                                                        <span class="badge bg-danger">Rejected</span>
                                                    @endif
                                                </td>
                                                <td>{{ $payment->created_at->format('d M Y') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="mt-3">
                                {{ $duesPayments->appends(['notifications_page' => request('notifications_page')])->links() }}
                            </div>
                        @else
                            <div class="text-center py-5">
                                <i class="bi bi-wallet2" style="font-size: 3rem; color: #6c757d;"></i>
                                <p class="text-muted mt-3">No payment history yet</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Change Password Section -->
                <div class="card shadow-sm mb-4" id="change-password">
                    <div class="card-header bg-warning text-dark">
                        <h5 class="mb-0"><i class="bi bi-key me-2"></i>Change Password</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('profile.update-password') }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="current_password" class="form-label">Current Password <span
                                        class="text-danger">*</span></label>
                                <input type="password"
                                    class="form-control @error('current_password') is-invalid @enderror"
                                    id="current_password" name="current_password" required>
                                @error('current_password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="new_password" class="form-label">New Password <span
                                        class="text-danger">*</span></label>
                                <input type="password" class="form-control @error('new_password') is-invalid @enderror"
                                    id="new_password" name="new_password" required>
                                @error('new_password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="new_password_confirmation" class="form-label">Confirm New Password <span
                                        class="text-danger">*</span></label>
                                <input type="password" class="form-control" id="new_password_confirmation"
                                    name="new_password_confirmation" required>
                            </div>

                            <button type="submit" class="btn btn-warning">
                                <i class="bi bi-key me-2"></i>Update Password
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .list-group-item.active {
            background-color: #0d6efd;
            border-color: #0d6efd;
        }

        .list-group-item:hover {
            background-color: #f8f9fa;
        }

        .list-group-item.active:hover {
            background-color: #0d6efd;
        }
    </style>

    <script>
        // Smooth scroll for sidebar links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });

                    // Update active state
                    document.querySelectorAll('.list-group-item').forEach(item => {
                        item.classList.remove('active');
                    });
                    this.classList.add('active');
                }
            });
        });
    </script>
@endsection
