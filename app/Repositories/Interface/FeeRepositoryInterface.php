<?php

namespace App\Repositories\Interface;

interface FeeRepositoryInterface
{
    public function index();

    public function create();

    public function store($request);
}