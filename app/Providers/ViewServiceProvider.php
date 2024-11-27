<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Share the admin's profile picture with all admin views
        View::composer('*', function ($view) {
            if (Auth::check() && Auth::user()->role === 'admin') {
                $id = Auth::user()->id;
                $profileData = User::find($id); // Retrieve logged-in admin's data
                $view->with('profileData', $profileData);
            }
        });
    }
}
