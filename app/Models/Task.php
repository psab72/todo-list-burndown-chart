<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['task', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
