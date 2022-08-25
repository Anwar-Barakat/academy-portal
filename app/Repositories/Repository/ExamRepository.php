<?php

namespace App\Repositories\Repository;

use App\Models\Exam;
use App\Repositories\Interface\ExamRepositoryInterface;

class ExamRepository implements ExamRepositoryInterface
{
    public function index()
    {
        $exams     = Exam::latest()->get();
        return view('pages.exams.index', ['exams' => $exams]);
    }

    public function store($request)
    {
        try {
            if ($request->isMethod('post')) {
                $data                   = $request->only(['name_ar', 'name_en', 'term', 'academic_year']);
                $data['name']['ar']     = $data['name_ar'];
                $data['name']['en']     = $data['name_en'];

                Exam::create($data);

                toastr()->success(__('msgs.added', ['name' => __('trans.exam')]));
                return redirect()->back();
            }
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }

    public function update($request, $exam)
    {
        try {
            if ($request->isMethod('put')) {
                $data                   = $request->only(['name_ar', 'name_en', 'term', 'academic_year']);
                $data['name']['ar']     = $data['name_ar'];
                $data['name']['en']     = $data['name_en'];

                $exam->update($data);

                toastr()->success(__('msgs.updated', ['name' => __('trans.exam')]));
                return redirect()->back();
            }
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }

    public function destroy($exam)
    {
        try {
            $exam->delete();

            toastr()->info(__('msgs.deleted', ['name' => __('trans.exam')]));
            return redirect()->back();
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }
}