@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <h1>Discounts</h1>
        <a href="{{ route('discounts.create') }}" class="btn btn-primary mb-3">Add New Discount</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Value</th>
                    <th>Valid From</th>
                    <th>Valid To</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($discounts as $discount)
                    <tr>
                        <td>{{ $discount->name }}</td>
                        <td>{{ ucfirst($discount->discount_type) }}</td>
                        <td>{{ $discount->value }}</td>
                        <td>{{ $discount->valid_from }}</td>
                        <td>{{ $discount->valid_to }}</td>
                        <td>
                            <a href="{{ route('discounts.edit', $discount->id) }}" class="btn btn-info btn-sm">Edit</a>
                            <form action="{{ route('discounts.destroy', $discount->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
