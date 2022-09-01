<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Traits\MeetingZoomTrait;
use App\Models\Grade;
use App\Models\OnlineClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use MacsiDigital\Zoom\Facades\Zoom;

class OnlineClassController extends Controller
{
    use MeetingZoomTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $onlineClasses  = OnlineClass::where('created_by', Auth::guard('teacher')->user()->email)->latest()->get();
        return view('pages.teachers.online-classes.index', ['onlineClasses' => $onlineClasses]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $grades         = Grade::all();
        return view('pages.teachers.online-classes.create', ['grades' => $grades]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $meeting = $this->createMeeting($request);
            OnlineClass::create([
                'grade_id'          => $request->grade_id,
                'classroom_id'      => $request->classroom_id,
                'section_id'        => $request->section_id,
                'created_by'        => auth()->guard('teacher')->user()->email,
                'meeting_id'        => $meeting->id,
                'topic'             => $request->topic,
                'start_at'          => $request->start_time,
                'duration'          => $meeting->duration,
                'password'          => $meeting->password,
                'start_url'         => $meeting->start_url,
                'join_url'          => $meeting->join_url,
            ]);

            toastr()->success(__('msgs.added', ['name' => __('trans.online_class')]));
            return redirect()->back();
        } catch (\Throwable $th) {
            return redirect()->back()->with(['error' => $th->getMessage()]);
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
    public function destroy(Request $request, $id)
    {
        try {
            $onlineClass = OnlineClass::findOrFail($id);

            if ($onlineClass->integration == false)
                $onlineClass->delete();
            else {
                $meeting = Zoom::meeting()->find($request->meeting_id);
                $meeting->delete();
                $onlineClass->delete();
            }

            toastr()->info(__('msgs.deleted', ['name' => __('trans.online_class')]));
            return redirect()->back();
        } catch (\Throwable $th) {
            return redirect()->back()->with(['error' => $th->getMessage()]);
        }
    }
}