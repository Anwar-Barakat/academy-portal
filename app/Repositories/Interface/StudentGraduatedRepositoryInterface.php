<?php

namespace App\Repositories\Interface;

interface StudentGraduatedRepositoryInterface
{
    public function index();

    public function create();

    public function graduated($request);

    public function returned($request);

    public function destroy($id);
}