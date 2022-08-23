<?php

namespace App\Repositories\Interface;

interface StudentPaymentRepositoryInterface
{
    public function index();

    public function addStudentPayment($student_id);

    public function store($request);
}