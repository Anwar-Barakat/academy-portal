<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Section;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SectionController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $sectionIds     = Teacher::findOrFail(Auth::guard('teacher')->id())->sections()->pluck('section_id');

        $sections       = Section::whereIn('id', $sectionIds)->get();

        return view('pages.teachers.sections.index', ['sections' => $sections]);
    }
}