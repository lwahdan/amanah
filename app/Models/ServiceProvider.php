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
        'specialty',
        'hourly_rate',
        'availability',
        'phone',
        'status',
    ];
    

    public function user()
    {
    return $this->belongsTo(User::class);
    } 

    public function services()
    {
    return $this->belongsToMany(Service::class, 'service_provider_service'); // Pivot table
    }

    public function bookings()
    {
    return $this->hasMany(Booking::class);
    }

    public function reviews()
    {
    return $this->hasMany(Review::class);
    }

}
