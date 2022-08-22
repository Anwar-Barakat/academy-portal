<?php

namespace App\Repositories\Interface;

interface ReceiptStudentRepositoryInterface
{
    public function index();

    public function store($request);

    public function edit($studentReceipt);

    public function update($request, $studentReceipt);

    public function destroy($studentReceipt);

    public function addStudentReceipt($student_id);
}