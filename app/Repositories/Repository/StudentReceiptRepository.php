<?php

namespace App\Repositories\Repository;

use App\Models\FeeInvoice;
use App\Models\FundAccount;
use App\Models\Student;
use App\Models\StudentAccount;
use App\Models\StudentReceipt;
use App\Repositories\Interface\StudentReceiptRepositoryInterface;
use Illuminate\Support\Facades\DB;

class StudentReceiptRepository implements StudentReceiptRepositoryInterface
{
    public function index()
    {
        $studentReceipts                = StudentReceipt::latest()->get();
        return view('pages.student-receipts.index', ['studentReceipts' => $studentReceipts]);
    }

    public function addStudentReceipt($student_id)
    {
        $student                = Student::findOrFail($student_id);
        $studentFeeInvoices     = FeeInvoice::where('student_id', $student_id)->get();
        $studentReceipts        = StudentReceipt::where('student_id', $student_id)->get();
        return view('pages.student-receipts.create', compact('student', 'studentFeeInvoices', 'studentReceipts'));
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
                    'studentReceipt_id' =>  StudentReceipt::latest()->first()->id,
                    'student_id'        => $data['student_id'],
                    'debit'             => 0.00,
                    'credit'            => $data['debit'],
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
        $student                = Student::findOrFail($studentReceipt->student_id);
        $studentFeeInvoices     = FeeInvoice::with(['student', 'fee'])->where('student_id', $studentReceipt->student_id)->get();
        $studentReceipts        = StudentReceipt::where('student_id', $studentReceipt->student_id)->get();
        return view('pages.student-receipts.edit', compact('studentReceipt', 'student', 'studentFeeInvoices', 'studentReceipts'));
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
            $student    = Student::where('id', $studentReceipt->student_id)->first();

            if ($student)
                toastr()->error(__('msgs.is_existed', ['name' => $student->name]));
            else {

                $studentReceipt->delete();
                toastr()->info(__('msgs.deleted', ['name' => __('fee.receipt')]));
            }
            return redirect()->back();
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }
}