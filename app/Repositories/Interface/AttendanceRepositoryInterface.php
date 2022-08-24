<?php

namespace App\Repositories\Interface;

interface AttendanceRepositoryInterface
{
    public function index();

    public function addAttendance($section_id);
}