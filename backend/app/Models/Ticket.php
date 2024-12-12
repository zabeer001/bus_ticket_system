<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'schedule_id',
        'payment_status',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function busSchedule()
    {
        return $this->belongsTo(BusSchedule::class, 'schedule_id');
    }
}
