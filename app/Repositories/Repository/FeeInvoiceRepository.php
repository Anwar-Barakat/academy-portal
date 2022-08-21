<?php

namespace App\Repositories\Repository;

use App\Models\Fee;
use App\Models\FeeInvoice;
use App\Models\Grade;
use App\Models\Student;
use App\Models\StudentAccount;
use App\Repositories\Interface\FeeInvoiceRepositoryInterface;
use Illuminate\Support\Facades\DB;

class FeeInvoiceRepository implements FeeInvoiceRepositoryInterface
{
    public function index()
    {
        $feeInvoices    = FeeInvoice::latest()->get();
        $grades         = Grade::all();
        return view('pages.fee-invoices.index', ['feeInvoices' => $feeInvoices, 'grades' => $grades]);
    }


    public function create($student_id)
    {
        $student    = Student::findorfail($student_id);
        $fees       = Fee::where('classroom_id', $student->classroom_id)->get();
        return view('pages.fee-invoices.create', [
            'student'   => $student,
            'fees'      => $fees
        ]);
    }

    public function store($request)
    {
        DB::beginTransaction();
        try {
            if ($request->isMethod('post')) {
                foreach ($request->List_Fees as $list) {
                    FeeInvoice::create([
                        'date'          => date('Y-m-d'),
                        'student_id'    => $list['student_id'],
                        'grade_id'      => $request->grade_id,
                        'classroom_id'  => $request->classroom_id,
                        'fee_id'        => $list['fee_id'],
                        'amount'        => $list['amount'],
                        'description'   => $list['description'],
                    ]);

                    StudentAccount::create([
                        'student_id'    => $list['student_id'],
                        'grade_id'      => $request->grade_id,
                        'classroom_id'  => $request->classroom_id,
                        'debit'         => $list['amount'],
                        'credit'        => 0.00,
                        'description'   => $list['description'],
                    ]);
                }

                DB::commit();

                toastr()->success(__('msgs.added', ['name' => __('fee.student_invoice')]));
                return redirect()->route('fee-invoices.index');
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }
}