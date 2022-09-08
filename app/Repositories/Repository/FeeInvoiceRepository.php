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
        $student                = Student::findorfail($student_id);
        $fees                   = Fee::where('classroom_id', $student->classroom_id)->get();
        $studentFeeInvoices     = FeeInvoice::with(['student', 'fee'])->where('student_id', $student_id)->get();
        return view('pages.fee-invoices.create', compact('student', 'fees', 'studentFeeInvoices'));
    }

    public function store($request)
    {
        DB::beginTransaction();
        try {
            if ($request->isMethod('post')) {
                $data = $request->only(['student_id', 'grade_id', 'classroom_id', 'fee_id', 'amount']);

                $FeeFounded = FeeInvoice::where('student_id', $data['student_id'])->where('fee_id', $data['fee_id']);

                if ($FeeFounded->count() > 0) {
                    toastr()->error('msgs.student_has_this_fee');
                    return redirect()->back();
                }

                FeeInvoice::create([
                    'student_id'    => $data['student_id'],
                    'grade_id'      => $request->grade_id,
                    'classroom_id'  => $request->classroom_id,
                    'fee_id'        => $data['fee_id'],
                    'amount'        => $data['amount'],
                ]);

                StudentAccount::create([
                    'type'          => 'invoice',
                    'feeInvoice_id' => FeeInvoice::latest()->first()->id,
                    'student_id'    => $data['student_id'],
                    'debit'         => $data['amount'],
                    'credit'        => 0.00,
                ]);

                DB::commit();

                toastr()->success(__('msgs.added', ['name' => __('fee.student_invoice')]));
                return redirect()->back();
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }

    public function edit($feeInvoice)
    {
        $fees   = Fee::where('classroom_id', $feeInvoice->classroom_id)->get();
        return view('pages.fee-invoices.edit', ['feeInvoice' => $feeInvoice, 'fees' => $fees]);
    }

    public function update($request, $feeInvoice)
    {
        DB::beginTransaction();
        try {
            if ($request->isMethod('put')) {
                $FeeFounded = FeeInvoice::where('student_id', $feeInvoice->student_id)->where('fee_id', $feeInvoice->fee_id);

                if ($FeeFounded->count() > 0) {
                    toastr()->error('msgs.student_has_this_fee');
                    return redirect()->back();
                }

                $feeInvoice->update([
                    'fee_id'        => $request->fee_id,
                    'amount'        => $request->amount,
                ]);

                StudentAccount::where('feeInvoice_id', $request->id)->update([
                    'debit'         => $request->amount,
                    'credit'        => 0.00,
                ]);

                DB::commit();

                toastr()->success(__('msgs.updated', ['name' => __('fee.student_invoice')]));
                return redirect()->route('fee-invoices.index');
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }

    public function destroy($feeInvoice)
    {
        try {
            $feeInvoice->delete();
            toastr()->info(__('msgs.deleted', ['name' => __('fee.student_invoice')]));
            return redirect()->route('fee-invoices.index');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }
}