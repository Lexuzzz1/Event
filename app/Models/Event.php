<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'date',
        'time',
        'location',
        'speaker',
        'poster',
        'registration_fee',
        'max_participants',
        'created_by',
        'status'
    ];

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }
}
