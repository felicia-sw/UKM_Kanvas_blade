<?php

namespace App\Http\Controllers;

use App\Models\DuesPeriod;
use App\Models\DuesPayment;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DuesPaymentController extends Controller
{
    /**
     * Display user's dues payment history
     */
    public function index()
    {
        $payments = Auth::user()->duesPayments()
            ->with('duesPeriod')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
        $currentDues = DuesPeriod::where('due_date', '>=', now())
            ->orderBy('due_date', 'asc')
            ->get();
        
        return view('dues.index', compact('payments', 'currentDues'));
    }

    /**
     * Show form to submit payment for a dues period
     */
    public function create(DuesPeriod $duesPeriod)
    {
        // Check if user already paid
        $existingPayment = DuesPayment::where('user_id', Auth::id())
            ->where('dues_period_id', $duesPeriod->id)
            ->first();
        
        if ($existingPayment) {
            return redirect()->route('dues.index')
                ->with('info', 'You have already submitted payment for this period.');
        }
        
        return view('dues.create', compact('duesPeriod'));
    }

    /**
     * Store payment submission
     */
    public function store(Request $request, DuesPeriod $duesPeriod)
    {
        $validated = $request->validate([
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Check if user already paid
        $existingPayment = DuesPayment::where('user_id', Auth::id())
            ->where('dues_period_id', $duesPeriod->id)
            ->first();
        
        if ($existingPayment) {
            return redirect()->back()
                ->with('error', 'You have already submitted payment for this period.');
        }

        $payment = DuesPayment::create([
            'user_id' => Auth::id(),
            'dues_period_id' => $duesPeriod->id,
            'payment_proof' => $request->file('payment_proof'),
            'payment_status' => 'pending',
        ]);

        // Notify user
        Notification::create([
            'user_id' => Auth::id(),
            'type' => 'dues_payment',
            'message' => "Your payment for {$duesPeriod->name} has been submitted and is pending verification.",
            'is_read' => false,
            'link_url' => route('dues.index'),
        ]);

        return redirect()->route('dues.index')
            ->with('success', 'Payment proof submitted successfully! Please wait for admin verification.');
    }

    /**
     * Admin: Verify or reject payment
     */
    public function verify(Request $request, DuesPayment $payment)
    {
        $validated = $request->validate([
            'payment_status' => 'required|in:verified,rejected',
        ]);

        $payment->update([
            'payment_status' => $validated['payment_status'],
            'verified_by' => Auth::id(),
            'verified_at' => now(),
        ]);

        // Notify user
        $status = $validated['payment_status'] === 'verified' ? 'verified' : 'rejected';
        Notification::create([
            'user_id' => $payment->user_id,
            'type' => 'dues_payment',
            'message' => "Your payment for {$payment->duesPeriod->name} has been {$status}.",
            'is_read' => false,
            'link_url' => route('dues.index'),
        ]);

        return redirect()->back()
            ->with('success', "Payment {$validated['payment_status']} successfully.");
    }
}
