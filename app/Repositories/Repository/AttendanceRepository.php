<?php

namespace App\Repositories\Repository;

use App\Models\Grade;
use App\Models\Student;
use App\Models\Teacher;
use App\Repositories\Interface\AttendanceRepositoryInterface;

class AttendanceRepository implements AttendanceRepositoryInterface
{
    public function index()
    {
        $grades     = Grade::all();
        $teachers   = Teacher::all();
        return view('pages.attendances.index', ['grades' => $grades, 'teachers' => $teachers]);
    }


    public function addAttendance($section_id)
    {
        $students   = Student::with('attendances')->where('section_id', $section_id)->get();
        return view('pages.attendances.create', ['students' => $students, 'section_id' => $section_id]);
    }
}