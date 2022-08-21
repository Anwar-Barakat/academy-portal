<?php

namespace App\Repositories\Interface;

interface FeeRepositoryInterface
{
    public function index();

    public function create();

    public function store($request);

    public function edit($fee);

    public function update($request, $fee);

    public function destroy($fee);
}
