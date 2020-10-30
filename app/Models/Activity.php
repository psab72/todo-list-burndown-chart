<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Activity extends Model
{
    protected $fillable = ['user_id', 'pending_tasks', 'completed_tasks'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeLast60Minutes($query) {
        $fromDate = Carbon::now()->subMinutes(60);
        $toDate = Carbon::now();
        return $query->whereBetween('created_at', [$fromDate, $toDate]);
    }
}
