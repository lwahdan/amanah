<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'service_id',
        'service_provider_id',
        'city_id', 
        'booking_date', 
        'total_price',
        'status', 
    ];

    protected $casts = [
        'booking_date' => 'datetime',
    ];
    
    public function user()
    {
    return $this->belongsTo(User::class);
    }

    public function service()
    {
    return $this->belongsTo(Service::class);
    }

    public function serviceProvider()
    {
    return $this->belongsTo(ServiceProvider::class);
    }

    public function city()
    {
    return $this->belongsTo(City::class);
    }

}
