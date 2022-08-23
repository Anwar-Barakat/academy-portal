<?php

namespace App\Http\Controllers;

use App\Models\FeeProcessing;
use App\Http\Requests\StoreFeeProcessingRequest;
use App\Http\Requests\UpdateFeeProcessingRequest;

class FeeProcessingController extends Controller
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
     * @param  \App\Http\Requests\StoreFeeProcessingRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFeeProcessingRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FeeProcessing  $feeProcessing
     * @return \Illuminate\Http\Response
     */
    public function show(FeeProcessing $feeProcessing)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FeeProcessing  $feeProcessing
     * @return \Illuminate\Http\Response
     */
    public function edit(FeeProcessing $feeProcessing)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFeeProcessingRequest  $request
     * @param  \App\Models\FeeProcessing  $feeProcessing
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFeeProcessingRequest $request, FeeProcessing $feeProcessing)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FeeProcessing  $feeProcessing
     * @return \Illuminate\Http\Response
     */
    public function destroy(FeeProcessing $feeProcessing)
    {
        //
    }
}
