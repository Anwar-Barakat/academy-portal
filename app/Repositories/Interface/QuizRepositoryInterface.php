<?php

namespace App\Repositories\Interface;

interface QuizRepositoryInterface
{
    public function index();

    public function create();

    public function store($request);

    public function edit($quiz);

    public function update($request, $quiz);

    public function destroy($quiz);
}