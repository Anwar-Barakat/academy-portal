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
    }

    public function edit($quiz)
    {
    }

    public function update($request, $quiz)
    {
    }

    public function destroy($quiz)
    {
    }
}