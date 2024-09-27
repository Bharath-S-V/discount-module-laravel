@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Checkout</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('checkout.process') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="product_id">Product</label>
                <select name="product_id" class="form-control" required>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }} - ${{ $product->price }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="number" name="quantity" class="form-control" min="1" value="1" required>
            </div>

            <div class="form-group">
                <label for="discount_id">Discount (Optional)</label>
                <select name="discount_id" class="form-control">
                    <option value="">No Discount</option>
                    @foreach ($discounts as $discount)
                        <option value="{{ $discount->id }}">{{ $discount->name }} - {{ $discount->value }}
                            {{ $discount->discount_type }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="user_id">User</label>
                <select name="user_id" class="form-control" required>
                    <option value="">Select a User</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>


            <button type="submit" class="btn btn-success">Checkout</button>
        </form>
    </div>
@endsection
