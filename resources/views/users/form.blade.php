@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ isset($user) ? 'Edit User' : 'Create User' }}</h1>

        <form action="{{ isset($user) ? route('users.update', $user->id) : route('users.store') }}" method="POST">
            @csrf
            @if (isset($user))
                @method('PUT')
            @endif

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" value="{{ isset($user) ? $user->name : old('name') }}"
                    required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control"
                    value="{{ isset($user) ? $user->email : old('email') }}" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" value=""
                    {{ isset($user) ? '' : 'required' }}>
            </div>

            <button type="submit" class="btn btn-success">{{ isset($user) ? 'Update' : 'Create' }}</button>
        </form>
    </div>
@endsection
