<?php

namespace App\Repositories\Repository;

use App\Models\FeeInvoice;
use App\Models\FeeProcessing;
use App\Models\FundAccount;
use App\Models\Student;
use App\Models\StudentAccount;
use App\Models\StudentPayment;
use App\Models\StudentReceipt;
use App\Repositories\Interface\StudentPaymentRepositoryInterface;
use Illuminate\Support\Facades\DB;

class StudentPaymentRepository implements StudentPaymentRepositoryInterface
{
    public function index()
    {
        $studentPayments        = StudentPayment::latest()->get();
        return view('pages.student-payments.index', ['studentPayments' => $studentPayments]);
    }

    public function addStudentPayment($student_id)
    {
        $data['student']                = Student::findOrFail($student_id);
        $data['studentFeeInvoices']     = FeeInvoice::with(['student', 'fee'])->where('student_id', $student_id)->get();
        $data['studentReceipts']        = StudentReceipt::where('student_id', $student_id)->get();
        $data['feeProcessings']         = FeeProcessing::where('student_id', $student_id)->get();
        $data['studentPayments']        = StudentPayment::where('student_id', $student_id)->get();
        return view('pages.student-payments.create', $data);
    }


    public function store($request)
    {
        DB::beginTransaction();
        try {
            if ($request->isMethod('post')) {

                $data = $request->only(['student_id', 'amount', 'description']);

                StudentPayment::create([
                    'student_id'            => $data['student_id'],
                    'amount'                => $data['amount'],
                    'description'           => $data['description'],
                ]);

                FundAccount::create([
                    'studentPayment_id'     => StudentPayment::latest()->first()->id,
                    'credit'                => $data['amount'],

                ]);

                StudentAccount::create([
                    'student_id'            => $data['student_id'],
                    'studentPayment_id'     => StudentPayment::latest()->first()->id,
                    'type'                  => 'payment',
                    'debit'                 => $data['amount'],
                    'description'           => $data['description']
                ]);


                DB::commit();
                toastr()->success(__('msgs.added', ['name' => __('fee.payment')]));
                return redirect()->back();
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }


    public function edit($studentPayment)
    {
        $data['studentPayment']         = $studentPayment;
        $data['student']                = Student::findOrFail($studentPayment->student_id);
        $data['studentFeeInvoices']     = FeeInvoice::with(['student', 'fee'])->where('student_id', $studentPayment->student_id)->get();
        $data['studentReceipts']        = StudentReceipt::where('student_id', $studentPayment->student_id)->get();
        $data['feeProcessings']         = FeeProcessing::where('student_id', $studentPayment->student_id)->get();
        $data['studentPayments']        = StudentPayment::where('student_id', $studentPayment->student_id)->get();
        return view('pages.student-payments.edit',);
    }

    public function update($request, $studentPayment)
    {
        DB::beginTransaction();
        try {
            if ($request->isMethod('put')) {

                $data = $request->only(['amount', 'description']);

                $studentPayment->update([
                    'amount'                => $data['amount'],
                    'description'           => $data['description'],
                ]);

                FundAccount::where('studentPayment_id', $studentPayment->id)->update([
                    'credit'                => $data['amount'],
                ]);

                StudentAccount::where('student_id', $studentPayment->student_id,)->where('studentPayment_id', $studentPayment->id)->update([
                    'debit'                 => $data['amount'],
                    'description'           => $data['description']
                ]);


                DB::commit();
                toastr()->success(__('msgs.updated', ['name' => __('fee.payment')]));
                return redirect()->back();
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }

    public function destroy($studentPayment)
    {
        try {
            $student    = Student::where('id', $studentPayment->student_id)->first();

            if ($student)
                toastr()->error(__('msgs.is_existed', ['name' => $student->name]));
            else {
                $studentPayment->delete();
                toastr()->info(__('msgs.deleted', ['name' => __('fee.payment')]));
            }

            return redirect()->back();
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }
}