<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Mountain extends Model
{
    use HasFactory, HasApiTokens;

    protected $fillable = [
        'name', 'image', 'description', 'location', 'height', 'basecamp'
    ];

    public function climbing_registration() {
        return $this->hasMany(ClimbingRegistration::class);
    }

    public function rating() {
        return $this->hasMany(Rating::class);
    }
}
