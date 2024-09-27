@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ isset($discountUsage) ? 'Edit Discount Usage' : 'Create Discount Usage' }}</h1>

        <form
            action="{{ isset($discountUsage) ? route('discount_usages.update', $discountUsage->id) : route('discount_usages.store') }}"
            method="POST">
            @csrf
            @if (isset($discountUsage))
                @method('PUT')
            @endif

            <!-- User Dropdown -->
            <div class="form-group">
                <label for="user_id">User</label>
                <select name="user_id" class="form-control" required>
                    <option value="">Select a User</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}"
                            {{ isset($discountUsage) && $discountUsage->user_id == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Booking Dropdown -->
            <div class="form-group">
                <label for="booking_id">Booking</label>
                <select name="booking_id" class="form-control" required>
                    <option value="">Select a Booking</option>
                    @foreach ($bookings as $booking)
                        <option value="{{ $booking->id }}"
                            {{ isset($discountUsage) && $discountUsage->booking_id == $booking->id ? 'selected' : '' }}>
                            {{ $booking->user->name }} - {{ $booking->booking_date }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Discount Dropdown -->
            <div class="form-group">
                <label for="discount_id">Discount</label>
                <select name="discount_id" class="form-control" required>
                    <option value="">Select a Discount</option>
                    @foreach ($discounts as $discount)
                        <option value="{{ $discount->id }}"
                            {{ isset($discountUsage) && $discountUsage->discount_id == $discount->id ? 'selected' : '' }}>
                            {{ $discount->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="usage_date">Usage Date</label>
                <input type="datetime-local" name="usage_date" class="form-control"
                    value="{{ isset($discountUsage) ? \Carbon\Carbon::parse($discountUsage->usage_date)->format('Y-m-d\TH:i') : old('usage_date') }}"
                    required>
            </div>

            <button type="submit" class="btn btn-success">{{ isset($discountUsage) ? 'Update' : 'Create' }}</button>
        </form>
    </div>
@endsection
