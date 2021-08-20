<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lecture_note extends Model
{
    protected $fillable = [
        'tutorial_name',
        'subject',
        'details',
        'file',
        'link',
        'date',
        'admin_id',
        'status',
    ];
    use HasFactory;
}
