<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Сlass Project
 */
class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];
}
