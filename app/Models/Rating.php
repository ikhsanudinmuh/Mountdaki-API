<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = [
        'climbing_registration_id', 'mountain_id', 'user_id', 'review', 'rate'
    ];

    public function climbing_registration() {
        $this->belongsTo(ClimbingRegistration::class);
    }

    public function mountain() {
        $this->belongsTo(Mountain::class);
    }

    public function user() {
        $this->belongsTo(User::class);
    }
}
