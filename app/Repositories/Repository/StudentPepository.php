<?php

namespace App\Repositories\Repository;

use App\Models\Blood;
use App\Models\Classroom;
use App\Models\Grade;
use App\Models\MyParent;
use App\Models\Nationality;
use App\Models\Section;
use App\Repositories\Interface\StudentPepositoryInterface;

class StudentPepository implements StudentPepositoryInterface
{
    public function index()
    {
    }

    public function create()
    {
        $data['grades']             = Grade::all();
        $data['classrooms']         = Classroom::all();
        $data['parents']            = MyParent::all();
        $data['sections']           = Section::all();
        $data['nationalities']      = Nationality::all();
        $data['bloods']             = Blood::all();
        return view('pages.students.create', $data);
    }
}