<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{    protected $fillable = [
    'teacher_name',
    'email',
    'status',
];

    use HasFactory;
}
