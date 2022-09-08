<?php

namespace App\Http\Controllers\FeeInvoice;

use App\Models\FeeInvoice;
use App\Http\Requests\StoreFeeInvoiceRequest;
use App\Http\Requests\UpdateFeeInvoiceRequest;
use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Repositories\Interface\FeeInvoiceRepositoryInterface;

class FeeInvoiceController extends Controller
{
    public $feeInvoice;
    public function __construct(FeeInvoiceRepositoryInterface $feeInvoice)
    {
        $this->feeInvoice = $feeInvoice;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->feeInvoice->index();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreFeeInvoiceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFeeInvoiceRequest $request)
    {
        return $this->feeInvoice->store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FeeInvoice  $feeInvoice
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FeeInvoice  $feeInvoice
     * @return \Illuminate\Http\Response
     */
    public function edit(FeeInvoice $feeInvoice)
    {
        return $this->feeInvoice->edit($feeInvoice);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFeeInvoiceRequest  $request
     * @param  \App\Models\FeeInvoice  $feeInvoice
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFeeInvoiceRequest $request, FeeInvoice $feeInvoice)
    {
        return $this->feeInvoice->update($request, $feeInvoice);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FeeInvoice  $feeInvoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(FeeInvoice $feeInvoice)
    {
        return $this->feeInvoice->destroy($feeInvoice);
    }

    
    public function addStudentInvoice($id)
    {
        return $this->feeInvoice->create($id);
    }
}