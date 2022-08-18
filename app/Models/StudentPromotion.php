<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentPromotion extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'from_grade',
        'from_classroom',
        'from_section',
        'academic_year',
        'to_grade',
        'to_classroom',
        'to_section',
        'new_academic_year',
    ];

    protected $casts = [
        'academic_year'     => 'datetime',
        'new_academic_year' => 'datetime',
    ];
}