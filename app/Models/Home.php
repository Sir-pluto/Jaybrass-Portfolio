<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Home extends Model
{
    use HasFactory;
    protected $fillable = [
        'introduction',
        'position',
        'description',
        'image',
        'slug',
        'logo',
        'favicon',
        'years_of_experience',
        'projects_completed'
    ];
}
