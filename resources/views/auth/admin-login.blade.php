@extends('layouts.app')

@section('title', 'Admin Login')

@section('content')
<div class="login-container">
    <h1>Admin Loginn</h1>
    <form method="POST" action="{{ route('admin.login') }}">
        @csrf
        <div>
            <label>Email</label>
            <input type="email" name="email" required autofocus>
        </div>
        <div>
            <label>Password</label>
            <input type="password" name="password" required>
        </div>
        <div>
            <label>
                <input type="checkbox" name="remember"> Remember Me
            </label>
        </div>
        <button type="submit">Login</button>
    </form>
</div>
@endsection
