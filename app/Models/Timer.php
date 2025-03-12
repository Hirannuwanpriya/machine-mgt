<?php

namespace App\Models;

class Timer extends Model
{
    protected $fillable = [
        'machine_id',
        'start_date',
        'hours'
    ];

    protected $casts = [
        'start_date' => 'datetime'
    ];

    public function machine()
    {
        return $this->belongsTo(Machine::class);
    }

}
