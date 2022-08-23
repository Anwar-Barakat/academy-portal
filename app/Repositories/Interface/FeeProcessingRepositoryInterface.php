<?php

namespace App\Repositories\Interface;

interface FeeProcessingRepositoryInterface
{
    public function index();

    public function store($request);

    public function edit($feeProcessing);

    public function update($request, $feeProcessing);

    public function destroy($feeProcessing);

    public function addFeeExclusion($student_id);
}