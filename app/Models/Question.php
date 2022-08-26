<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Question extends Model
{
    use HasFactory, HasTranslations;

    protected $translatable = ['title'];

    protected $fillable = [
        'title',
        'all_answers',
        'right_answer',
        'degrees',
        'quiz_id',
    ];

    public function createdAt(): Attribute
    {
        return new Attribute(
            get: function ($value) {
                return Carbon::parse($this->attributes['created_at'])->format('Y-m-d');
            }
        );
    }

    public function quiz()
    {
        return $this->belongsTo(Quiz::class, 'quiz_id');
    }
}