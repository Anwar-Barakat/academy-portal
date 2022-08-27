<?php

namespace App\Http\Controllers;

use App\Models\OnlineClass;
use App\Http\Requests\StoreOnlineClassRequest;
use App\Http\Requests\UpdateOnlineClassRequest;

class OnlineClassController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOnlineClassRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOnlineClassRequest $request)
    {
        //
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
    public function destroy(OnlineClass $onlineClass)
    {
        //
    }
}
