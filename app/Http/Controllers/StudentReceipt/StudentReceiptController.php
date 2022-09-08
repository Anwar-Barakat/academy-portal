<?php

namespace App\Http\Controllers\StudentReceipt;

use App\Models\StudentReceipt;
use App\Http\Requests\StoreStudentReceiptRequest;
use App\Http\Requests\UpdateStudentReceiptRequest;
use App\Http\Controllers\Controller;
use App\Repositories\Interface\StudentReceiptRepositoryInterface;

class StudentReceiptController extends Controller
{
    public $receipt;
    public function __construct(StudentReceiptRepositoryInterface $receipt)
    {
        $this->receipt = $receipt;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->receipt->index();
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
     * @param  \App\Http\Requests\StoreStudentReceiptRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStudentReceiptRequest $request)
    {
        return $this->receipt->store($request);
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
        return $this->receipt->edit($studentReceipt);
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
        return $this->receipt->update($request, $studentReceipt);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StudentReceipt  $studentReceipt
     * @return \Illuminate\Http\Response
     */
    public function destroy(StudentReceipt $studentReceipt)
    {
        return $this->receipt->destroy($studentReceipt);
    }

    public function addStudentReceipt($student_id)
    {
        return $this->receipt->addStudentReceipt($student_id);
    }
}