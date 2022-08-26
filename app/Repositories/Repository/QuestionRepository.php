<?php

namespace App\Repositories\Repository;

use App\Models\Question;
use App\Models\Quiz;
use App\Repositories\Interface\QuestionRepositoryInterface;

class QuestionRepository implements QuestionRepositoryInterface
{
    public function index()
    {
        $questions  = Question::latest()->get();
        return view('pages.question.index', ['questions' => $questions]);
    }

    public function create()
    {
        $quizzes    = Quiz::latest()->get();
        return view('pages.question.create', ['quizzes' => $quizzes]);
    }

    public function store($request)
    {
        try {
            if ($request->isMethod('post')) {
                $data                   = $request->only(['title_ar', 'title_en', 'all_answers', 'right_answer', 'degrees', 'quiz_id']);
                $data['title']['ar']    = $data['title_ar'];
                $data['title']['en']    = $data['title_en'];

                Question::create($data);

                toastr()->success(__('msgs.added', ['name' => __('trans.question')]));
                return redirect()->back();
            }
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }

    public function edit($question)
    {
    }

    public function update($request, $question)
    {
    }

    public function destroy($question)
    {
    }
}