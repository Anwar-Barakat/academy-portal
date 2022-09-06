<?php

namespace App\Http\Controllers\Classroom;

use App\Models\Classroom;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class EmptyClassroomController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        if ($request->ajax()) {
            Classroom::whereIn('id', $request->ids)->delete();


            return response()->json([
                'message'   => 'success',
                'content'   => __('msgs.deleted', __('classroom.classrooms'))
            ]);
        }
    }
}