<?php

namespace App\Http\Controllers\StudentPayment;

use App\Models\StudentPayment;
use App\Http\Requests\StoreStudentPaymentRequest;
use App\Http\Requests\UpdateStudentPaymentRequest;
use App\Http\Controllers\Controller;
use App\Repositories\Interface\StudentPaymentRepositoryInterface;

class StudentPaymentController extends Controller
{
    public $payment;
    public function __construct(StudentPaymentRepositoryInterface $payment)
    {
        $this->payment = $payment;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->payment->index();
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
     * @param  \App\Http\Requests\StoreStudentPaymentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStudentPaymentRequest $request)
    {
        return $this->payment->store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StudentPayment  $studentPayment
     * @return \Illuminate\Http\Response
     */
    public function show(StudentPayment $studentPayment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StudentPayment  $studentPayment
     * @return \Illuminate\Http\Response
     */
    public function edit(StudentPayment $studentPayment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStudentPaymentRequest  $request
     * @param  \App\Models\StudentPayment  $studentPayment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStudentPaymentRequest $request, StudentPayment $studentPayment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StudentPayment  $studentPayment
     * @return \Illuminate\Http\Response
     */
    public function destroy(StudentPayment $studentPayment)
    {
        //
    }


    public function addStudentPayment($student_id)
    {
        return $this->payment->addStudentPayment($student_id);
    }
}