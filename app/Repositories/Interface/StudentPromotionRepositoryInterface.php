<?php

namespace App\Repositories\Interface;

interface StudentPromotionRepositoryInterface
{
    public function index();

    public function store($request);
}