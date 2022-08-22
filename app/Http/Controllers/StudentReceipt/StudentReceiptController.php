<?php

namespace App\Http\Controllers\StudentReceipt;

use App\Models\StudentReceipt;
use App\Http\Requests\StoreStudentReceiptRequest;
use App\Http\Requests\UpdateStudentReceiptRequest;
use App\Http\Controllers\Controller;

class StudentReceiptController extends Controller
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
     * @param  \App\Http\Requests\StoreStudentReceiptRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStudentReceiptRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StudentReceipt  $studentReceipt
     * @return \Illuminate\Http\Response
     */
    public function show(StudentReceipt $studentReceipt)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StudentReceipt  $studentReceipt
     * @return \Illuminate\Http\Response
     */
    public function edit(StudentReceipt $studentReceipt)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStudentReceiptRequest  $request
     * @param  \App\Models\StudentReceipt  $studentReceipt
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStudentReceiptRequest $request, StudentReceipt $studentReceipt)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StudentReceipt  $studentReceipt
     * @return \Illuminate\Http\Response
     */
    public function destroy(StudentReceipt $studentReceipt)
    {
        //
    }
}