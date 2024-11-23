@extends('admin.layouts.app')

@section('content')
    <h1>{{ $user->name }}</h1>
    <p>Email: {{ $user->email }}</p>
    <p>Role: {{ ucfirst($user->role) }}</p>
@endsection
