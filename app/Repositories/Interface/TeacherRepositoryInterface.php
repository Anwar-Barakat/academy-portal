<?php

namespace App\Repositories\Interface;

interface  TeacherRepositoryInterface
{
    public function index();

    public function store($request);

    public function getSpecializations();
}
