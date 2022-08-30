<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherDashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $data['sectionIds']     = Teacher::findOrFail(Auth::guard('teacher')->id())->sections()->pluck('section_id');

        $data['sectionsCount']  = $data['sectionIds']->count();

        $data['studentsCount']  = Student::whereIn('section_id', $data['sectionIds'])->count();

        return view('pages.teachers.dashboard', $data);
    }
}