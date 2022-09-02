<?php

namespace App\Http\Controllers\Parent\Account;

use App\Http\Controllers\Controller;
use App\Models\FeeInvoice;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;

class FeeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        $studentsId   = Student::where('parent_id', Auth::guard('parent')->id())->pluck('id');

        $feesInvoices       = FeeInvoice::whereIn('student_id', $studentsId)->get();

        return view('pages.parents.accounts.index', ['feesInvoices' => $feesInvoices]);
    }
}