<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClimbingRegistration extends Model
{
    use HasFactory;

    protected $fillable = [
        'mountain_id', 'user_id', 'schedule', 'status'
    ];

    public function mountain() {
        return $this->belongsTo(Mountain::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
