<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    protected $fillable = [
        'test_name',
        'test_type',
        'instruction',
        'file',
        'mark',
        'date',
        'Course_teacher_id',
        'status',
    ];
    use HasFactory;
}
