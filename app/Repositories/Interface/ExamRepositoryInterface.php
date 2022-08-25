<?php

namespace App\Repositories\Interface;

interface ExamRepositoryInterface
{
    public function index();

    public function create();

    public function store($request);

    public function edit($exam);

    public function update($request, $exam);

    public function destroy($exam);
}