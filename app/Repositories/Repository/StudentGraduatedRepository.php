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
        return 'hello';
    }

    public function create()
    {
        $grades = Grade::all();
        return view('pages.students.graduations.create', ['grades' => $grades]);
    }

    public function graduated($request)
    {

        DB::beginTransaction();
        try {
            $data       = $request->only(['grade_id', 'classroom_id', 'section_id']);
            $students   = Student::where(['grade_id' => $data['grade_id'], 'classroom_id' => $data['classroom_id'], 'section_id' => $data['section_id']])->get();
            if ($students->count() < 1) {
                toastr()->error(__('msgs.not_students'));
                return redirect()->route('students-graduations.create');
            } else {
                foreach ($students as $student) {
                    Student::where('id', $student->id)->delete();
                }

                toastr()->success(__('msgs.has_graduated', ['name' => __('student.students')]));
                return redirect()->route('students-graduations.create');
            }
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }
}