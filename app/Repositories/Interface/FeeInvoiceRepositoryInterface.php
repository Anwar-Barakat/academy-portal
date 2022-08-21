<?php

namespace App\Repositories\Interface;

interface FeeInvoiceRepositoryInterface
{
    public function index();

    public function create($student_id);

    public function store($request);

    public function edit($feeInvoice);

    public function update($request, $feeInvoice);
}