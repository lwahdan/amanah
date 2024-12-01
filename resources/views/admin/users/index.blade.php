@extends('admin.layouts.app')

@section('content')
<table class="table">

    <form 
    method="GET" 
    action="{{ route('users.search') }}" 
    class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search"
>
    <div class="input-group">
        <input 
            type="text" 
            id="search-input"
            name="query" 
            class="form-control bg-light border-0 small" 
            placeholder="Search for..." 
            aria-label="Search" 
            aria-describedby="basic-addon2"
            value="{{ request('query') }}" 
        >
        <div class="input-group-append">
            <button class="btn btn-primary" type="submit">
                <i class="fas fa-search fa-sm"></i>
            </button>
        </div>
    </div>

</form>
@if (request('query'))
<p>Search results for: "{{ request('query') }}"</p>
@endif




    <a href="{{ route('users.create') }}" class="btn btn-primary">Add User</a>

    <form method="GET" action="{{ route('users.index') }}" class="d-flex">
        <!-- Status Dropdown -->
        <label for="status" class="me-2">Status:</label>
        <select name="status" id="status" class="form-select me-3">
            <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>All</option>
            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
            <option value="deleted" {{ request('status') == 'deleted' ? 'selected' : '' }}>Deleted</option>
        </select>
    
        <!-- Role Dropdown -->
        <label for="role" class="me-2">Role:</label>
        <select name="role" id="role" class="form-select">
            <option value="all" {{ request('role') == 'all' ? 'selected' : '' }}>All</option>
            <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
            <option value="client" {{ request('role') == 'client' ? 'selected' : '' }}>Client</option>
            <option value="provider" {{ request('role') == 'provider' ? 'selected' : '' }}>Provider</option>
        </select>
    
        <button type="submit" class="btn btn-primary ms-3">Filter</button>
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

<script>
    document.addEventListener('DOMContentLoaded', function () {

let table = new DataTable('#example', {
    processing: true,
    serverSide: true,
    ajax: {
        url: '/admin/users/data', // Your route for the data method
        data: function (d) {
            d.query = $('#search-input').val(); // Pass the search term
        }
    },
    columns: [
        { data: 'id', name: 'id' },
        { data: 'name', name: 'name' },
        { data: 'email', name: 'email' },
        { data: 'role', name: 'role' },
        {
            data: 'id',
            render: function (data, type, row) {
                return `<a href="/admin/users/${data}" class="btn btn-info btn-sm">View</a>`;
            }
        }
    ]
});

// Reload the table when the search input changes
$('#search-input').on('keyup', function () {
    table.ajax.reload();
});



    });
</script>
