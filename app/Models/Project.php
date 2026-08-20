<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'slug', 'description', 'thumbnail',
        'project_url', 'github_url', 'year', 'status', 'featured', 'sort_order'
    ];

    protected $casts = [
        'featured' => 'boolean',
    ];

    public function skills()
    {
        return $this->belongsToMany(Skill::class);
    }
}
