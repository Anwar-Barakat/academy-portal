<?php

namespace App\Http\Controllers\Teacher\Quiz;

use App\Http\Controllers\Controller;
use App\Models\Degree;
use Illuminate\Http\Request;

class StudentWasExamedController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke($quiz_id)
    {
        $degrees    = Degree::with(['quiz'])->where('quiz_id', $quiz_id)->get();
        return view('pages.teachers.quizzes.students-was-examed', ['degrees' => $degrees]);
    }
}