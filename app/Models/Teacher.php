<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Teacher extends Model
{
    use HasFactory, HasTranslations;

    public $translatable = ['name'];

    protected $fillable = [
        'email',
        'password',
        'name',
        'gender',
        'specialization_id',
        'joining',
        'address',
    ];

    public function gender(): Attribute
    {
        return new Attribute(
            get: function ($value) {
                if ($value === 0)
                    return 'male';
                else
                    return 'female';
            }
        );
    }

    public function joining(): Attribute
    {
        return new Attribute(
            get: function ($value) {
                return Carbon::parse($this->attributes['joining'])->format('Y-m-d');
            }
        );
    }

    public function specialization()
    {
        return $this->belongsTo(Specialization::class, 'specialization_id');
    }


    public function sections()
    {
        return $this->belongsToMany(Section::class, 'section_teacher');
    }
}
