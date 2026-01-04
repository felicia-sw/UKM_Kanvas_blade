@extends('layouts.app')

@section('title', 'My Profile')

@section('content')
    <!-- Spacer for fixed navbar -->
    <div style="height: 200px; background: transparent;"></div>

    <div class="container" style="padding-bottom: 3rem; margin-top: 2rem;">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-lg-3 mb-4">
                <div class="card shadow-lg border-0" style="background: #2A0A56;">
                    <div class="card-body text-center">
                        <div class="mb-3">
                            <i class="bi bi-person-circle" style="font-size: 5rem; color: #FFEC77;"></i>
                        </div>
                        <h5 class="card-title mb-1 text-white">{{ $user->name }}</h5>
                        <p class="text-white-50 small mb-3">{{ $user->email }}</p>
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
                <div class="card shadow-lg border-0 mb-4" id="profile-info" style="background: #2A0A56;">
                    <div class="card-header" style="background: #8F4898; border-bottom: none;">
                        <h5 class="mb-0 text-white"><i class="bi bi-person me-2"></i>Profile Information</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('profile.update') }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label text-white">Full Name <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="name" name="name" value="{{ old('name', $user->name) }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label text-white">Email <span
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
                                    <label for="nim" class="form-label text-white">NIM</label>
                                    <input type="text" class="form-control @error('nim') is-invalid @enderror"
                                        id="nim" name="nim" value="{{ old('nim', $profile->nim ?? '') }}">
                                    @error('nim')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="jurusan" class="form-label text-white">Jurusan</label>
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
                                    <label for="asal_universitas" class="form-label text-white">Asal Universitas</label>
                                    <input type="text"
                                        class="form-control @error('asal_universitas') is-invalid @enderror"
                                        id="asal_universitas" name="asal_universitas"
                                        value="{{ old('asal_universitas', $profile->asal_universitas ?? '') }}">
                                    @error('asal_universitas')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="no_telp" class="form-label text-white">Phone Number</label>
                                    <input type="text" class="form-control @error('no_telp') is-invalid @enderror"
                                        id="no_telp" name="no_telp"
                                        value="{{ old('no_telp', $profile->no_telp ?? '') }}">
                                    @error('no_telp')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <button type="submit" class="btn btn-warning text-dark">
                                <i class="bi bi-save me-2"></i>Update Profile
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Notifications Section -->
                <div class="card shadow-lg border-0 mb-4" id="notifications" style="background: #2A0A56;">
                    <div class="card-header d-flex justify-content-between align-items-center"
                        style="background: #8F4898; border-bottom: none;">
                        <h5 class="mb-0 text-white"><i class="bi bi-bell me-2"></i>Notifications</h5>
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
                                    <div class="list-group-item {{ !$notification->is_read ? 'bg-dark bg-opacity-25' : '' }} border-0"
                                        style="background: rgba(255, 255, 255, 0.05);">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div class="flex-grow-1">
                                                <div class="d-flex align-items-center mb-1">
                                                    @if (!$notification->is_read)
                                                        <span class="badge bg-warning text-dark me-2">New</span>
                                                    @endif
                                                    <span
                                                        class="badge bg-secondary">{{ ucfirst(str_replace('_', ' ', $notification->type)) }}</span>
                                                </div>
                                                <p class="mb-1 text-white">{{ $notification->message }}</p>
                                                <small
                                                    class="text-white-50">{{ $notification->created_at->diffForHumans() }}</small>
                                            </div>
                                            @if (!$notification->is_read)
                                                <form action="{{ route('notifications.mark-read', $notification) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-sm btn-outline-warning">
                                                        <i class="bi bi-check2"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="mt-3 d-flex justify-content-center">
                                {{ $notifications->appends(['dues_page' => request('dues_page')])->links('pagination::bootstrap-5') }}
                            </div>
                        @else
                            <div class="text-center py-5">
                                <i class="bi bi-bell-slash" style="font-size: 3rem; color: #FFEC77;"></i>
                                <p class="text-white-50 mt-3">No notifications yet</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Dues Payments Section -->
                <div class="card shadow-lg border-0 mb-4" id="dues" style="background: #2A0A56;">
                    <div class="card-header" style="background: #8F4898; border-bottom: none;">
                        <h5 class="mb-0 text-white"><i class="bi bi-wallet2 me-2"></i>Dues Payments</h5>
                    </div>
                    <div class="card-body">
                        <!-- Unpaid Dues -->
                        @if ($unpaidDues->count() > 0)
                            <h6 class="text-white mb-3">Unpaid Dues</h6>
                            <div class="row g-3 mb-4">
                                @foreach ($unpaidDues as $dues)
                                    <div class="col-md-6">
                                        <div class="card border-warning" style="background: rgba(255, 193, 7, 0.1);">
                                            <div class="card-body">
                                                <h6 class="card-title text-white">{{ $dues->name }}</h6>
                                                <p class="card-text text-white-50 mb-2">
                                                    <strong>Amount:</strong> Rp
                                                    {{ number_format($dues->amount, 0, ',', '.') }}<br>
                                                    <strong>Due Date:</strong>
                                                    {{ $dues->due_date ? $dues->due_date->format('d M Y') : 'N/A' }}
                                                </p>
                                                @if ($dues->description)
                                                    <p class="text-white-50 small mb-3">{{ $dues->description }}</p>
                                                @endif
                                                <a href="{{ route('dues.payment.create', $dues->id) }}"
                                                    class="btn btn-warning btn-sm">
                                                    <i class="bi bi-credit-card me-1"></i>Pay Now
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <hr style="border-color: rgba(255, 255, 255, 0.1);">
                        @endif

                        <!-- Payment History -->
                        <h6 class="text-white mb-3">Payment History</h6>
                        @if ($duesPayments->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover table-dark">
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
                                                    <small class="text-white-50">Due:
                                                        {{ $payment->duesPeriod->due_date ? $payment->duesPeriod->due_date->format('d M Y') : 'N/A' }}</small>
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
                                <i class="bi bi-wallet2" style="font-size: 3rem; color: #FFEC77;"></i>
                                <p class="text-white-50 mt-3">No payment history yet</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .list-group-item {
            background: #3d1a5c;
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #fff;
        }

        .list-group-item.active {
            background: #8F4898;
            border-color: #8F4898;
        }

        .list-group-item:hover {
            background: #4d2a6c;
        }

        .list-group-item.active:hover {
            background: #9f58a8;
        }

        .table-dark {
            --bs-table-bg: transparent;
            --bs-table-border-color: rgba(255, 255, 255, 0.1);
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
