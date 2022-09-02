<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class MyParent extends Authenticatable
{
    use HasFactory, HasTranslations, Notifiable;

    protected $guard = 'parent';

    public $translatable = [
        'father_name',
        'father_job',
        'mother_name',
        'mother_job',
    ];


    protected $guarded = [];

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}