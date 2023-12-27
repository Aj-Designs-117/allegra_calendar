<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'limited_quotas', 'color', 'textColor', 'start', 'end', 'daysOfWeek', 'startTime', 'endTime', 'original_quotas'];

    public $timestamps = false;
}
