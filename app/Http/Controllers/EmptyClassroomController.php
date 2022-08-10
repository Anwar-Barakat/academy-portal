<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use Illuminate\Http\Request;

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
        $ids    = explode(",", $request->classrooms_id);

        Classroom::whereIn('id', $ids)->delete();
        toastr()->error(__('msgs.deleted', ['name' => __('classroom.classrooms')]));
        return redirect()->back();
    }
}
