<?php

namespace App\Http\Controllers\Parent;

use App\Http\Controllers\Controller;
use App\Models\MyParent;
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
        return view('pages.parents.profile');
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
    { {
            if ($request->isMethod('put')) {
                $data = $request->only(['father_name_ar', 'father_name_en']);


                $parent = MyParent::findOrFail(Auth::guard('parent')->id());

                if (isset($request->password) && !empty($request->password)) {

                    $this->validate($request, [
                        'father_name_ar'    => 'required|min:3',
                        'father_name_en'    => 'required|min:3',
                        'password'          => 'required|min:8'
                    ]);

                    $parent->update([
                        'father_name'   => [
                            'ar'            => $request->father_name_ar,
                            'en'            => $request->father_name_en,
                        ],
                        'password'      =>  Hash::make($request->password),
                    ]);
                } else {
                    $this->validate($request, [
                        'father_name_ar'        => 'required|min:3',
                        'father_name_en'        => 'required|min:3',
                    ]);

                    $parent->update([
                        'father_name'   => [
                            'ar'            => $request->father_name_ar,
                            'en'            => $request->father_name_en,
                        ],
                    ]);
                }

                toastr()->success(__('msgs.updated', ['name' => __('trans.profile')]));
                return redirect()->back();
            }
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