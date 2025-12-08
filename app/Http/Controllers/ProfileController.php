<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Profile;
use App\Models\DuesPeriod;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $profile = $user->profile;

        // Get notifications
        $notifications = $user->customNotifications()->latest()->paginate(10, ['*'], 'notifications_page');

        // Get dues payments
        $duesPayments = $user->duesPayments()->with('duesPeriod')->latest()->paginate(10, ['*'], 'dues_page');

        // Get unpaid dues periods
        $unpaidDues = DuesPeriod::where('due_date', '>=', now())
            ->whereDoesntHave('payments', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->orderBy('due_date', 'asc')
            ->get();

        return view('profile.show', compact('user', 'profile', 'notifications', 'duesPayments', 'unpaidDues'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'nim' => 'nullable|string|max:255',
            'jurusan' => 'nullable|string|max:255',
            'asal_universitas' => 'nullable|string|max:255',
            'no_telp' => 'nullable|string|max:20',
        ]);

        // Update user
        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        // Update or create profile
        $user->profile()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'nim' => $validated['nim'],
                'jurusan' => $validated['jurusan'],
                'asal_universitas' => $validated['asal_universitas'],
                'no_telp' => $validated['no_telp'],
            ]
        );

        return redirect()->route('profile.show')->with('success', 'Profile updated successfully!');
    }

    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($validated['current_password'], $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        $user->update([
            'password' => Hash::make($validated['new_password']),
        ]);

        return redirect()->route('profile.show')->with('success', 'Password updated successfully!');
    }
}
