<?php

namespace App\Repositories\Repository;

use App\Models\Specialization;
use App\Models\Teacher;
use App\Repositories\Interface\TeacherRepositoryInterface;

class TeacherRepository implements TeacherRepositoryInterface
{
    public function index()
    {
        return Teacher::latest()->get();
    }

    

    public function getSpecializations()
    {
        return Specialization::all();
    }
}
