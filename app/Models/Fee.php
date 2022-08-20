<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Fee extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'title',
        'amount',
        'type',
        'grade_id',
        'classroom_id',
        'description',
        'year',
    ];

    public function gender(): Attribute
    {
        return new Attribute(
            get: function ($value) {
                if ($value === 0)
                    return 'study';
                else
                    return 'bus';
            }
        );
    }

    public $translatable = ['title'];

    public function grade()
    {
        return $this->belongsTo(Grade::class, 'grade_id');
    }


    public function classroom()
    {
        return $this->belongsTo(Classroom::class, 'classroom_id');
    }
}