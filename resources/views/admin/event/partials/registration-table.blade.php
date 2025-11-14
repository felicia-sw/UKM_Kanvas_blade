<div class="card">
    <div class="card-body">
        @if($registrations->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>NIM</th>
                            <th>Jurusan</th>
                            <th>University</th>
                            <th>Phone</th>
                            <th>Kanvas Member</th>
                            <th>Days</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Registered</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($registrations as $registration)
                        <tr>
                            <td>#{{ $registration->id }}</td>
                            <td>
                                <div>
                                    <strong>{{ $registration->name }}</strong><br>
                                    <small class="text-muted">{{ $registration->user->email }}</small>
                                </div>
                            </td>
                            <td>{{ $registration->nim }}</td>
                            <td>{{ $registration->jurusan }}</td>
                            <td>{{ $registration->asal_universitas }}</td>
                            <td>{{ $registration->nomor_telp }}</td>
                            <td>
                                @if($registration->is_kanvas_member)
                                    <span class="badge bg-primary">Yes</span>
                                @else
                                    <span class="badge bg-secondary">No</span>
                                @endif
                            </td>
                            <td>
                                @if($registration->days_attending)
                                    <span class="badge bg-info">{{ ucfirst(str_replace('_', ' ', $registration->days_attending)) }}</span>
                                @else
                                    <span class="text-muted">N/A</span>
                                @endif
                            </td>
                            <td>
                                <strong>Rp {{ number_format($registration->amount_paid, 0, ',', '.') }}</strong>
                            </td>
                            <td>
                                @if($registration->payment_status === 'verified')
                                    <span class="badge bg-success">
                                        <i class="bi bi-check-circle"></i> Verified
                                    </span>
                                @elseif($registration->payment_status === 'rejected')
                                    <span class="badge bg-danger">
                                        <i class="bi bi-x-circle"></i> Rejected
                                    </span>
                                @else
                                    <span class="badge bg-warning text-dark">
                                        <i class="bi bi-clock"></i> Pending
                                    </span>
                                @endif
                            </td>
                            <td>
                                <small>{{ $registration->created_at->format('d M Y, H:i') }}</small>
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm" role="group">
                                    <button type="button" class="btn btn-outline-primary" onclick="viewPaymentProof('{{ Storage::url($registration->payment_proof) }}')" title="View Payment Proof">
                                        <i class="bi bi-image"></i>
                                    </button>
                                    
                                    @if($registration->payment_status === 'pending')
                                        <form action="{{ route('admin.registrations.update-status', $registration) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="payment_status" value="verified">
                                            <button type="submit" class="btn btn-outline-success" title="Verify" onclick="return confirm('Verify this registration?')">
                                                <i class="bi bi-check-lg"></i>
                                            </button>
                                        </form>
                                        
                                        <form action="{{ route('admin.registrations.update-status', $registration) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="payment_status" value="rejected">
                                            <button type="submit" class="btn btn-outline-danger" title="Reject" onclick="return confirm('Reject this registration?')">
                                                <i class="bi bi-x-lg"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="table-light">
                        <tr>
                            <td colspan="8" class="text-end"><strong>Total Income (Verified):</strong></td>
                            <td colspan="4">
                                <strong class="text-success fs-5">
                                    Rp {{ number_format($registrations->where('payment_status', 'verified')->sum('amount_paid'), 0, ',', '.') }}
                                </strong>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        @else
            <div class="text-center py-5">
                <i class="bi bi-inbox fs-1 text-muted"></i>
                <p class="text-muted mt-3">No registrations found.</p>
            </div>
        @endif
    </div>
</div>
