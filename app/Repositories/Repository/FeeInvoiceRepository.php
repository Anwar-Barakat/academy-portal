<?php

namespace App\Repositories\Repository;

use App\Models\Fee;
use App\Models\Student;
use App\Repositories\Interface\FeeInvoiceRepositoryInterface;

class FeeInvoiceRepository implements FeeInvoiceRepositoryInterface
{
    public function create($student_id)
    {
        $student    = Student::findorfail($student_id);
        $fees       = Fee::where('classroom_id', $student->classroom_id)->get();
        return view('pages.fee-invoices.create', [
            'student'   => $student,
            'fees'      => $fees
        ]);
    }
}