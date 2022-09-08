<?php

namespace App\Repositories\Repository;

use App\Http\Traits\AttachFileTrait;
use App\Models\Blood;
use App\Models\Classroom;
use App\Models\Grade;
use App\Models\MyParent;
use App\Models\Nationality;
use App\Models\Section;
use App\Models\Student;
use App\Models\StudentAccount;
use App\Repositories\Interface\StudentRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class StudentRepository implements StudentRepositoryInterface
{
    use AttachFileTrait;

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
            $data               = $request->only(['name_ar', 'name_en', 'email', 'password', 'gender', 'birthday', 'nationality_id', 'blood_id', 'grade_id', 'classroom_id', 'section_id', 'parent_id', 'academic_year']);
            $data['name']['ar'] = $data['name_ar'];
            $data['name']['en'] = $data['name_en'];
            $data['password'] = Hash::make($data['password']);

            $student = Student::create($data);

            if ($request->hasFile('image') && $request->file('image')->isValid())
                $this->uploadFile($request, 'students',  $data['name']['en'], $student->id, 'image', 'Student');


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
        $data['student']        = Student::with(['images'])->findOrFail($student->id);
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
            $data               = $request->only(['name_ar', 'name_en', 'email', 'password', 'gender', 'birthday', 'nationality_id', 'blood_id', 'grade_id', 'classroom_id', 'section_id', 'parent_id', 'academic_year']);
            $data['name']['ar'] = $data['name_ar'];
            $data['name']['en'] = $data['name_en'];


            if (!empty($request->password))
                $data['password']   = Hash::make($data['password']);


            $student->update($data);

            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                foreach ($student->images as $image) {
                    Storage::disk('upload_attachments')->delete('attachments/students/' . $data['name']['en'] . '/' . $image->file_name);
                    $image->delete();
                }
                $this->uploadFile($request, 'students',  $data['name']['en'], $student->id, 'image', 'Student');
            }


            toastr()->success(__('msgs.updated', ['name' => __('student.student')]));
            return redirect()->route('students.index');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }

    public function delete($student)
    {

        $loans   = number_format($student->studentAccounts->sum('debit') - $student->studentAccounts->sum('credit'));
        if ($loans > 0)
            toastr()->error(__('msgs.has_fees', ['name' => $loans]));

        else {
            foreach ($student->images as $image) {
                Storage::disk('upload_attachments')->delete('attachments/students/' . $student->getTranslation('name', 'en') . '/' . $image->file_name);
                $image->delete();
            }
            $student->delete();
            toastr()->info(__('msgs.deleted', ['name' => __('student.student')]));
        }

        return redirect()->route('students.index');
    }


    public function forceDelete($student)
    {
        foreach ($student->images as $image) {
            Storage::disk('upload_attachments')->delete('attachments/students/' . $student->getTranslation('name', 'en') . '/' . $image->file_name);
            $image->delete();
        }
        $student->forceDelete();
        toastr()->info(__('msgs.deleted', ['name' => __('student.student')]));
        return redirect()->back();
    }
}