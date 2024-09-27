@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Discount Usages</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table mt-4">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Booking</th>
                    <th>Product</th>
                    <th>Discount</th>
                    <th>Usage Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($discountUsages as $usage)
                    <tr>
                        <td>{{ $usage->id }}</td>
                        <td>{{ $usage->user->name }}</td> {{-- Display the user name --}}
                        <td>{{ $usage->booking->user->name }}</td> {{-- Adjust this if you want to display a specific field --}}
                        <td>{{ $usage->product->name }}</td> {{-- Display the product name --}}
                        <td>{{ $usage->discount->name }}</td>
                        <td>{{ $usage->usage_date }}</td>
                        <td>
                            <a href="{{ route('discount_usages.edit', $usage->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('discount_usages.destroy', $usage->id) }}" method="POST"
                                style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
