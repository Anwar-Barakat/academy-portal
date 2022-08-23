<?php

namespace App\Repositories\Repository;

use App\Models\FeeInvoice;
use App\Models\FundAccount;
use App\Models\Student;
use App\Models\StudentAccount;
use App\Models\StudentReceipt;
use App\Repositories\Interface\ReceiptStudentRepositoryInterface;
use Illuminate\Support\Facades\DB;

class ReceiptStudentRepository implements ReceiptStudentRepositoryInterface
{
    public function index()
    {
        $studentReceipts                = StudentReceipt::latest()->get();
        return view('pages.student-receipts.index', ['studentReceipts' => $studentReceipts]);
    }

    public function store($request)
    {
        DB::beginTransaction();
        try {
            if ($request->isMethod('post')) {
                $data = $request->only(['student_id', 'debit', 'description']);
                $studentReceipt = StudentReceipt::create([
                    'student_id'        => $data['student_id'],
                    'debit'             => $data['debit'],
                    'description'       => $data['description'],
                ]);

                FundAccount::create([
                    'studentReceipt_id' => $studentReceipt->id,
                    'debit'             => $data['debit'],
                    'credit'            => 0.00,
                ]);

                StudentAccount::create([
                    'type'              => 'receipt',
                    'studentReceipt_id' => $studentReceipt->id,
                    'student_id'        => $data['student_id'],
                    'debit'             => 0,
                    'credit'            => $data['debit'],
                    'description'       => $data['description'],
                ]);

                DB::commit();
                toastr()->success(__('msgs.added', ['name' => __('fee.receipt')]));
                return redirect()->back();
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }
    public function edit($studentReceipt)
    {
        return view('pages.student-receipts.edit', ['studentReceipt' => $studentReceipt]);
    }

    public function update($request, $studentReceipt)
    {
        DB::beginTransaction();
        try {
            if ($request->isMethod('put')) {
                $data   = $request->only(['student_id', 'debit', 'description']);

                $studentReceipt->update([
                    'debit'         => $data['debit'],
                    'description'   => $data['description'],
                ]);

                FundAccount::where('studentReceipt_id', $studentReceipt->id)->update([
                    'debit'         => $data['debit'],
                ]);

                StudentAccount::where('student_id', $data['student_id'])->where('studentReceipt_id', $studentReceipt->id)->update([
                    'credit'        => $data['debit'],
                ]);

                DB::commit();
                toastr()->success(__('msgs.updated', ['name' => __('fee.receipt')]));
                return redirect()->back();
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }

    public function destroy($studentReceipt)
    {
        try {
            $studentReceipt->delete();
            toastr()->info(__('msgs.deleted', ['name' => __('fee.receipt')]));
            return redirect()->back();
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }

    public function addStudentReceipt($student_id)
    {
        $student                = Student::findOrFail($student_id);
        $studentReceipts        = StudentReceipt::where('student_id', $student_id)->get();
        $studentFeeInvoices     = FeeInvoice::with(['student', 'fee'])->where('student_id', $student_id)->get();
        return view('pages.student-receipts.create', [
            'student'               => $student,
            'studentReceipts'       => $studentReceipts,
            'studentFeeInvoices'    => $studentFeeInvoices
        ]);
    }
}