<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Section;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;

class GetTeacherController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke($section_id)
    {
        $teachers   = Section::where('id', $section_id)->with('teachers')->whereHas('teachers', function ($query) {
            $query->select('teachers.id', 'teachers.name');
        })->get()->pluck('teachers');
        return $teachers;
    }
}