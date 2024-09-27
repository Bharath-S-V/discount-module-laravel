<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    // Show all discounts (index view)
    public function index()
    {
        $discounts = Discount::all();
        return view('discounts.index', compact('discounts')); // Return the 'index' view
    }

    // Show the form for creating a new discount
    public function create()
    {
        return view('discounts.form'); // Return the 'form' view for creating a new discount
    }

    // Store a newly created discount in the database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'discount_type' => 'required',
            'value' => 'required|numeric',
        ]);

        $request->merge(['recurring' => $request->has('recurring') ? 1 : 0]);

        Discount::create($request->all());
        return redirect()->route('discounts.index')->with('success', 'Discount created successfully!');
    }

    // Show the form for editing the specified discount
    public function edit($id)
    {
        $discount = Discount::findOrFail($id);
        return view('discounts.form', compact('discount')); // Return the 'form' view with the discount to edit
    }

    // Update the specified discount in the database
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'discount_type' => 'required',
            'value' => 'required|numeric',
        ]);

        $discount = Discount::findOrFail($id);
        $discount->update($request->all());
        return redirect()->route('discounts.index')->with('success', 'Discount updated successfully!');
    }

    // Remove the specified discount from the database
    public function destroy($id)
    {
        $discount = Discount::findOrFail($id);
        $discount->delete();
        return redirect()->route('discounts.index')->with('success', 'Discount deleted successfully!');
    }
}
