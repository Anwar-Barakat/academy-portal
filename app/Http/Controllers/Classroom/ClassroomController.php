<?php

namespace App\Http\Controllers\Classroom;

use App\Models\Classroom;
use App\Http\Requests\StoreClassroomRequest;
use App\Http\Requests\UpdateClassroomRequest;
use App\Models\Grade;
use Flasher\Laravel\Http\Request;
use App\Http\Controllers\Controller;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classrooms = Classroom::with(['grades'])->get();
        $grades     = Grade::all();
        return view('pages.classrooms.index', ['classrooms' => $classrooms, 'grades' => $grades]);
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
     * @param  \App\Http\Requests\StoreClassroomRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClassroomRequest $request)
    {
        try {

            $data = $request->classrooms_list;

            foreach ($data as $classroom) {
                Classroom::create([
                    'name'      => [
                        'ar'    => $classroom['name_ar'],
                        'en'    => $classroom['name_en'],
                    ],
                    'grade_id'  => $classroom['grade_id']
                ]);
            }

            toastr()->success(__('msgs.added', ['name' => __('classroom.classrooms')]));
            return redirect()->route('classrooms.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function show(Classroom $classroom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function edit(Classroom $classroom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateClassroomRequest  $request
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClassroomRequest $request, Classroom $classroom)
    {
        try {

            $data = $request->only(['name_ar', 'name_en', 'grade_id']);
            $classroom->update([
                'name'      => [
                    'ar'    => $data['name_ar'],
                    'en'    => $data['name_en'],
                ],
                'grade_id'  => $data['grade_id'],
            ]);

            toastr()->success(__('msgs.updated', ['name' => __('classroom.classroom')]));
            return redirect()->route('classrooms.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function destroy(Classroom $classroom)
    {
        try {
            $classroom->delete();
            toastr()->info(__('msgs.deleted', ['name' => __('classroom.classroom')]));
            return redirect()->route('classrooms.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}