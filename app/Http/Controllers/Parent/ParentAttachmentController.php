<?php

namespace App\Http\Controllers\Parent;

use App\Models\ParentAttachment;
use App\Http\Requests\StoreParentAttachmentRequest;
use App\Http\Requests\UpdateParentAttachmentRequest;
use App\Http\Controllers\Controller;


class ParentAttachmentController extends Controller
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
     * @param  \App\Http\Requests\StoreParentAttachmentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreParentAttachmentRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ParentAttachment  $parentAttachment
     * @return \Illuminate\Http\Response
     */
    public function show(ParentAttachment $parentAttachment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ParentAttachment  $parentAttachment
     * @return \Illuminate\Http\Response
     */
    public function edit(ParentAttachment $parentAttachment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateParentAttachmentRequest  $request
     * @param  \App\Models\ParentAttachment  $parentAttachment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateParentAttachmentRequest $request, ParentAttachment $parentAttachment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ParentAttachment  $parentAttachment
     * @return \Illuminate\Http\Response
     */
    public function destroy(ParentAttachment $parentAttachment)
    {
        //
    }
}