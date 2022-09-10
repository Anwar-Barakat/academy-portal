<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\Library;
use App\Models\Section;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LibraryController extends Controller
{
    public function index()
    {
        $student    = Student::findOrFail(Auth::guard('student')->id());

        $grade      = Grade::findOrFail($student->grade_id);

        $section    = $grade->sections()->where('id', $student->section_id)->first();

        $teachers   = $section->teachers;

        foreach ($teachers as $teacher) {
            $books = Library::where(['teacher_id' => $teacher->id, 'section_id' => $section->id])->get();
        }

        return view('pages.students.library.index', ['books' => $books]);
    }


    public function download($file_name, $tId)
    {
        $teacher = Teacher::findOrFail($tId);
        return response()->download('attachments/library/' . $teacher->getTranslation('name', 'en') . '/' . $file_name);
    }
}