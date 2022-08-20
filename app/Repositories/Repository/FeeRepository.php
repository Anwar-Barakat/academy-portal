<?php

namespace App\Repositories\Repository;

use App\Models\Fee;
use App\Models\Grade;
use App\Repositories\Interface\FeeRepositoryInterface;

class  FeeRepository implements FeeRepositoryInterface
{
    public function index()
    {
        $fees       = Fee::latest()->get();
        return view('pages.fees.index', ['fees' => $fees]);
    }

    public function create()
    {
        $grades     = Grade::all();
        return view('pages.fees.create', ['grades' => $grades]);
    }

    public function store($request)
    {
        if ($request->isMethod('post')) {
            $data                   = $request->only(['title_ar', 'title_en', 'amount', 'grade_id', 'classroom_id', 'description', 'year']);
            $data['title']['ar']    = $data['title_ar'];
            $data['title']['en']    = $data['title_en'];

            Fee::create($data);

            toastr()->success(__('msgs.added', ['name' => __('fee.fees')]));
            return redirect()->back();
        }
    }
}