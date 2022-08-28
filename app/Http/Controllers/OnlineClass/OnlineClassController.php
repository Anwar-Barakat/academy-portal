<?php

namespace App\Http\Controllers\OnlineClass;

use App\Models\OnlineClass;
use App\Http\Requests\StoreOnlineClassRequest;
use App\Http\Requests\UpdateOnlineClassRequest;
use App\Http\Controllers\Controller;
use App\Http\Traits\MeetingZoomTrait;
use App\Models\Grade;
use Illuminate\Http\Request;
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
        $onlineClasses  = OnlineClass::latest()->get();
        return view('pages.online-classes.index', ['onlineClasses' => $onlineClasses]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $grades         = Grade::all();
        return view('pages.online-classes.create', ['grades' => $grades]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOnlineClassRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOnlineClassRequest $request)
    {
        try {
            $meeting = $this->createMeeting($request);
            OnlineClass::create([
                'grade_id'          => $request->grade_id,
                'classroom_id'      => $request->classroom_id,
                'section_id'        => $request->section_id,
                'user_id'           => auth()->user()->id,
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
     * @param  \App\Models\OnlineClass  $onlineClass
     * @return \Illuminate\Http\Response
     */
    public function show(OnlineClass $onlineClass)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OnlineClass  $onlineClass
     * @return \Illuminate\Http\Response
     */
    public function edit(OnlineClass $onlineClass)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOnlineClassRequest  $request
     * @param  \App\Models\OnlineClass  $onlineClass
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOnlineClassRequest $request, OnlineClass $onlineClass)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OnlineClass  $onlineClass
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, OnlineClass $onlineClass)
    {
        try {
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