@extends('admin.layouts.app')

@section('content')
<table>
    <a href="{{ route('users.create') }}" class="btn btn-primary">Add User</a>

    <!-- Filter Dropdown -->
    <form method="GET" action="{{ route('users.index') }}" style="display: inline;">
    <select name="status" onchange="this.form.submit()" class="form-select">
        <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>All</option>
        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
        <option value="deleted" {{ request('status') == 'deleted' ? 'selected' : '' }}>Deleted</option>
    </select>
    </form>

    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Actions</th>
            <th>status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ ucfirst($user->role) }}</td>
            <td>
            <a href="{{ route('users.show', $user->id) }}">View</a>
            @if (!$user->trashed()) <!-- Only show edit/delete for active users -->
                <a href="{{ route('users.edit', $user->id) }}">Edit</a>
                <form method="POST" action="{{ route('users.destroy', $user->id) }}" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            @else <!-- Show restore button for deleted users -->
                <form method="POST" action="{{ route('users.restore', $user->id) }}" style="display: inline;">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-success">Restore</button>
                </form>
            @endif
            </td>
            <td>
                @if ($user->trashed())
                    <span class="text-danger">Deleted</span>
                @else
                    <span class="text-success">Active</span>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $users->appends(['status' => request('status')])->links() }}

@endsection
