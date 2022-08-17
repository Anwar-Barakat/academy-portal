<?php

namespace App\Repositories\Repository;

use App\Models\Blood;
use App\Models\Classroom;
use App\Models\Grade;
use App\Models\MyParent;
use App\Models\Nationality;
use App\Models\Section;
use App\Models\Student;
use App\Repositories\Interface\StudentPepositoryInterface;
use Illuminate\Support\Facades\Hash;

class StudentPepository implements StudentPepositoryInterface
{
    public function index()
    {
        $students = Student::latest()->get();
        return view('pages.students.index', ['students' => $students]);
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

    public function store($request)
    {
        try {
            $data               = $request->only([
                'name_ar', 'name_en', 'email', 'password', 'gender', 'birthday', 'nationality_id',
                'blood_id', 'grade_id', 'classroom_id', 'section_id', 'parent_id', 'academic_year',
            ]);
            $data['name']['ar'] = $data['name_ar'];
            $data['name']['en'] = $data['name_en'];
            $data['password'] = Hash::make($data['password']);
            Student::create($data);

            toastr()->success(__('msgs.added', ['name' => __('student.student')]));
            return redirect()->route('students.index');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }

    // public function edit($student)
    // {
    //     $student = Student::findOrFail($student->id);
    //     if ($student)
    //         return view('pages.students.edit', ['student' => $student]);
    // }
}