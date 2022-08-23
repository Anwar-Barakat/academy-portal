<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FundAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'studentReceipt_id',
        'studentPayment_id',
        'debit',
        'credit',
        'description',
    ];
}