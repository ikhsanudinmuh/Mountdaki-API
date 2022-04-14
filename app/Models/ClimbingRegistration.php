<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClimbingRegistration extends Model
{
    use HasFactory;

    protected $fillable = [
        'mountain_id', 'user_id', 'identity_card', 'healthy_letter', 'schedule', 'status'
    ];

    public function mountain() {
        return $this->belongsTo(Mountain::class);
    }
}
