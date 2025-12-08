<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DuesPeriod;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DuesPeriodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $duesPeriods = DuesPeriod::withCount('payments')
            ->orderBy('due_date', 'desc')
            ->paginate(10);

        return view('admin.dues.index', compact('duesPeriods'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.dues.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'due_date' => 'required|date',
            'description' => 'nullable|string',
        ]);

        $duesPeriod = DuesPeriod::create($validated);

        // Notify all members about the new dues period
        $members = User::whereHas('roles', function ($query) {
            $query->where('name', 'Member');
        })->get();

        foreach ($members as $member) {
            Notification::create([
                'user_id' => $member->id,
                'type' => 'dues_notification',
                'message' => "New dues period: {$duesPeriod->name} - Rp " . number_format($duesPeriod->amount, 0, ',', '.') . " (Due: " . $duesPeriod->due_date->format('d M Y') . ")",
                'is_read' => false,
                'link_url' => route('dues.payment.create', $duesPeriod->id),
            ]);
        }

        return redirect()->route('admin.dues.index')
            ->with('success', 'Dues period created successfully and members have been notified.');
    }

    /**
     * Display the specified resource.
     */
    public function show(DuesPeriod $duesPeriod)
    {
        $duesPeriod->load(['payments.user']);

        $paidUsers = $duesPeriod->payments()
            ->where('payment_status', 'verified')
            ->with(['user', 'verifiedBy'])
            ->get();

        $pendingUsers = $duesPeriod->payments()
            ->where('payment_status', 'pending')
            ->with('user')
            ->get();

        $unpaidUsers = User::whereHas('roles', function ($query) {
            $query->where('name', 'Member');
        })->whereDoesntHave('duesPayments', function ($query) use ($duesPeriod) {
            $query->where('dues_period_id', $duesPeriod->id);
        })->get();

        return view('admin.dues.show', compact('duesPeriod', 'paidUsers', 'pendingUsers', 'unpaidUsers'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DuesPeriod $duesPeriod)
    {
        return view('admin.dues.edit', compact('duesPeriod'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DuesPeriod $duesPeriod)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'due_date' => 'required|date',
            'description' => 'nullable|string',
        ]);

        $duesPeriod->update($validated);

        return redirect()->route('admin.dues.index')
            ->with('success', 'Dues period updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DuesPeriod $duesPeriod)
    {
        $duesPeriod->delete();

        return redirect()->route('admin.dues.index')
            ->with('success', 'Dues period deleted successfully.');
    }
}
