<?php

namespace App\Http\Controllers;

use App\Models\Merchandise;
use App\Models\ShoppingCart;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShoppingCartController extends Controller
{
    /**
     * Display the shopping cart
     */
    public function index()
    {
        $cart = Auth::user()->shoppingCart;
        
        if (!$cart) {
            $cart = ShoppingCart::create(['user_id' => Auth::id()]);
        }
        
        $cartItems = $cart->items()->with('merchandise')->get();
        $total = $cartItems->sum(function($item) {
            return $item->quantity * $item->merchandise->price;
        });
        
        return view('cart.index', compact('cartItems', 'total'));
    }

    /**
     * Add item to cart
     */
    public function add(Request $request, Merchandise $merchandise)
    {
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1|max:' . $merchandise->stock,
        ]);

        $cart = Auth::user()->shoppingCart;
        
        if (!$cart) {
            $cart = ShoppingCart::create(['user_id' => Auth::id()]);
        }

        // Check if item already in cart
        $cartItem = $cart->items()->where('merchandise_id', $merchandise->id)->first();
        
        if ($cartItem) {
            $newQuantity = $cartItem->quantity + $validated['quantity'];
            
            if ($newQuantity > $merchandise->stock) {
                return redirect()->back()
                    ->with('error', 'Not enough stock available.');
            }
            
            $cartItem->update(['quantity' => $newQuantity]);
        } else {
            $cart->items()->create([
                'merchandise_id' => $merchandise->id,
                'quantity' => $validated['quantity'],
            ]);
        }

        return redirect()->route('cart.index')
            ->with('success', 'Item added to cart successfully.');
    }

    /**
     * Update cart item quantity
     */
    public function update(Request $request, CartItem $cartItem)
    {
        // Ensure cart item belongs to current user
        if ($cartItem->shoppingCart->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'quantity' => 'required|integer|min:1|max:' . $cartItem->merchandise->stock,
        ]);

        $cartItem->update(['quantity' => $validated['quantity']]);

        return redirect()->route('cart.index')
            ->with('success', 'Cart updated successfully.');
    }

    /**
     * Remove item from cart
     */
    public function remove(CartItem $cartItem)
    {
        // Ensure cart item belongs to current user
        if ($cartItem->shoppingCart->user_id !== Auth::id()) {
            abort(403);
        }

        $cartItem->delete();

        return redirect()->route('cart.index')
            ->with('success', 'Item removed from cart.');
    }

    /**
     * Clear entire cart
     */
    public function clear()
    {
        $cart = Auth::user()->shoppingCart;
        
        if ($cart) {
            $cart->items()->delete();
        }

        return redirect()->route('cart.index')
            ->with('success', 'Cart cleared successfully.');
    }
}
