<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Home extends Model
{
    use HasFactory;
    protected $fillable = [
        'Title', 
        'position', 
        'Description',
        'Image',
        'Slug',
        'Years_Experience',
        'Projects_Completed'
    ];
}
