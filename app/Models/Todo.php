<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Todo extends Model
{
    /** @use HasFactory<\Database\Factories\TodoFactory> */
    use HasFactory;

    protected $fillable = [
        'todo_name',
        'ended_at',
        'start_time',
        'start_date',
        'end_time',
        'end_date',
        'duration',
        'todo_reset',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
   public function getDurationAttribute()
    {
        if ($this->start_date && $this->start_time && $this->end_date && $this->end_time) {
            $start = Carbon::parse($this->start_date . ' ' . $this->start_time);
            $end   = Carbon::parse($this->end_date . ' ' . $this->end_time);

            return $start->diff($end)->format('%Hh %Imn %Ss');
        }
        return null;
    }

}


