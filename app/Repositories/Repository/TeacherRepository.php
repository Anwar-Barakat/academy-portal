<?php

namespace App\Repositories\Repository;

use App\Repositories\Interface\TeacherRepositoryInterface;

class TeacherRepository implements TeacherRepositoryInterface
{
    public function index()
    {
        return 'hi';
    }
}