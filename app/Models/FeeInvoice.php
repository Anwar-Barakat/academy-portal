<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeeInvoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'student_id',
        'grade_id',
        'classroom_id',
        'fee_id',
        'amount',
        'description',
    ];
}