<?php

namespace App\Repositories\Interface;

interface LibraryRepositoryInterface
{
    public function index();

    public function create();

    public function store($request);

    public function edit($library);

    public function update($request, $library);

    public function destroy($library);
}