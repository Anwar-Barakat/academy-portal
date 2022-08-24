<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Grade extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'name',
        'notes'
    ];

    public $translatable = ['name'];

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($this->attributes['created_at'])->format('Y-m-d');
    }

    public function classrooms()
    {
        return $this->hasMany(Classroom::class);
    }

    public function sections()
    {
        return $this->hasMany(Section::class, 'grade_id');
    }
}