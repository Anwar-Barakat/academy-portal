<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use PhpParser\Node\Expr\FuncCall;

class Teacher extends Authenticatable
{
    use HasFactory, HasTranslations, Notifiable;

    public $translatable = ['name'];

    protected $guard = 'teacher';

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
                $value === 0 ? $gender = 'male' : $gender = 'female';
                return $gender;
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

    public function subjects()
    {
        return $this->hasMany(Subject::class, 'teacher_id');
    }
}