<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Classroom extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'name',
        'grade_id',
    ];


    public $translatable = ['name'];

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($this->attributes['created_at'])->format('Y-m-d');
    }


    public function grades()
    {
        return $this->belongsTo(Grade::class, 'grade_id');
    }
}