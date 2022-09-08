<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'amount',
        'grade_id',
        'classroom_id',
        'description',
        'year',
    ];

    public function type(): Attribute
    {
        return new Attribute(
            get: function ($value) {
                $value === 0 ? $type = 'study' : $type = 'bus';
                return $type;
            }
        );
    }


    public function grade()
    {
        return $this->belongsTo(Grade::class, 'grade_id');
    }


    public function classroom()
    {
        return $this->belongsTo(Classroom::class, 'classroom_id');
    }
}