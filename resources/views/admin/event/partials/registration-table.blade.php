<div class="card">
    <div class="card-body">
        @if ($registrations->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th width="50">
                                <input type="checkbox" id="selectAll" title="Select All Pending">
                            </th>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>NIM</th>
                            <th>Jurusan</th>
                            <th>University</th>
                            <th>Phone</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Registered</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($registrations as $registration)
                            <tr>
                                <td>
                                    @if ($registration->payment_status === 'pending')
                                        <input type="checkbox" class="verify-checkbox"
                                            data-registration-id="{{ $registration->id }}"
                                            data-user-name="{{ $registration->user->name }}" title="Verify Payment">
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>#{{ $registration->id }}</td>
                                <td>
                                    <strong>{{ $registration->user->name }}</strong>
                                </td>
                                <td>
                                    <small class="text-muted">{{ $registration->user->email }}</small>
                                </td>
                                <td>{{ $registration->user->profile?->nim ?? 'N/A' }}</td>
                                <td>{{ $registration->user->profile?->jurusan ?? 'N/A' }}</td>
                                <td>{{ $registration->user->profile?->asal_universitas ?? 'N/A' }}</td>
                                <td>{{ $registration->user->profile?->no_telp ?? 'N/A' }}</td>
                                <td>
                                    <strong>Rp {{ number_format($registration->amount_paid, 0, ',', '.') }}</strong>
                                </td>
                                <td>
                                    @if ($registration->payment_status === 'verified')
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
                                        @if ($registration->payment_proof)
                                            <button type="button" class="btn btn-outline-primary"
                                                onclick="viewPaymentProof('{{ Storage::url($registration->payment_proof) }}')"
                                                title="View Payment Proof">
                                                <i class="bi bi-image"></i>
                                            </button>
                                        @endif

                                        @if ($registration->payment_status === 'pending')
                                            <form
                                                action="{{ route('admin.registrations.update-status', $registration) }}"
                                                method="POST" class="d-inline reject-form">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="payment_status" value="rejected">
                                                <button type="submit" class="btn btn-outline-danger" title="Reject"
                                                    onclick="return confirm('Reject this registration?')">
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
                            <td colspan="9" class="text-end"><strong>Total Income (Verified):</strong></td>
                            <td colspan="3">
                                <strong class="text-success fs-5">
                                    Rp
                                    {{ number_format($registrations->where('payment_status', 'verified')->sum('amount_paid'), 0, ',', '.') }}
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const selectAllCheckbox = document.getElementById('selectAll');
        const verifyCheckboxes = document.querySelectorAll('.verify-checkbox');

        // Track which checkboxes are being processed to prevent multiple triggers
        const processingCheckboxes = new Set();

        // Select all functionality
        if (selectAllCheckbox) {
            selectAllCheckbox.addEventListener('change', function() {
                verifyCheckboxes.forEach(checkbox => {
                    // Only check/uncheck if not currently being processed
                    if (!processingCheckboxes.has(checkbox)) {
                        checkbox.checked = this.checked;
                    }
                });
            });
        }

        // Handle individual checkbox verification
        verifyCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function(e) {
                // Prevent multiple triggers
                if (processingCheckboxes.has(this)) {
                    e.preventDefault();
                    return;
                }

                if (this.checked && !this.disabled) {
                    const registrationId = this.getAttribute('data-registration-id');
                    const userName = this.getAttribute('data-user-name');

                    // Mark as processing immediately
                    processingCheckboxes.add(this);
                    this.disabled = true;

                    if (confirm(
                            `Verify payment for ${userName}? A WhatsApp confirmation will be sent.`
                            )) {
                        verifyRegistration(registrationId, this);
                    } else {
                        // User cancelled - reset checkbox
                        this.checked = false;
                        this.disabled = false;
                        processingCheckboxes.delete(this);
                    }
                }
            });
        });

        function verifyRegistration(registrationId, checkbox) {
            // Create form data
            const formData = new FormData();
            formData.append('_token', '{{ csrf_token() }}');
            formData.append('_method', 'PATCH');
            formData.append('payment_status', 'verified');

            // Send AJAX request
            const url = `/admin/registrations/${registrationId}/status`;
            fetch(url, {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                    },
                    body: formData
                })
                .then(response => {
                    // Check if response is JSON
                    const contentType = response.headers.get('content-type');
                    if (contentType && contentType.includes('application/json')) {
                        return response.json();
                    } else {
                        // If not JSON, assume success and reload
                        return {
                            success: true,
                            message: 'Payment verified successfully!'
                        };
                    }
                })
                .then(data => {
                    if (data.success) {
                        // Show success message
                        showAlert('success', data.message ||
                            'Payment verified successfully! WhatsApp message sent.');
                        // Reload page after 1.5 seconds to show updated status
                        setTimeout(() => {
                            window.location.reload();
                        }, 1500);
                    } else {
                        showAlert('danger', data.message || 'Failed to verify payment.');
                        checkbox.checked = false;
                        checkbox.disabled = false;
                        processingCheckboxes.delete(checkbox);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showAlert('danger', 'An error occurred while verifying payment. Please try again.');
                    checkbox.checked = false;
                    checkbox.disabled = false;
                    processingCheckboxes.delete(checkbox);
                });
        }

        function showAlert(type, message) {
            // Remove existing alerts
            const existingAlerts = document.querySelectorAll('.verification-alert');
            existingAlerts.forEach(alert => alert.remove());

            // Create alert
            const alertDiv = document.createElement('div');
            alertDiv.className = `alert alert-${type} alert-dismissible fade show verification-alert`;
            alertDiv.setAttribute('role', 'alert');
            alertDiv.innerHTML = `
                <i class="bi bi-${type === 'success' ? 'check-circle' : 'exclamation-triangle'} me-2"></i>${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            `;

            // Insert at top of content
            const content = document.querySelector('.container-fluid');
            if (content) {
                content.insertBefore(alertDiv, content.firstChild);
            }
        }
    });
</script>
