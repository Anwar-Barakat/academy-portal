<?php

namespace App\Http\Controllers\Subject;

use App\Http\Controllers\Controller;
use App\Models\Teacher;

class GetSubjectController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke($teacher_id)
    {
        $subjects   = Teacher::where('id', $teacher_id)->with('subjects')->whereHas('subjects', function ($query) {
            $query->select('subjects.id', 'subjects.name');
        })->get()->pluck('subjects');

        return $subjects;
    }
}