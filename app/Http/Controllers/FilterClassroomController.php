<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Grade;
use Illuminate\Http\Request;

class FilterClassroomController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $grade_id   = $request->only(['grade_id']);
        $grades     = Grade::all();

        $search = Classroom::where('grade_id', $grade_id)->get();
        return redirect()->back()->with(['classroomsSeached' => $search]);
    }
}