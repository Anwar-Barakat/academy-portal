<?php

namespace App\Http\Controllers\Section;

use App\Models\Section;
use App\Http\Requests\StoreSectionRequest;
use App\Http\Requests\UpdateSectionRequest;
use App\Models\Grade;
use App\Http\Controllers\Controller;
use App\Models\Teacher;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grades     = Grade::with(['sections'])->get();
        $teachers   = Teacher::latest()->get();
        return view('pages.sections.index', ['grades' => $grades, 'teachers' => $teachers]);
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
     * @param  \App\Http\Requests\StoreSectionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSectionRequest $request)
    {
        try {
            $data       = $request->only(['name_ar', 'name_en', 'grade_id', 'classroom_id', 'teacher_id']);
            $data['name']['ar'] = $data['name_ar'];
            $data['name']['en'] = $data['name_en'];
            $section    = Section::create($data);


            $section->teachers()->attach($data['teacher_id']);


            toastr()->success(__('msgs.added', ['name' => __('section.section')]));
            return redirect()->route('sections.index');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function show(Section $section)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function edit(Section $section)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSectionRequest  $request
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSectionRequest $request, Section $section)
    {
        try {
            $data   = $request->only(['name_ar', 'name_en', 'grade_id', 'classroom_id', 'status', 'teacher_id']);
            $data['name']['ar'] = $data['name_ar'];
            $data['name']['en'] = $data['name_en'];
            $data['status']     = $request->status;
            return $data;
            $section->update($data);

            $section->teachers()->sync($data['teacher_id']);

            toastr()->success(__('msgs.updated', ['name' => __('section.section')]));
            return redirect()->route('sections.index');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function destroy(Section $section)
    {
        try {

            $teachers = $section->teachers()->count();
            if ($teachers > 0)
                toastr()->error(__('msgs.forign_error', ['parent' => __('section.section'), 'children' => __('teacher.teachers')]));

            else {
                $section->delete();
                toastr()->info(__('msgs.delete', ['name' => __('section.section')]));
            }
            return redirect()->route('sections.index');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }
}