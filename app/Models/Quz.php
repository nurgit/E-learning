<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quz extends Model
{
    protected $fillable = [
        'quz_name',
        'instruction',
        'file',
        'mark',
        'date',
        'Course_teacher_id',
        'status',
    ];
    use HasFactory;
}
