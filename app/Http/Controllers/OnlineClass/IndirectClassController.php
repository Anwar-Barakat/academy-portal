<?php

namespace App\Http\Controllers\OnlineClass;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\OnlineClass;
use Illuminate\Http\Request;

class IndirectClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $grades         = Grade::all();
        return view('pages.online-classes.indirect', ['grades' => $grades]);
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
            OnlineClass::create([
                'integration'       => false,
                'grade_id'          => $request->grade_id,
                'classroom_id'      => $request->classroom_id,
                'section_id'        => $request->section_id,
                'created_by'        => auth()->guard('web')->user()->email,
                'meeting_id'        => $request->meeting_id,
                'topic'             => $request->topic,
                'start_at'          => $request->start_time,
                'duration'          => $request->duration,
                'password'          => $request->password,
                'start_url'         => $request->start_url,
                'join_url'          => $request->join_url,
            ]);

            toastr()->success(__('msgs.added', ['name' => __('trans.new_class')]));
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
    public function destroy($id)
    {
        //
    }
}