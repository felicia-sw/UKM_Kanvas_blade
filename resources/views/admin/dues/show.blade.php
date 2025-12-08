@extends('admin.layouts.admin')

@section('title', 'Dues Period: ' . $duesPeriod->name)

@section('content')
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.dues.index') }}">Dues Periods</a></li>
            <li class="breadcrumb-item active">{{ $duesPeriod->name }}</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h2 mb-0">{{ $duesPeriod->name }}</h1>
            <p class="text-muted mb-0">
                Amount: Rp {{ number_format($duesPeriod->amount, 0, ',', '.') }} |
                Due Date: {{ $duesPeriod->due_date ? $duesPeriod->due_date->format('d M Y') : 'N/A' }}
            </p>
        </div>
        <a href="{{ route('admin.dues.index') }}" class="btn btn-admin-outline-secondary">
            <i class="bi bi-arrow-left me-2"></i>Back
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Paid Users -->
    <div class="admin-card mb-4">
        <div class="card-body">
            <h3 class="h5 mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i>Paid ({{ $paidUsers->count() }})
            </h3>
            @if ($paidUsers->count() > 0)
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Verified At</th>
                                <th>Verified By</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($paidUsers as $payment)
                                <tr>
                                    <td>{{ $payment->user->name }}</td>
                                    <td>{{ $payment->user->email }}</td>
                                    <td>{{ $payment->verified_at ? $payment->verified_at->format('d M Y H:i') : 'N/A' }}
                                    </td>
                                    <td>{{ $payment->verifiedBy->name ?? 'N/A' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-muted mb-0">No verified payments yet.</p>
            @endif
        </div>
    </div>

    <!-- Pending Payments -->
    <div class="admin-card mb-4">
        <div class="card-body">
            <h3 class="h5 mb-3"><i class="bi bi-clock-fill text-warning me-2"></i>Pending Verification
                ({{ $pendingUsers->count() }})</h3>
            @if ($pendingUsers->count() > 0)
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Payment Proof</th>
                                <th>Submitted At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pendingUsers as $payment)
                                <tr>
                                    <td>{{ $payment->user->name }}</td>
                                    <td>{{ $payment->user->email }}</td>
                                    <td>
                                        @if ($payment->payment_proof)
                                            <a href="{{ Storage::url($payment->payment_proof) }}" target="_blank"
                                                class="btn btn-sm btn-outline-primary">
                                                <i class="bi bi-image"></i> View
                                            </a>
                                        @endif
                                    </td>
                                    <td>{{ $payment->created_at->format('d M Y H:i') }}</td>
                                    <td>
                                        <form action="{{ route('admin.dues-payments.verify', $payment->id) }}"
                                            method="POST" class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="payment_status" value="verified">
                                            <button type="submit" class="btn btn-sm btn-success">
                                                <i class="bi bi-check"></i> Verify
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.dues-payments.verify', $payment->id) }}"
                                            method="POST" class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="payment_status" value="rejected">
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Reject this payment?')">
                                                <i class="bi bi-x"></i> Reject
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-muted mb-0">No pending payments.</p>
            @endif
        </div>
    </div>

    <!-- Unpaid Users -->
    <div class="admin-card">
        <div class="card-body">
            <h3 class="h5 mb-3"><i class="bi bi-x-circle-fill text-danger me-2"></i>Not Paid Yet
                ({{ $unpaidUsers->count() }})</h3>
            @if ($unpaidUsers->count() > 0)
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($unpaidUsers as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-muted mb-0">All members have paid!</p>
            @endif
        </div>
    </div>
@endsection
