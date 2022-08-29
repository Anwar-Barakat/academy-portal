<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $data   = $request->only(['type', 'email', 'password']);

        $this->validate($request, [
            'email'     => 'required|email',
            'password'  => 'required|min:8'
        ]);

        if ($request->isMethod('post')) {

            if ($data['type'] == 'admin') {
                if (Auth::guard('web')->attempt(['email' => $data['email'], 'password' => $data['password']])) {
                    toastr()->success(__('trans.welcome_back'));
                    return redirect()->intended(RouteServiceProvider::HOME);
                } else {
                    toastr()->error(__('trans.email_or_password'));
                    return redirect()->back();
                }
            } elseif ($data['type'] == 'teacher') {
                if (Auth::guard('teacher')->attempt(['email' => $data['email'], 'password' => $data['password']])) {
                    toastr()->success(__('trans.welcome_back'));
                    return redirect()->intended(RouteServiceProvider::TEACHER);
                } else {
                    toastr()->error(__('trans.email_or_password'));
                    return redirect()->back();
                }
            } elseif ($data['type'] == 'parent') {
                if (Auth::guard('parent')->attempt(['email' => $data['email'], 'password' => $data['password']])) {
                    toastr()->success(__('trans.welcome_back'));
                    return redirect()->intended(RouteServiceProvider::PARENT);
                } else {
                    toastr()->error(__('trans.email_or_password'));
                    return redirect()->back();
                }
            } elseif ($data['type'] == 'student') {
                if (Auth::guard('student')->attempt(['email' => $data['email'], 'password' => $data['password']])) {
                    toastr()->success(__('trans.welcome_back'));
                    return redirect()->intended(RouteServiceProvider::STUDENT);
                } else {
                    toastr()->error(__('trans.email_or_password'));
                    return redirect()->back();
                }
            }
        }
    }
}