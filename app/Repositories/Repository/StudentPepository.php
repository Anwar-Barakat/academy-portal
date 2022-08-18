<?php

namespace App\Repositories\Repository;

use App\Models\Blood;
use App\Models\Classroom;
use App\Models\Grade;
use App\Models\Image;
use App\Models\MyParent;
use App\Models\Nationality;
use App\Models\Section;
use App\Models\Student;
use App\Repositories\Interface\StudentPepositoryInterface;
use Illuminate\Support\Facades\DB;
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
        $data['sections']           = Section::where(['status' => 1])->get();
        $data['nationalities']      = Nationality::all();
        $data['bloods']             = Blood::all();
        return view('pages.students.create', $data);
    }

    public function store($request)
    {
        DB::beginTransaction();

        try {
            $data               = $request->only([
                'name_ar', 'name_en', 'email', 'password', 'gender', 'birthday', 'nationality_id',
                'blood_id', 'grade_id', 'classroom_id', 'section_id', 'parent_id', 'academic_year',
            ]);
            $data['name']['ar'] = $data['name_ar'];
            $data['name']['en'] = $data['name_en'];
            $data['password'] = Hash::make($data['password']);
            $student = Student::create($data);

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $photo) {
                    $name   = $photo->getClientOriginalName();
                    $photo->storeAs('attachments/students/' . $student->getTranslation('name', 'en'), $name, 'students_attachments');

                    $image                  = new Image();
                    $image->file_name       = $name;
                    $image->imageable_id    = $student->id;
                    $image->imageable_type  = 'App\Models\Student';
                    $image->save();
                }
            }

            DB::commit();

            toastr()->success(__('msgs.added', ['name' => __('student.student')]));
            return redirect()->route('students.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }

    public function show($student)
    {
        $student = Student::findOrFail($student->id);
        if ($student)
            return view('pages.students.show', ['student' => $student]);
    }

    public function edit($student)
    {
        $data['student']        = Student::findOrFail($student->id);
        $data['nationalities']  = Nationality::all();
        $data['bloods']         = Blood::all();
        $data['grades']         = Grade::with(['classrooms', 'sections'])->get();
        $data['parents']        = MyParent::all();
        if ($student)
            return view('pages.students.edit', $data);
    }


    public function update($request, $student)
    {
        try {
            $data               = $request->only([
                'name_ar', 'name_en', 'email', 'password', 'gender', 'birthday', 'nationality_id',
                'blood_id', 'grade_id', 'classroom_id', 'section_id', 'parent_id', 'academic_year',
            ]);
            $data['name']['ar'] = $data['name_ar'];
            $data['name']['en'] = $data['name_en'];
            $data['password'] = Hash::make($data['password']);
            $student->update($data);


            toastr()->success(__('msgs.updated', ['name' => __('student.student')]));
            return redirect()->route('students.index');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }

    public function delete($student)
    {

        $student->delete();
        toastr()->info(__('msgs.deleted', ['name' => __('student.student')]));
        return redirect()->route('students.index');
    }
}