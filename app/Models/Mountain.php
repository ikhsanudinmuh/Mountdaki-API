<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Mountain extends Model
{
    use HasFactory, HasApiTokens;

    protected $fillable = [
        'name', 'image', 'description', 'location', 'height', 'rate', 'basecamp'
    ];

    public function climbingRegistration() {
        return $this->hasMany(ClimbingRegistration::class, 'foreign_key');
    }
}
