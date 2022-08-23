<?php

namespace App\Http\Controllers\FeeProcessing;

use App\Models\FeeProcessing;
use App\Http\Requests\StoreFeeProcessingRequest;
use App\Http\Requests\UpdateFeeProcessingRequest;
use App\Http\Controllers\Controller;
use App\Repositories\Interface\FeeProcessingRepositoryInterface;

class FeeProcessingController extends Controller
{
    public $processing;
    public function __construct(FeeProcessingRepositoryInterface $processing)
    {
        $this->processing = $processing;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->processing->index();
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
        return $this->processing->store($request);
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
        return $this->processing->edit($feeProcessing);
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
        return $this->processing->update($request, $feeProcessing);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FeeProcessing  $feeProcessing
     * @return \Illuminate\Http\Response
     */
    public function destroy(FeeProcessing $feeProcessing)
    {
        return $this->processing->destroy($feeProcessing);
    }

    public function addFeeExclusion($student_id)
    {
        return $this->processing->addFeeExclusion($student_id);
    }
}