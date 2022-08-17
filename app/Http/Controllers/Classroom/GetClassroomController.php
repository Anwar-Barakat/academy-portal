<?php

namespace App\Http\Controllers\Classroom;

use App\Models\Classroom;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GetClassroomController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke($grade_id)
    {
        $classrooms = Classroom::where('grade_id', $grade_id)->pluck('name', 'id');

        return $classrooms;
    }
}