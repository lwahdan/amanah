@extends('admin.layouts.app')

@section('content')
<form method="POST" action="{{ route('users.update', $user->id) }}">
    @csrf
    @method('PUT')

    <label for="name">Name:</label>
    <input type="text" name="name" value="{{ $user->name }}" required>

    <label for="email">Email:</label>
    <input type="email" name="email" value="{{ $user->email }}" required>

    <label for="phone">Phone:</label>
    <input type="text" name="phone" value="{{ $user->phone }}">

    <label for="role">Role:</label>
    <select name="role">
        <option value="client" {{ $user->role === 'client' ? 'selected' : '' }}>Client</option>
        <option value="provider" {{ $user->role === 'provider' ? 'selected' : '' }}>Provider</option>
        <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
    </select>

    <button type="submit">Update</button>
</form>
@endsection
