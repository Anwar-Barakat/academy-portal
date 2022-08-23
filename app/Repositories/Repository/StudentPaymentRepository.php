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
    }

    public function addStudentPayment($student_id)
    {
        $student                = Student::findOrFail($student_id);
        $studentFeeInvoices     = FeeInvoice::with(['student', 'fee'])->where('student_id', $student_id)->get();
        $studentReceipts        = StudentReceipt::where('student_id', $student_id)->get();
        $feeProcessings         = FeeProcessing::where('student_id', $student_id)->get();
        $studentPayments        = StudentPayment::where('student_id', $student_id)->get();
        return view('pages.student-payments.create', [
            'student'               => $student,
            'studentFeeInvoices'    => $studentFeeInvoices,
            'studentReceipts'       => $studentReceipts,
            'feeProcessings'        => $feeProcessings,
            'studentPayments'       => $studentPayments
        ]);
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
                toastr()->success(__('msgs.updated', ['name' => __('fee.payment')]));
                return redirect()->back();
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }
}