<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sectionIds     = Teacher::findOrFail($this->teacherId())->sections()->pluck('section_id');

        $students       = Student::whereIn('section_id', $sectionIds)->get();

        return view('pages.teachers.students.attendance-report', ['students' => $students]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'from'      => 'required|date|date_format:Y-m-d',
            'to'        => 'required|date|date_format:Y-m-d|after_or_equal:from',
        ]);
        $data = $request->only(['student_id', 'from', 'to']);

        $sectionIds     = Teacher::findOrFail($this->teacherId())->sections()->pluck('section_id');

        $students       = Student::whereIn('section_id', $sectionIds)->get();

        if ($data['student_id'] ==  'all')
            $searchedStudents = Attendance::whereBetween('created_at', [$data['from'], $data['to']])->get();
        else
            $searchedStudents = Attendance::whereBetween('created_at', [$data['from'], $data['to']])->where('student_id', $data['student_id'])->get();

        return view('pages.teachers.students.attendance-report', ['students' => $students, 'searchedStudents' => $searchedStudents]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    private function teacherId()
    {
        return Auth::guard('teacher')->id();
    }
}