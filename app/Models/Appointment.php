<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'title', 'date', 'time', 'event_id', 'user_id', 'available_quotas'];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
