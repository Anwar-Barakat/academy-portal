<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeeProcessing extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'amount',
        'description',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}