<?php

namespace App\Http\Controllers\Parent;

use App\Http\Controllers\Controller;
use App\Models\Degree;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChildResultController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke($id)
    {
        $student        = Student::where('id', $id)->where('parent_id', Auth::guard('parent')->id())->first();

        if ($student) {

            $degrees        = Degree::where('student_id', $student->id)->orderBy('id', 'desc')->get();

            if ($degrees->isEmpty()) {
                toastr()->error(__('msgs.no_student_degree'));
                return back();
            }

            return view('pages.parents.degrees.index', ['degrees' => $degrees]);
        } else
            return redirect()->back();
    }
}