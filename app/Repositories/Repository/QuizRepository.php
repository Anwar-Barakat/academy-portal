<?php

namespace App\Repositories\Repository;

use App\Models\Grade;
use App\Models\Quiz;
use App\Models\Subject;
use App\Models\Teacher;
use App\Repositories\Interface\QuizRepositoryInterface;

class QuizRepository implements QuizRepositoryInterface
{
    public function index()
    {
        $quizzes    = Quiz::latest()->get();
        return view('pages.quizzes.index', ['quizzes' => $quizzes]);
    }

    public function create()
    {
        $data['grades']     = Grade::all();
        $data['subjects']   = Subject::all();
        $data['teachers']   = Teacher::all();
        return view('pages.quizzes.create', $data);
    }

    public function store($request)
    {
        try {
            if ($request->isMethod('post')) {
                $data               = $request->only(['grade_id', 'classroom_id', 'section_id', 'teacher_id', 'subject_id']);
                $data['name']['ar'] = $request->name_ar;
                $data['name']['en'] = $request->name_en;

                Quiz::create($data);

                toastr()->success(__('msgs.added', ['name' => __('trans.quiz')]));
                return redirect()->back();
            }
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }

    public function edit($quiz)
    {
        $data['grades']     = Grade::all();
        $data['subjects']   = Subject::all();
        $data['teachers']   = Teacher::all();
        $data['quiz']       = $quiz;
        return view('pages.quizzes.edit', $data);
    }

    public function update($request, $quiz)
    {
        try {
            if ($request->isMethod('put')) {
                $data               = $request->only(['grade_id', 'classroom_id', 'section_id', 'teacher_id', 'subject_id']);
                $data['name']['ar'] = $request->name_ar;
                $data['name']['en'] = $request->name_en;

                $quiz->update($data);

                toastr()->success(__('msgs.updated', ['name' => __('trans.quiz')]));
                return redirect()->back();
            }
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }

    public function destroy($quiz)
    {
        try {
            $quiz->delete();
            toastr()->info(__('msgs.deleted', ['name' => __('trans.quiz')]));
            return redirect()->back();
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }
}