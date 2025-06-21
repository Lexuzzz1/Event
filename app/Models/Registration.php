<?php
// app/Models/Registration.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

     protected $table = 'event_registrations';

    protected $fillable = [
        'user_id',
        'event_id',
        'payment_status',
        'proof_of_payment_path',
        'qr_code_path',
        'is_checked_in',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function attendance()
    {
        return $this->hasOne(Attendance::class);
    }

    public function certificate()
    {
        return $this->hasOne(Certificate::class);
    }
}
