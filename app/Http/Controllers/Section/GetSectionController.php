<?php

namespace App\Http\Controllers\Section;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Section;

class GetSectionController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke($classroom_id)
    {
        $sections = Section::where('classroom_id', $classroom_id)->pluck('name', 'id');

        return $sections;
    }
}