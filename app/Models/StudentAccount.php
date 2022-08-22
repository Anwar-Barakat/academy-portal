<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'date',
        'feeInvoice_id',
        'student_id',
        'grade_id',
        'classroom_id',
        'debit',
        'credit',
        'description',
    ];
}