<?php

namespace App\Http\Controllers;

use App\Models\StudentAccount;
use App\Http\Requests\StoreStudentAccountRequest;
use App\Http\Requests\UpdateStudentAccountRequest;

class StudentAccountController extends Controller
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
     * @param  \App\Http\Requests\StoreStudentAccountRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStudentAccountRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StudentAccount  $studentAccount
     * @return \Illuminate\Http\Response
     */
    public function show(StudentAccount $studentAccount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StudentAccount  $studentAccount
     * @return \Illuminate\Http\Response
     */
    public function edit(StudentAccount $studentAccount)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStudentAccountRequest  $request
     * @param  \App\Models\StudentAccount  $studentAccount
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStudentAccountRequest $request, StudentAccount $studentAccount)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StudentAccount  $studentAccount
     * @return \Illuminate\Http\Response
     */
    public function destroy(StudentAccount $studentAccount)
    {
        //
    }
}
