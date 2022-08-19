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

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function oldGrade()
    {
        return $this->belongsTo(Grade::class, 'from_grade');
    }

    public function oldClassroom()
    {
        return $this->belongsTo(Classroom::class, 'from_classroom');
    }

    public function oldSection()
    {
        return $this->belongsTo(Section::class, 'from_section');
    }

    public function newGrade()
    {
        return $this->belongsTo(Grade::class, 'to_grade');
    }

    public function newClassroom()
    {
        return $this->belongsTo(Classroom::class, 'to_classroom');
    }

    public function newSection()
    {
        return $this->belongsTo(Section::class, 'to_section');
    }
}
