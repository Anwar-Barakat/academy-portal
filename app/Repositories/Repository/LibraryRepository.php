<?php

namespace App\Repositories\Repository;

use App\Models\Grade;
use App\Models\Library;
use App\Repositories\Interface\LibraryRepositoryInterface;

class LibraryRepository implements LibraryRepositoryInterface
{
    public function index()
    {
        $library    = Library::latest()->get();
        return view('pages.libraries.index', ['library' => $library]);
    }

    public function create()
    {
    }

    public function store($request)
    {
    }

    public function edit($library)
    {
    }

    public function update($request, $library)
    {
    }

    public function destroy($library)
    {
    }
}