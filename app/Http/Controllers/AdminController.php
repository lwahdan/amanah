<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;


class AdminController extends Controller
{
    public function index(){
        return view('admin.dashboard');
    }

    public function AdminLogout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout(); // Log out the user

        $request->session()->invalidate(); // Invalidate the session

        $request->session()->regenerateToken(); // Regenerate CSRF token

        return redirect('/admin/login'); // Redirect to the homepage or login page
    }

    public function AdminProfile(){
        $id=auth::user()->id;
        $profileData=User::find($id);
        return view('admin.profile',compact('profileData'));
    }

}
