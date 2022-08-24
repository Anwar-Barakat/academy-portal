<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Subject extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'grade_id',
        'classroom_id',
        'section_id',
        'teacher_id',
    ];

    public $translatable = ['name'];
}