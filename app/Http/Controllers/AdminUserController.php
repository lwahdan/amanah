<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;


class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $status = $request->get('status', 'all'); // Default to 'all'
    
        if ($status === 'active') {
            $users = User::whereNull('deleted_at')->orderBy('id','asc')->paginate(10); // Only active users
        } elseif ($status === 'deleted') {
            $users = User::onlyTrashed()->orderBy('id','asc')->paginate(10); // Only soft-deleted users
        } else {
            $users = User::withTrashed()->orderBy('id','asc')->paginate(10); // Both active and deleted users
        }
        
        return view('admin.users.index', compact('users', 'status'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'nullable|string|max:15',
            'role' => 'required|in:client,provider,admin',
        ]);
    
        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'phone' => $validated['phone'],
            'role' => $validated['role'],
        ]);
    
        return redirect()->route('users.index')->with('success', 'User created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . $id,
        'phone' => 'nullable|string|max:15',
        'role' => 'required|in:client,provider,admin',
        ]));
        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete(); // Soft delete
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }

    // To restore a soft-deleted record
    public function restore($id)
    {
    $user = User::withTrashed()->findOrFail($id);
    $user->restore(); // Restore the soft-deleted user
    return redirect()->route('users.index')->with('success', 'User restored successfully!');
    }

    public function search(Request $request)
    {
    $query = $request->input('query');

    $users = User::where('name', 'like', "%$query%")
                 ->orWhere('email', 'like', "%$query%")
                 ->paginate(10);

    return view('admin.users.index', compact('users'));
    }
    
    public function data(Request $request)
    {
        $query = User::query();

        if ($request->has('query')) {
            $search = $request->input('query');
            $query->where('name', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%");
        }

        return DataTables::of($query)->toJson();
    }





}
