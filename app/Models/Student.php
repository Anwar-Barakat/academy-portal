<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Student extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'name',
        'email',
        'password',
        'gender',
        'birthday',
        'nationality_id',
        'blood_id',
        'grade_id',
        'classroom_id',
        'section_id',
        'parent_id',
        'academic_year',
    ];

    protected $translatable = ['name'];
}