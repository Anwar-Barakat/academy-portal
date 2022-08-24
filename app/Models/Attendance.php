<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'grade_id',
        'classroom_id',
        'section_id',
        'teacher_id',
        'status',
    ];
    protected $dateFormat = 'Y-m-d';

    // public function createdAt(): Attribute
    // {
    //     return new Attribute(
    //         get: function ($value) {
    //             return Carbon::parse($this->attributes['created_at'])->format('Y-m-d');
    //         }
    //     );
    // }
}