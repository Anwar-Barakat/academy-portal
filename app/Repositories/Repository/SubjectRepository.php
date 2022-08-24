<?php

namespace App\Repositories\Repository;

use App\Models\Grade;
use App\Models\Subject;
use App\Models\Teacher;
use App\Repositories\Interface\SubjectRepositoryInterface;

class SubjectRepository implements SubjectRepositoryInterface
{
    public function index()
    {
        $subjects   = Subject::with(['grade', 'classroom', 'teacher'])->latest()->get();
        return view('pages.subjects.index', ['subjects' => $subjects]);
    }

    public function create()
    {
        $grades     = Grade::all();
        $teachers   = Teacher::with('specialization')->get();
        return view('pages.subjects.create', ['grades' => $grades, 'teachers' => $teachers]);
    }

    public function store($request)
    {
        try {
            if ($request->isMethod('post')) {
                $data               = $request->only(['name_ar', 'name_en', 'grade_id', 'classroom_id', 'teacher_id']);
                $data['name']['ar'] = $data['name_ar'];
                $data['name']['en'] = $data['name_en'];
                Subject::create($data);


                toastr()->success(__('msgs.added', ['name' => __('trans.subject')]));
                return redirect()->back();
            }
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }

    public function edit($subject)
    {
    }

    public function update($request, $subject)
    {
    }

    public function destroy($subject)
    {
    }
}