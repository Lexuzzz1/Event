<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Certificate extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_registration_id',
        'certificate_path',
        'uploaded_at'
    ];

    public function registration()
    {
        return $this->belongsTo(Registration::class);
    }
}
