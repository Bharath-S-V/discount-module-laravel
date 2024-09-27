@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Products</h1>

        <div class="row">
            @foreach ($products as $product)
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">${{ $product->price }}</p>
                            <a href="{{ route('checkout.index') }}" class="btn btn-primary">Checkout</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
