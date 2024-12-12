<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'bus_id',
        'start_from',
        'date',
        'time',
        'total_tickets',
        'ticket_sold',
        'remaining_tickets',
        'price',
    ];


    public function bus()
    {
        return $this->belongsTo(Bus::class); // One BusSchedule belongs to one Bus
    }
    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'schedule_id');
    }
}
