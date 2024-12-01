<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceProvider extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'bio',
        'certifications',
        'gender',
        'date_of_birth',
        'years_of_experience',
        'education',
        'skills',
        'languages_spoken',
        'availability',
        'hourly_rate',
        'work_shifts',
        'work_locations',
        'background_checked',
    ];
    
    

    public function user()
    {
    return $this->belongsTo(User::class);
    } 

    public function services()
    {
    //return $this->belongsToMany(Service::class, 'service_provider_service'); // Pivot table
    return $this->belongsToMany(Service::class, 'service_provider_service', 'service_provider_id', 'service_id');

    }

    public function bookings()
    {
    return $this->hasMany(Booking::class);
    }

    public function reviews()
    {
    return $this->hasMany(Review::class);
    }

    public function meetings()
    {
    return $this->hasMany(Meeting::class);
    }

}
