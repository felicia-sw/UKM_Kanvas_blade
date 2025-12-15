<?php

namespace App\Http\Controllers;

use App\Models\MerchandiseOrder;
use App\Models\MerchandiseOrderItem;
use App\Models\ShoppingCart;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class MerchandiseOrderController extends Controller
{
    /**
     * Display user's order history
     */
    public function index()
    {
        $orders = Auth::user()->merchandiseOrders()
            ->with('items.merchandise')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('orders.index', compact('orders'));
    }

    /**
     * Admin: Display all orders
     */
    public function adminIndex()
    {
        $orders = MerchandiseOrder::with(['user', 'items.merchandise'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Show order details
     */
    public function show(MerchandiseOrder $order)
    {
        // Ensure order belongs to current user (unless admin)
        $user = Auth::user();
        $isAdmin = $user instanceof User && $user->hasRole('Admin');

        if ($order->user_id !== Auth::id() && !$isAdmin) {
            abort(403);
        }

        $order->load('items.merchandise', 'user');

        // Use admin view if admin, otherwise user view
        if ($isAdmin) {
            return view('admin.orders.show', compact('order'));
        }

        return view('orders.show', compact('order'));
    }

    /**
     * Create order from cart
     */
    public function store(Request $request)
    {
        $cart = Auth::user()->shoppingCart;

        if (!$cart || $cart->items()->count() === 0) {
            return redirect()->route('cart.index')
                ->with('error', 'Your cart is empty.');
        }

        $validated = $request->validate([
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $cartItems = $cart->items()->with('merchandise')->get();
        $grandTotal = $cartItems->sum(function ($item) {
            return $item->quantity * $item->merchandise->price;
        });

        // Check stock availability
        foreach ($cartItems as $cartItem) {
            if ($cartItem->quantity > $cartItem->merchandise->stock) {
                return redirect()->route('cart.index')
                    ->with('error', "Insufficient stock for {$cartItem->merchandise->name}.");
            }
        }

        $paymentProofPath = $request->file('payment_proof')->store('merchandise-payments', 'public');

        $order = MerchandiseOrder::create([
            'user_id' => Auth::id(),
            'grand_total' => $grandTotal,
            'payment_proof' => $paymentProofPath,
            'payment_status' => 'pending',
            'pickup_status' => 'pending',
        ]);

        // Create order items
        foreach ($cartItems as $cartItem) {
            MerchandiseOrderItem::create([
                'order_id' => $order->id,
                'merchandise_id' => $cartItem->merchandise_id,
                'quantity' => $cartItem->quantity,
                'price_at_purchase' => $cartItem->merchandise->price,
            ]);

            // Reduce stock
            $cartItem->merchandise->decrement('stock', $cartItem->quantity);
        }

        // Clear cart
        $cart->items()->delete();

        // Notify user
        Notification::create([
            'user_id' => Auth::id(),
            'type' => 'merchandise_order',
            'message' => "Your order #{$order->id} has been placed. Payment verification pending.",
            'is_read' => false,
            'link_url' => route('orders.show', $order->id),
        ]);

        return redirect()->route('orders.show', $order->id)
            ->with('success', 'Order placed successfully! Please wait for payment verification.');
    }

    /**
     * Admin: Verify payment
     */
    public function verifyPayment(Request $request, MerchandiseOrder $order)
    {
        $validated = $request->validate([
            'payment_status' => 'required|in:verified,rejected',
        ]);

        $order->update([
            'payment_status' => $validated['payment_status'],
            'verified_at' => $validated['payment_status'] === 'verified' ? now() : null,
        ]);

        // Notify user
        $status = $validated['payment_status'] === 'verified' ? 'verified' : 'rejected';
        Notification::create([
            'user_id' => $order->user_id,
            'type' => 'merchandise_order',
            'message' => "Your order #{$order->id} payment has been {$status}.",
            'is_read' => false,
            'link_url' => route('orders.show', $order->id),
        ]);

        return redirect()->back()
            ->with('success', "Payment {$validated['payment_status']} successfully.");
    }

    /**
     * Admin: Update pickup status
     */
    public function updatePickupStatus(Request $request, MerchandiseOrder $order)
    {
        $validated = $request->validate([
            'pickup_status' => 'required|in:pending,ready,picked_up',
        ]);

        $order->update(['pickup_status' => $validated['pickup_status']]);

        if ($validated['pickup_status'] === 'ready') {
            Notification::create([
                'user_id' => $order->user_id,
                'type' => 'merchandise_order',
                'message' => "Your order #{$order->id} is ready for pickup!",
                'is_read' => false,
                'link_url' => route('orders.show', $order->id),
            ]);
        }

        return redirect()->back()
            ->with('success', 'Pickup status updated successfully.');
    }
}
