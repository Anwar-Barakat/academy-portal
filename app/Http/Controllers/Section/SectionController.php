<?php

namespace App\Http\Controllers\Section;

use App\Models\Section;
use App\Http\Requests\StoreSectionRequest;
use App\Http\Requests\UpdateSectionRequest;
use App\Models\Grade;
use App\Http\Controllers\Controller;


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
        return view('pages.sections.index', compact('grades'));
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
            $data   = $request->only(['name_ar', 'name_en', 'grade_id', 'classroom_id']);
            Section::create([
                'name'          => [
                    'ar'        => $data['name_ar'],
                    'en'        => $data['name_en'],
                ],
                'status'        => 1,
                'grade_id'      => $data['grade_id'],
                'classroom_id'  => $data['classroom_id']
            ]);

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
            $data   = $request->only(['name_ar', 'name_en', 'grade_id', 'classroom_id', 'status']);
            $section->update([
                'name'          => [
                    'ar'        => $data['name_ar'],
                    'en'        => $data['name_en'],
                ],
                'status'        => 1,
                'grade_id'      => $data['grade_id'],
                'classroom_id'  => $data['classroom_id']
            ]);

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
            $section->delete();
            toastr()->info(__('msgs.delete', ['name' => __('section.section')]));
            return redirect()->route('sections.index');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }
}
