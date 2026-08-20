<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'headline', 'short_bio', 'about', 
        'profile_image', 'cv_file', 'email', 'phone', 
        'location', 'availability'
    ];
}
