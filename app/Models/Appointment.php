<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'date', 'time', 'event_id', 'user_id', 'id'];

    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
