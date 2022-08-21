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
                    $FeeFounded = FeeInvoice::where('student_id', $list['student_id'])->where('fee_id', $list['fee_id']);

                    if ($FeeFounded->count() > 0) {
                        toastr()->error('msgs.student_has_this_fee');
                        return redirect()->back();
                    }

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
                        'feeInvoice_id' => FeeInvoice::latest()->first()->id,
                        'student_id'    => $list['student_id'],
                        'student_id'    => $list['student_id'],
                        'grade_id'      => $request->grade_id,
                        'classroom_id'  => $request->classroom_id,
                        'type'          => 'invoice',
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
                $feeInvoice->update([
                    'fee_id'        => $request->fee_id,
                    'amount'        => $request->amount,
                    'description'   => $request->description,
                ]);

                StudentAccount::where('feeInvoice_id', $request->id)->update([
                    'debit'         => $request->amount,
                    'credit'        => 0.00,
                    'description'   => $request->description,
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