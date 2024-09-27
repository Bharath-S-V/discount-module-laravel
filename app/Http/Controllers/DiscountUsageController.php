<?php

namespace App\Http\Controllers;

use App\Models\DiscountUsage;
use Illuminate\Http\Request;

class DiscountUsageController extends Controller
{
    // Display a listing of the discount usages
    public function index()
    {
        // Eager load user, booking, product, and discount relationships
        $discountUsages = DiscountUsage::with(['discount', 'user', 'booking', 'product'])->get();
        return view('discount_usages.index', compact('discountUsages'));
    }



    // Show the form for creating a new discount usage
    public function create()
    {
        $users = \App\Models\User::all();        // Get all users
        $bookings = \App\Models\Booking::all();  // Get all bookings
        $discounts = \App\Models\Discount::all(); // Get all discounts

        return view('discount_usages.form', compact('users', 'bookings', 'discounts'));
    }

    // Store a newly created discount usage in storage
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'booking_id' => 'required|exists:bookings,id',
            'discount_id' => 'required|exists:discounts,id',
            'usage_date' => 'required|date',
        ]);

        DiscountUsage::create($request->all());
        return redirect()->route('discount_usages.index')->with('success', 'Discount usage created successfully!');
    }

    // Show the form for editing the specified discount usage
    public function edit($id)
    {
        $discountUsage = DiscountUsage::findOrFail($id);
        $users = \App\Models\User::all();
        $bookings = \App\Models\Booking::all();
        $discounts = \App\Models\Discount::all();

        return view('discount_usages.form', compact('discountUsage', 'users', 'bookings', 'discounts'));
    }

    // Update the specified discount usage in storage
    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'booking_id' => 'required|exists:bookings,id',
            'discount_id' => 'required|exists:discounts,id',
            'usage_date' => 'required|date',
        ]);

        $discountUsage = DiscountUsage::findOrFail($id);
        $discountUsage->update($request->all());

        return redirect()->route('discount_usages.index')->with('success', 'Discount usage updated successfully!');
    }

    // Remove the specified discount usage from storage
    public function destroy($id)
    {
        $discountUsage = DiscountUsage::findOrFail($id);
        $discountUsage->delete();

        return redirect()->route('discount_usages.index')->with('success', 'Discount usage deleted successfully!');
    }
}
