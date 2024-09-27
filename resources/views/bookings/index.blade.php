@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Bookings</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <a href="{{ route('bookings.create') }}" class="btn btn-primary">Add New Booking</a>

        <table class="table mt-4">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Booking Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bookings as $booking)
                    <tr>
                        <td>{{ $booking->id }}</td>
                        <td>{{ $booking->user->name }}</td>
                        <td>{{ $booking->booking_date }}</td>
                        <td>{{ $booking->status }}</td>
                        <td>
                            <a href="{{ route('bookings.edit', $booking->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST"
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
