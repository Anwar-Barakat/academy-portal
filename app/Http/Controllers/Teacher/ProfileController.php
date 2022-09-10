<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
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
        return view('pages.teachers.profile');
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

            $teacher = Teacher::findOrFail(Auth::guard('teacher')->id());
            if (isset($request->password) && !empty($request->password)) {

                $this->validate($request, [
                    'name_ar'   => 'required|min:3',
                    'name_en'   => 'required|min:3',
                    'password'   => 'required|min:8'
                ]);

                $data['name']['ar'] = $request->name_ar;
                $data['name']['en'] = $request->name_en;
                $data['password']   = Hash::make($request->password);
                $teacher->update($data);
            } else {
                $this->validate($request, [
                    'name_ar'   => 'required|min:3',
                    'name_en'   => 'required|min:3',
                ]);

                $data['name']['ar'] = $request->name_ar;
                $data['name']['en'] = $request->name_en;
                $teacher->update($data);
            }

            toastr()->success(__('msgs.updated', ['name' => __('teacher.profile')]));
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