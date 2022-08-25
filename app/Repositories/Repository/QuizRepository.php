<?php

namespace App\Repositories\Repository;

use App\Models\Quiz;
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