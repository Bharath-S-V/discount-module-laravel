<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\User; // Import User model
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::all();
        return view('bookings.index', compact('bookings'));
    }

    public function create()
    {
        return view('bookings.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_name' => 'required|string',
            'booking_date' => 'required|date',
            'status' => 'required',
        ]);

        // Find the user by name
        $user = User::where('name', $request->user_name)->first();

        if (!$user) {
            return redirect()->back()->withErrors(['user_name' => 'User not found. Please enter a valid user name.'])->withInput();
        }

        // Store booking with the user's ID
        Booking::create([
            'user_id' => $user->id,
            'booking_date' => $request->booking_date,
            'status' => $request->status,
        ]);

        return redirect()->route('bookings.index')->with('success', 'Booking created successfully.');
    }

    public function edit($id)
    {
        $booking = Booking::findOrFail($id);
        return view('bookings.form', compact('booking'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'user_name' => 'required|string',
            'booking_date' => 'required|date',
            'status' => 'required',
        ]);

        // Find the user by name
        $user = User::where('name', $request->user_name)->first();

        if (!$user) {
            return redirect()->back()->withErrors(['user_name' => 'User not found. Please enter a valid user name.'])->withInput();
        }

        $booking = Booking::findOrFail($id);
        $booking->update([
            'user_id' => $user->id,
            'booking_date' => $request->booking_date,
            'status' => $request->status,
        ]);

        return redirect()->route('bookings.index')->with('success', 'Booking updated successfully.');
    }

    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();

        return redirect()->route('bookings.index')->with('success', 'Booking deleted successfully.');
    }
}
