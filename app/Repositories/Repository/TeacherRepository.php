<?php

namespace App\Repositories\Repository;

use App\Http\Requests\StoreTeacherRequest;
use App\Models\Specialization;
use App\Models\Teacher;
use App\Repositories\Interface\TeacherRepositoryInterface;

class TeacherRepository implements TeacherRepositoryInterface
{
    public function index()
    {
        return Teacher::latest()->get();
    }

    public function store($request)
    {
        try {
            $data = $request->only(['email', 'password', 'gender', 'specialization_id', 'joining', 'address']);
            $data['name']['ar'] = $request->name_ar;
            $data['name']['en'] = $request->name_en;
            Teacher::create($data);

            toastr()->success(__('msgs.added', ['name' => __('teacher.teacher')]));
            return redirect()->route('teachers.index');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }

    public function getSpecializations()
    {
        return Specialization::all();
    }
}