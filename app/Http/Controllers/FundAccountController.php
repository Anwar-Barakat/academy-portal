<?php

namespace App\Http\Controllers;

use App\Models\FundAccount;
use App\Http\Requests\StoreFundAccountRequest;
use App\Http\Requests\UpdateFundAccountRequest;

class FundAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreFundAccountRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFundAccountRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FundAccount  $fundAccount
     * @return \Illuminate\Http\Response
     */
    public function show(FundAccount $fundAccount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FundAccount  $fundAccount
     * @return \Illuminate\Http\Response
     */
    public function edit(FundAccount $fundAccount)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFundAccountRequest  $request
     * @param  \App\Models\FundAccount  $fundAccount
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFundAccountRequest $request, FundAccount $fundAccount)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FundAccount  $fundAccount
     * @return \Illuminate\Http\Response
     */
    public function destroy(FundAccount $fundAccount)
    {
        //
    }
}
