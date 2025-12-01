@extends('admin.layouts.admin')

@section('title', 'Financial Recap - ' . $event->title)

@section('content')
<div class="container-fluid py-4">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.events.index') }}">Events</a></li>
            <li class="breadcrumb-item active">Financial Recap</li>
        </ol>
    </nav>

    <!-- Event Info Header -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h3 mb-2">{{ $event->title }}</h1>
                    <p class="text-muted mb-0">
                        <i class="bi bi-calendar-event me-2"></i>
                        {{ $event->start_date->format('M d, Y') }} - {{ $event->end_date->format('M d, Y') }}
                    </p>
                </div>
                <a href="{{ route('admin.events.index') }}" class="btn btn-admin-outline-secondary">
                    <i class="bi bi-arrow-left me-2"></i>Back to Events
                </a>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Financial Summary Cards -->
    <div class="row g-4 mb-4">
        <!-- Total Income (Registrations) -->
        <div class="col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="avatar avatar-lg bg-success bg-opacity-10 text-success rounded">
                                <i class="bi bi-people-fill fs-4"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1">Registration Income</h6>
                            <h4 class="mb-0">Rp {{ number_format($totalRegistrationIncome, 0, ',', '.') }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Manual Income -->
        <div class="col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="avatar avatar-lg bg-info bg-opacity-10 text-info rounded">
                                <i class="bi bi-cash-coin fs-4"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1">Other Income</h6>
                            <h4 class="mb-0">Rp {{ number_format($totalManualIncome, 0, ',', '.') }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Expenses -->
        <div class="col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="avatar avatar-lg bg-danger bg-opacity-10 text-danger rounded">
                                <i class="bi bi-cart-fill fs-4"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1">Total Expenses</h6>
                            <h4 class="mb-0">Rp {{ number_format($totalExpenses, 0, ',', '.') }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Net Balance -->
        <div class="col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="avatar avatar-lg {{ $netBalance >= 0 ? 'bg-success' : 'bg-danger' }} bg-opacity-10 {{ $netBalance >= 0 ? 'text-success' : 'text-danger' }} rounded">
                                <i class="bi bi-wallet2 fs-4"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1">Net Balance</h6>
                            <h4 class="mb-0 {{ $netBalance >= 0 ? 'text-success' : 'text-danger' }}">
                                Rp {{ number_format($netBalance, 0, ',', '.') }}
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Budget Progress -->
    @if($event->budget)
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="mb-0">Budget Usage</h5>
                <span class="badge {{ $budgetUsage > 100 ? 'bg-danger' : ($budgetUsage > 80 ? 'bg-warning' : 'bg-success') }}">
                    {{ number_format($budgetUsage, 1) }}%
                </span>
            </div>
            <div class="progress" style="height: 30px;">
                <div class="progress-bar {{ $budgetUsage > 100 ? 'bg-danger' : ($budgetUsage > 80 ? 'bg-warning' : 'bg-success') }}" 
                     role="progressbar" 
                     style="width: {{ min($budgetUsage, 100) }}%;" 
                     aria-valuenow="{{ $budgetUsage }}" 
                     aria-valuemin="0" 
                     aria-valuemax="100">
                    Rp {{ number_format($totalExpenses, 0, ',', '.') }} / Rp {{ number_format($event->budget, 0, ',', '.') }}
                </div>
            </div>
            @if($event->isBudgetExceeded())
                <div class="alert alert-danger mt-3 mb-0">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    <strong>Warning:</strong> Budget exceeded by Rp {{ number_format($totalExpenses - $event->budget, 0, ',', '.') }}
                </div>
            @endif
        </div>
    </div>
    @endif

    <!-- Income & Expense Management -->
    <div class="row g-4">
        <!-- Income Section -->
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="bi bi-arrow-down-circle text-success me-2"></i>Income (Pemasukan)</h5>
                    <a href="{{ route('admin.events.finances.income.create', $event->id) }}" class="btn btn-success btn-sm">
                        <i class="bi bi-plus-circle me-1"></i>Add Income
                    </a>
                </div>
                <div class="card-body">
                    @if($incomes->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Date</th>
                                        <th>Item</th>
                                        <th class="text-end">Amount</th>
                                        <th class="text-center">Quantity</th>
                                        <th class="text-end">Total</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($incomes as $income)
                                    <tr>
                                        <td>{{ $income->transaction_date->format('M d, Y') }}</td>
                                        <td>
                                            <strong>{{ $income->item_name }}</strong>
                                            @if($income->description)
                                                <br><small class="text-muted">{{ $income->description }}</small>
                                            @endif
                                        </td>
                                        <td class="text-end">
                                            Rp {{ number_format($income->amount, 0, ',', '.') }}
                                        </td>
                                        <td class="text-center">
                                            {{ $income->quantity }}
                                        </td>
                                        <td class="text-end text-success fw-bold">
                                            Rp {{ number_format($income->total, 0, ',', '.') }}
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.events.finances.edit', [$event->id, $income->id]) }}" 
                                               class="btn btn-sm btn-outline-primary me-1">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('admin.events.finances.destroy', [$event->id, $income->id]) }}" 
                                                  method="POST" 
                                                  class="d-inline"
                                                  onsubmit="return confirm('Are you sure you want to delete this income entry?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot class="table-light">
                                    <tr>
                                        <td colspan="4" class="text-end"><strong>Grand Total:</strong></td>
                                        <td class="text-end"><strong>Rp {{ number_format($totalManualIncome, 0, ',', '.') }}</strong></td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="bi bi-inbox fs-1 text-muted"></i>
                            <p class="text-muted mt-2">No income entries yet</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Expense Section -->
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="bi bi-arrow-up-circle text-danger me-2"></i>Expenses (Pengeluaran)</h5>
                    <a href="{{ route('admin.events.finances.expense.create', $event->id) }}" class="btn btn-danger btn-sm">
                        <i class="bi bi-plus-circle me-1"></i>Add Expense
                    </a>
                </div>
                <div class="card-body">
                    @if($expenses->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Date</th>
                                        <th>Item</th>
                                        <th class="text-end">Amount</th>
                                        <th class="text-center">Quantity</th>
                                        <th class="text-end">Total</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($expenses as $expense)
                                    <tr>
                                        <td>{{ $expense->transaction_date->format('M d, Y') }}</td>
                                        <td>
                                            <strong>{{ $expense->item_name }}</strong>
                                            @if($expense->description)
                                                <br><small class="text-muted">{{ $expense->description }}</small>
                                            @endif
                                        </td>
                                        <td class="text-end">
                                            Rp {{ number_format($expense->amount, 0, ',', '.') }}
                                        </td>
                                        <td class="text-center">
                                            {{ $expense->quantity }}
                                        </td>
                                        <td class="text-end text-danger fw-bold">
                                            Rp {{ number_format($expense->total, 0, ',', '.') }}
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.events.finances.edit', [$event->id, $expense->id]) }}" 
                                               class="btn btn-sm btn-outline-primary me-1">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('admin.events.finances.destroy', [$event->id, $expense->id]) }}" 
                                                  method="POST" 
                                                  class="d-inline"
                                                  onsubmit="return confirm('Are you sure you want to delete this expense entry?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot class="table-light">
                                    <tr>
                                        <td colspan="4" class="text-end"><strong>Grand Total:</strong></td>
                                        <td class="text-end"><strong>Rp {{ number_format($totalExpenses, 0, ',', '.') }}</strong></td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="bi bi-inbox fs-1 text-muted"></i>
                            <p class="text-muted mt-2">No expense entries yet</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.avatar {
    width: 48px;
    height: 48px;
    display: flex;
    align-items: center;
    justify-content: center;
}
</style>
@endsection
