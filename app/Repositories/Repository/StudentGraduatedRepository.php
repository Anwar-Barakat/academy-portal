<?php

namespace App\Repositories\Repository;

use App\Models\Grade;
use App\Models\Student;
use App\Repositories\Interface\StudentGraduatedRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class StudentGraduatedRepository implements StudentGraduatedRepositoryInterface
{

    public function index()
    {
        $graduatedStudents = Student::onlyTrashed()->get();
        return view('pages.students.graduations.index', ['graduatedStudents' => $graduatedStudents]);
    }

    public function create()
    {
        $grades = Grade::all();
        return view('pages.students.graduations.create', ['grades' => $grades]);
    }

    public function graduated($request)
    {
        try {
            $data       = $request->only(['grade_id', 'classroom_id', 'section_id']);
            $students   = Student::where(['grade_id' => $data['grade_id'], 'classroom_id' => $data['classroom_id'], 'section_id' => $data['section_id']])->get();
            if ($students->count() < 1) {
                toastr()->error(__('msgs.not_students'));
                return redirect()->route('students-graduations.create');
            }
            foreach ($students as $student) {
                Student::where('id', $student->id)->delete();
            }

            toastr()->success(__('msgs.has_graduated', ['name' => __('student.students')]));
            return redirect()->route('students-graduations.create');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }


    public function returned($request)
    {
        $data   = $request->only(['id']);
        Student::onlyTrashed()->where('id', $data['id'])->first()->restore();
        toastr()->success(__('msgs.has_returned', ['name' => __('student.students')]));
        return redirect()->back();
    }

    public function destroy($id)
    {
        Student::onlyTrashed()->where('id', $id)->first()->forceDelete();
        toastr()->info(__('msgs.deleted', ['name' => __('student.student')]));
        return redirect()->back();
    }
}