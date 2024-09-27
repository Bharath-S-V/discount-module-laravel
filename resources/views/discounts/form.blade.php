@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ isset($discount) ? 'Edit Discount' : 'Create Discount' }}</h1>

        <form action="{{ isset($discount) ? route('discounts.update', $discount->id) : route('discounts.store') }}"
            method="POST">
            @csrf
            @if (isset($discount))
                @method('PUT')
            @endif

            <div class="form-group">
                <label for="name">Discount Name</label>
                <input type="text" name="name" class="form-control"
                    value="{{ isset($discount) ? $discount->name : old('name') }}" required>
            </div>

            <div class="form-group">
                <label for="discount_type">Discount Type</label>
                <select name="discount_type" class="form-control" required>
                    <option value="percentage"
                        {{ isset($discount) && $discount->discount_type == 'percentage' ? 'selected' : '' }}>Percentage
                    </option>
                    <option value="fixed" {{ isset($discount) && $discount->discount_type == 'fixed' ? 'selected' : '' }}>
                        Fixed Amount</option>
                </select>
            </div>

            <div class="form-group">
                <label for="value">Discount Value</label>
                <input type="number" step="0.01" name="value" class="form-control"
                    value="{{ isset($discount) ? $discount->value : old('value') }}" required>
            </div>

            <div class="form-group">
                <label for="valid_from">Valid From</label>
                <input type="datetime-local" name="valid_from" class="form-control"
                    value="{{ isset($discount) ? \Carbon\Carbon::parse($discount->valid_from)->format('Y-m-d\TH:i') : old('valid_from') }}"
                    required>
            </div>

            <div class="form-group">
                <label for="valid_to">Valid To</label>
                <input type="datetime-local" name="valid_to" class="form-control"
                    value="{{ isset($discount) ? \Carbon\Carbon::parse($discount->valid_to)->format('Y-m-d\TH:i') : old('valid_to') }}"
                    required>
            </div>

            <div class="form-group">
                <label for="recurring">Recurring Discount</label>
                <input type="hidden" name="recurring" value="0">
                <input type="checkbox" name="recurring" value="1"
                    {{ isset($discount) && $discount->recurring ? 'checked' : '' }}>
            </div>

            <div class="form-group">
                <label for="family_member_discount">Family Member Discount</label>
                <input type="hidden" name="family_member_discount" value="0">
                <input type="checkbox" name="family_member_discount" value="1"
                    {{ isset($discount) && $discount->family_member_discount ? 'checked' : '' }}>
            </div>

            <button type="submit" class="btn btn-success">{{ isset($discount) ? 'Update' : 'Create' }}</button>
        </form>
    </div>
@endsection
