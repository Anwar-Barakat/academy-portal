<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
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

        return view('pages.teachers.students.attendance', ['students' => $students]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $status = '';
        try {
            if ($request->isMethod('post')) {
                foreach ($request->attendences as $studentId => $attendace) {
                    $attendace == 'presence' ? $status = true : $status = false;

                    Attendance::updateOrCreate(['student_id' => $studentId, 'created_at' => date('Y-m-d')], [
                        'status'        => $status,
                        'grade_id'      => $request->grade_id,
                        'classroom_id'  => $request->classroom_id,
                        'section_id'    => $request->section_id,
                        'teacher_id'    => $this->teacherId(),
                    ]);
                }

                toastr()->success(__('msgs.added', ['name' => __('trans.attendances')]));
                return redirect()->back();
            }
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
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