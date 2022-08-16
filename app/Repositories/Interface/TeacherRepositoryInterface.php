<?php

namespace App\Repositories\Interface;

interface  TeacherRepositoryInterface
{
    public function index();

    public function store($request);

    public function edit($teacher);

    public function update($request, $teacher);

    public function delete($teacher);

    public function getSpecializations();
}