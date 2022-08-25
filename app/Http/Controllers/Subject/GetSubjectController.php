<?php

namespace App\Http\Controllers\Subject;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Http\Request;

class GetSubjectController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke($grade_id, $classroom_id)
    {
        $subjects = Subject::where(['grade_id' => $grade_id, 'classroom_id' => $classroom_id])->pluck('name', 'id');

        return $subjects;
    }
}