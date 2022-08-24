<?php

namespace App\Repositories\Repository;

use App\Models\Grade;
use App\Models\Teacher;
use App\Repositories\Interface\SubjectRepositoryInterface;

class SubjectRepository implements SubjectRepositoryInterface
{
    public function index()
    {
    }

    public function create()
    {
        $grades     = Grade::all();
        $teachers   = Teacher::with('specialization')->get();
        return view('pages.subjects.create', ['grades' => $grades, 'teachers' => $teachers]);
    }

    public function store($request)
    {
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