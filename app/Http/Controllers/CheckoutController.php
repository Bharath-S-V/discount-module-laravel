<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use App\Models\DiscountUsage;
use App\Models\Product;
use App\Models\User; // Import User model
use Illuminate\Http\Request;
use App\Models\Booking;

class CheckoutController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $discounts = Discount::all();
        $users = User::all(); // Fetch all users
        return view('checkout.index', compact('products', 'discounts', 'users'));
    }

    public function process(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'discount_id' => 'nullable|exists:discounts,id',
            'user_id' => 'required|exists:users,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::find($request->product_id);
        $totalPrice = $product->price * $request->quantity;
        $booking = Booking::where('user_id', $request->user_id)->latest()->first(); // Fetch the latest booking for the user

        if ($request->filled('discount_id')) {
            $discount = Discount::find($request->discount_id);
            if ($discount->discount_type === 'percentage') {
                $totalPrice -= $totalPrice * ($discount->value / 100);
            } else {
                $totalPrice -= $discount->value;
            }

            // Log discount usage
            DiscountUsage::create([
                'user_id' => $request->user_id,
                'booking_id' => $booking->id,
                'discount_id' => $discount->id,
                'product_id' => $product->id, // Add product_id to DiscountUsage
                'usage_date' => now(),
            ]);
        }

        // Simulate order creation
        return redirect()->back()->with('success', "Order placed successfully! Total Price: $totalPrice");
    }
}
