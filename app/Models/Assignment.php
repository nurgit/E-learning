<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    protected $fillable = [
        'assignment_name',
        'instruction',
        'file',
        'mark',
        'date',
        'Course_teacher_id',
        'status',
    ];
    use HasFactory;
}
