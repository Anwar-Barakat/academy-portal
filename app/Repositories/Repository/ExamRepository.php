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

    public function create()
    {
    }

    public function store($request)
    {
    }

    public function edit($exam)
    {
    }

    public function update($request, $exam)
    {
    }

    public function destroy($exam)
    {
    }
}