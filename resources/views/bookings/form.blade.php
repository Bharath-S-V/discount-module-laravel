@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ isset($booking) ? 'Edit Booking' : 'Create Booking' }}</h1>

        <form action="{{ isset($booking) ? route('bookings.update', $booking->id) : route('bookings.store') }}"
            method="POST">
            @csrf
            @if (isset($booking))
                @method('PUT')
            @endif

            <div class="form-group">
                <label for="user_name">User Name</label>
                <input type="text" name="user_name" class="form-control"
                    value="{{ isset($booking) ? $booking->user->name : old('user_name') }}" required>
            </div>
            @if ($errors->has('user_name'))
                <span class="text-danger">{{ $errors->first('user_name') }}</span>
            @endif


            <div class="form-group">
                <label for="booking_date">Booking Date</label>
                <input type="datetime-local" name="booking_date" class="form-control"
                    value="{{ isset($booking) ? \Carbon\Carbon::parse($booking->booking_date)->format('Y-m-d\TH:i') : old('booking_date') }}"
                    required>
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <input type="text" name="status" class="form-control"
                    value="{{ isset($booking) ? $booking->status : old('status') }}" required>
            </div>

            <button type="submit" class="btn btn-success">{{ isset($booking) ? 'Update' : 'Create' }}</button>
        </form>
    </div>
@endsection
