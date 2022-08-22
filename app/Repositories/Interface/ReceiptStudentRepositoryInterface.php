<?php

namespace App\Repositories\Interface;

interface ReceiptStudentRepositoryInterface
{
    public function index();

    public function store($request);

    public function edit();

    public function update();

    public function addStudentReceipt($student_id);
}
