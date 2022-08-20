<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Interface\StudentGraduatedRepositoryInterface;

class StudentGraduatedController extends Controller
{
    public $graduated;

    public function __construct(StudentGraduatedRepositoryInterface $graduated)
    {
        $this->graduated = $graduated;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->graduated->index();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->graduated->create();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'grade_id'      => 'required',
            'classroom_id'  => 'required',
            'section_id'    => 'required',
        ]);
        return $this->graduated->graduated($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }


    public function update(Request $request)
    {
        return $this->graduated->returned($request);
    }


    public function destroy($request)
    {
        return $this->graduated->destroy($request);
    }
}