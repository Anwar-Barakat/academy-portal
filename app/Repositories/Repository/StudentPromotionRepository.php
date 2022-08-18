<?php

namespace App\Repositories\Repository;

use App\Models\Grade;
use App\Models\Student;
use App\Models\StudentPromotion;
use App\Repositories\Interface\StudentPromotionRepositoryInterface;
use Illuminate\Support\Facades\DB;

class  StudentPromotionRepository implements StudentPromotionRepositoryInterface
{
    public function index()
    {
        $grades     = Grade::all();
        return view('pages.students.promotions.index', ['grades' => $grades]);
    }

    public function create()
    {
        $promotions   = StudentPromotion::latest()->get();
        return view('pages.students.promotions.managment', ['promotions' => $promotions]);
    }


    public function store($request)
    {
        DB::beginTransaction();
        try {
            $data = $request->only([
                'grade_id', 'classroom_id', 'section_id', 'academic_year',
                'new_grade_id', 'new_classroom_id', 'new_section_id', 'new_academic_year',
            ]);

            $students = Student::where(
                [
                    'grade_id'      => $data['grade_id'],
                    'classroom_id'  => $data['classroom_id'],
                    'section_id'    => $data['section_id'],
                    'academic_year' => $data['academic_year']
                ]
            )->get();

            if ($students->count() < 1) {
                toastr()->error(__('msgs.not_available'));
                return redirect()->route('students.index');
            }


            foreach ($students as $student) {
                Student::where('id', $student->id)->update([
                    'grade_id'      => $data['new_grade_id'],
                    'classroom_id'  => $data['new_classroom_id'],
                    'section_id'    => $data['new_section_id'],
                    'academic_year' => $data['new_academic_year']
                ]);


                StudentPromotion::updateOrCreate([
                    'student_id'            => $student->id,
                    'from_grade'            => $data['grade_id'],
                    'from_classroom'        => $data['classroom_id'],
                    'from_section'          => $data['section_id'],
                    'academic_year'         => $data['academic_year'],
                    'to_grade'              => $data['new_grade_id'],
                    'to_classroom'          => $data['new_classroom_id'],
                    'to_section'            => $data['new_section_id'],
                    'new_academic_year'     => $data['new_academic_year'],
                ]);
            }


            DB::commit();

            toastr()->success(__('msgs.promoted', ['name' => __('student.students')]));
            return redirect()->route('students.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }
}