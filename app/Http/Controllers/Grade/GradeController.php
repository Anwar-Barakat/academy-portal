<?php

namespace App\Http\Controllers\Grade;


use App\Models\Grade;
use App\Http\Requests\StoreGradeRequest;
use App\Http\Requests\UpdateGradeRequest;
use App\Models\Classroom;
use App\Http\Controllers\Controller;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grades    =  Grade::all();
        return view('pages.grades.index', ['grades' => $grades]);
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
     * @param  \App\Http\Requests\StoreGradeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGradeRequest $request)
    {
        $data = $request->only(['name_ar', 'name_en', 'notes']);

        try {
            Grade::create([
                'name'      => [
                    'ar'    => $data['name_ar'],
                    'en'    => $data['name_en'],
                ],
                'notes'     => $data['notes']
            ]);

            toastr()->success(__('msgs.added', ['name' => __('grade.grade')]));
            return redirect()->route('grades.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function show(Grade $grade)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function edit(Grade $grade)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateGradeRequest  $request
     * @param  \App\Models\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGradeRequest $request, Grade $grade)
    {
        $data = $request->only(['name_ar', 'name_en', 'notes']);

        try {

            $grade->update([
                'name'      => [
                    'ar'    => $data['name_ar'],
                    'en'    => $data['name_en'],
                ],
                'notes'     => $data['notes']
            ]);
            toastr()->success(__('msgs.updated', ['name' => __('grade.grade')]));
            return redirect()->route('grades.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function destroy(Grade $grade)
    {
        $classrooms = Classroom::where('grade_id', $grade->id)->get();
        if ($classrooms->count() > 0)
            toastr()->error(__('msgs.delete_grade_error'));

        else {
            $grade->delete();
            toastr()->info(__('msgs.deleted', ['name' => __('grade.grade')]));
        }
        return redirect()->route('grades.index');
    }
}
