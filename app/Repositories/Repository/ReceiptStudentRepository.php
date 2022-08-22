<?php

namespace App\Repositories\Repository;

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
                    'description'       => $data['description'],
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

    public function edit()
    {
    }

    public function update()
    {
    }

    public function addStudentReceipt($student_id)
    {
        $student    = Student::findOrFail($student_id);
        return view('pages.student-receipts.create', ['student' => $student]);
    }
}