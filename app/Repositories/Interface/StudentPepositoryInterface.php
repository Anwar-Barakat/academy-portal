<?php

namespace App\Repositories\Interface;

interface StudentPepositoryInterface
{
    public function index();

    public function create();

    public function store($request);

    public function edit($student);

    public function update($request, $student);

    public function delete($student);
}