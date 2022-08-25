<?php

namespace App\Repositories\Interface;

interface ExamRepositoryInterface
{
    public function index();

    public function store($request);

    public function update($request, $exam);

    public function destroy($exam);
}