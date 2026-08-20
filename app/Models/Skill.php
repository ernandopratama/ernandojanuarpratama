<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'category', 'icon', 'proficiency', 'sort_order'
    ];

    protected $casts = [
        'proficiency' => 'integer',
    ];

    public function projects()
    {
        return $this->belongsToMany(Project::class);
    }
}