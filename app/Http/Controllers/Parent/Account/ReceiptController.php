<?php

namespace App\Http\Controllers\Parent\Account;

use App\Http\Controllers\Controller;
use App\Models\StudentReceipt;
use Illuminate\Http\Request;

class ReceiptController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke($id)
    {
        $studentReceipts = StudentReceipt::where('student_id', $id)->get();

        if ($studentReceipts->isEmpty()) {
            toastr()->error(__('msgs.no_receipts'));
            return back();
        }

        return view('pages.parents.accounts.receipts', ['studentReceipts' => $studentReceipts]);
    }
}