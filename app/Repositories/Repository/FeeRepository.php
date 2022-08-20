<?php

namespace App\Repositories\Repository;

use App\Models\Fee;
use App\Repositories\Interface\FeeRepositoryInterface;

class  FeeRepository implements FeeRepositoryInterface
{
    public function index()
    {
        $fees   = Fee::latest()->get();
        return view('pages.fees.index', ['fees' => $fees]);
    }
}