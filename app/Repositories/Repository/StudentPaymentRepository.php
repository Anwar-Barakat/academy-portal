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

    }
}