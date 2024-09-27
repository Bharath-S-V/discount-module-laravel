<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all(); // Fetch all products
        return view('products.index', compact('products'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id); // Fetch the product by ID
        $users = User::all(); // Fetch all users

        // Pass both the product and users to the view
        return view('products.show', compact('product', 'users'));
    }
}
