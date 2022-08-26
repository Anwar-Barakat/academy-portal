<?php

namespace App\Repositories\Interface;

interface QuestionRepositoryInterface
{
    public function index();

    public function create();

    public function store($request);

    public function edit($question);

    public function update($request, $question);

    public function destroy($question);
}