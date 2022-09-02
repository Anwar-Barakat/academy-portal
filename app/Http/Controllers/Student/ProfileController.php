<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.students.profile');
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->isMethod('put')) {
            $data = $request->only(['name_ar', 'name_en']);

            $student = Student::findOrFail(Auth::guard('student')->user()->id);
            if (isset($request->password) && !empty($request->password)) {

                $this->validate($request, [
                    'name_ar'   => 'required|min:3',
                    'name_en'   => 'required|min:3',
                    'password'   => 'required|min:8'
                ]);

                $data['name']['ar'] = $request->name_ar;
                $data['name']['en'] = $request->name_en;
                $data['password']   = Hash::make($request->password);
                $student->update($data);
            } else {
                $this->validate($request, [
                    'name_ar'   => 'required|min:3',
                    'name_en'   => 'required|min:3',
                ]);

                $data['name']['ar'] = $request->name_ar;
                $data['name']['en'] = $request->name_en;
                $student->update($data);
            }

            toastr()->success(__('msgs.updated', ['name' => __('trans.profile')]));
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}