@extends('admin.layouts.app')

@section('content')
<h1>Service: {{ $service->name }}</h1>
<h2>Providers Offering This Service</h2>

@if ($service->serviceProviders->isEmpty())
    <p>No providers are currently offering this service.</p>
@else
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Provider Name</th>
                <th>Bio</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($service->serviceProviders as $provider)
                <tr>
                    <td>
                        {{-- <a href="{{ route('admin.users.show', $provider->id) }}"> --}}
                        <a href="#">
                            {{ $provider->user->name }}
                        </a>
                    </td>
                    <td>{{ $provider->bio }}</td>
                    <td>
                        {{-- <a href="{{ route('admin.users.show', $provider->user->id) }}" class="btn btn-info btn-sm"> --}}
                            <a href="#" class="btn btn-info btn-sm">
                            View Details
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif

@endsection
