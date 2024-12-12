<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    use HasFactory;


    protected $fillable = ['name', 'seat', 'route_id'];

    public function route()
    {
        return $this->belongsTo(Route::class); // Each bus belongs to one route
    }

    public function schedules()
    {
        return $this->hasMany(BusSchedule::class); // A bus has many schedules
    }
}
