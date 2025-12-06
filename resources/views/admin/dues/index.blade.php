@extends('admin.layouts.admin')

@section('title', 'Dues Periods Management')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h2 mb-0">Dues Periods Management</h1>
        <a href="{{ route('admin.dues.create') }}" class="btn btn-admin-primary">
            <i class="bi bi-plus-circle me-2"></i>Create New Dues Period
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="admin-card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Amount</th>
                            <th>Due Date</th>
                            <th>Payments</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($duesPeriods as $period)
                            <tr>
                                <td>{{ $period->name }}</td>
                                <td>Rp {{ number_format($period->amount, 0, ',', '.') }}</td>
                                <td>{{ $period->due_date->format('d M Y') }}</td>
                                <td>
                                    <span class="badge bg-info">{{ $period->payments_count }} payments</span>
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('admin.dues.show', $period->id) }}" class="btn btn-sm btn-admin-outline-primary">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.dues.edit', $period->id) }}" class="btn btn-sm btn-admin-outline-secondary">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('admin.dues.destroy', $period->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-admin-outline-danger" 
                                                onclick="return confirm('Are you sure?')">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">No dues periods found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $duesPeriods->links() }}
        </div>
    </div>
@endsection

