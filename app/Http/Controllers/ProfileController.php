<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $orders = $user->orders()->latest()->take(5)->get(); // Recent orders
        $addresses = $user->addresses;

        return view('profile.show', compact('user', 'orders', 'addresses'));
    }

    public function edit()
    {
        $user = Auth::user();
        $addresses = $user->addresses;

        return view('profile.edit', compact('user', 'addresses'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'phone' => 'nullable|string|max:20',
            'preferences' => 'nullable|string|max:1000',
        ]);

        $user->update($request->only(['name', 'email', 'phone', 'preferences']));

        return redirect()->route('profile.show')->with('success', 'Profile updated successfully.');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        $user->update(['password' => Hash::make($request->password)]);

        return redirect()->route('profile.show')->with('success', 'Password changed successfully.');
    }

    public function addAddress(Request $request)
    {
        $request->validate([
            'address_line' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'nullable|string|max:255',
            'zip_code' => 'nullable|string|max:10',
            'country' => 'required|string|max:255',
        ]);

        $user = Auth::user();

        if ($request->is_default) {
            $user->addresses()->update(['is_default' => false]);
        }

        $user->addresses()->create($request->only(['address_line', 'city', 'state', 'zip_code', 'country', 'is_default']));

        return redirect()->route('profile.edit')->with('success', 'Address added successfully.');
    }

    public function deleteAddress($id)
    {
        $address = Address::where('user_id', Auth::id())->findOrFail($id);
        $address->delete();

        return redirect()->route('profile.edit')->with('success', 'Address deleted successfully.');
    }
}
