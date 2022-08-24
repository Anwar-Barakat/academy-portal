<?php

namespace App\Repositories\Repository;

use App\Models\Attendance;
use App\Models\Grade;
use App\Models\Student;
use App\Models\Teacher;
use App\Repositories\Interface\AttendanceRepositoryInterface;
use Illuminate\Support\Facades\DB;

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
        return view('pages.attendances.create', ['students' => $students]);
    }


    public function store($request)
    {
        $status = '';
        try {

            foreach ($request->attendences as $studentId => $attendace) {
                $attendace == 'presence' ? $status = true : $status = false;

                Attendance::create([
                    'student_id'    => $studentId,
                    'status'        => $status,
                    'grade_id'      => $request->grade_id,
                    'classroom_id'  => $request->classroom_id,
                    'section_id'    => $request->section_id,
                    'teacher_id'    => 1,
                ]);
            }

            toastr()->success(__('msgs.added', ['name' => __('trans.attendances')]));
            return redirect()->back();
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }
}
