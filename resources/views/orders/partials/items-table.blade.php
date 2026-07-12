{{-- Shared order items table (user + admin order detail pages). --}}
{{-- Expects: $order; optional $tableClass (default 'table'). --}}
<h5 class="card-title mb-3">Order Items ({{ $order->items->count() }} items)</h5>
@if ($order->items->count() > 0)
    <div class="table-responsive">
        <table class="{{ $tableClass ?? 'table' }}">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->items as $item)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                @if ($item->merchandise)
                                    <img src="{{ $item->merchandise->image_path }}"
                                        alt="{{ $item->merchandise->name }}" class="img-thumbnail me-3"
                                        style="width: 60px; height: 60px; object-fit: cover;">
                                    <div>
                                        <strong>{{ $item->merchandise->name }}</strong>
                                    </div>
                                @else
                                    <div>
                                        <strong class="text-muted">Product Deleted</strong>
                                    </div>
                                @endif
                            </div>
                        </td>
                        <td>{{ $item->quantity }}</td>
                        <td>Rp {{ number_format($item->price_at_purchase, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($item->quantity * $item->price_at_purchase, 0, ',', '.') }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3" class="text-end">Grand Total:</th>
                    <th>Rp {{ number_format($order->grand_total, 0, ',', '.') }}</th>
                </tr>
            </tfoot>
        </table>
    </div>
@else
  
    <div class="table-responsive">
        <table class="{{ $tableClass ?? 'table' }}">
            <tfoot>
                <tr>
                    <th class="text-end">Grand Total:</th>
                    <th>Rp {{ number_format($order->grand_total, 0, ',', '.') }}</th>
                </tr>
            </tfoot>
        </table>
    </div>
@endif
