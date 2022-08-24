<?php

namespace App\Repositories\Interface;

interface StudentPaymentRepositoryInterface
{
    public function index();

    public function addStudentPayment($student_id);

    public function store($request);

    public function edit($studentPayment);

    public function update($request, $studentPayment);

    public function destroy($studentPayment);
}