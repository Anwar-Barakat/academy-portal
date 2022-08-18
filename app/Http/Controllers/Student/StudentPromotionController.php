<?php

namespace App\Http\Controllers\Student;

use App\Models\StudentPromotion;
use App\Http\Requests\StoreStudentPromotionRequest;
use App\Http\Requests\UpdateStudentPromotionRequest;
use App\Http\Controllers\Controller;
use App\Repositories\Interface\StudentPromotionRepositoryInterface;

class StudentPromotionController extends Controller
{
    public $promotion;
    public function __construct(StudentPromotionRepositoryInterface $promotion)
    {
        $this->promotion = $promotion;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->promotion->index();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->promotion->create();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreStudentPromotionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStudentPromotionRequest $request)
    {
        return $this->promotion->store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StudentPromotion  $studentPromotion
     * @return \Illuminate\Http\Response
     */
    public function show(StudentPromotion $studentPromotion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StudentPromotion  $studentPromotion
     * @return \Illuminate\Http\Response
     */
    public function edit(StudentPromotion $studentPromotion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStudentPromotionRequest  $request
     * @param  \App\Models\StudentPromotion  $studentPromotion
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStudentPromotionRequest $request, StudentPromotion $studentPromotion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StudentPromotion  $studentPromotion
     * @return \Illuminate\Http\Response
     */
    public function destroy(StudentPromotion $studentPromotion)
    {
        //
    }
}