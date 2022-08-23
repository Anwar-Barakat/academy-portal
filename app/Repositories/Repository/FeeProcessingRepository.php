<?php

namespace App\Repositories\Repository;

use App\Models\FeeInvoice;
use App\Models\FeeProcessing;
use App\Models\Student;
use App\Models\StudentAccount;
use App\Models\StudentReceipt;
use App\Repositories\Interface\FeeProcessingRepositoryInterface;
use Illuminate\Support\Facades\DB;

class FeeProcessingRepository implements FeeProcessingRepositoryInterface
{
    public function index()
    {
        $feeProcessings     = FeeProcessing::latest()->get();
        return view('pages.fee-processings.index', ['feeProcessings' => $feeProcessings]);
    }

    public function store($request)
    {
        DB::beginTransaction();
        try {

            if ($request->isMethod('post')) {

                $data               = $request->only(['student_id', 'amount', 'student_funds', 'description',]);
                $studentFunds       = StudentAccount::where('student_id', $data['student_id'])->sum('debit') - StudentAccount::where('student_id', $data['student_id'])->sum('credit');
                if ($studentFunds   == $data['student_funds']) {
                    if ($data['amount'] > $studentFunds && $studentFunds != 0) {
                        toastr()->error(__('msgs.amount_warning', ['amount' => $studentFunds]));
                        return redirect()->back();
                    } else {
                        if ($studentFunds <= 0) {
                            toastr()->error(__('msgs.student_funds_is_zero'));
                            return redirect()->back();
                        } else {
                            $feeProcessing      = FeeProcessing::create([
                                'student_id'        => $data['student_id'],
                                'amount'            => $data['amount'],
                                'description'       => $data['description']
                            ]);

                            StudentAccount::create([
                                'type'              => 'exclusion',
                                'student_id'        => $data['student_id'],
                                'feeProcessing_id'  => FeeProcessing::latest()->first()->id,
                                'credit'            => $data['amount'],
                                'description'       => $data['description'],

                            ]);

                            DB::commit();

                            toastr()->success(__('msgs.added', ['name' => __('fee.fee_exclusion')]));
                            return redirect()->back();
                        }
                    }
                } else {
                    return redirect()->back();
                }
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }

    public function edit($feeProcessing)
    {
        $student                = Student::findOrFail($feeProcessing->student_id);
        $studentReceipts        = StudentReceipt::where('student_id', $feeProcessing->student_id)->get();
        $feeProcessings         = FeeProcessing::where('student_id', $feeProcessing->student_id)->get();
        $studentFeeInvoices     = FeeInvoice::with(['student', 'fee'])->where('student_id', $feeProcessing->student_id)->get();
        return view('pages.fee-processings.edit', [
            'feeProcessing'         => $feeProcessing,
            'student'               => $student,
            'studentReceipts'       => $studentReceipts,
            'studentFeeInvoices'    => $studentFeeInvoices,
            'feeProcessings'        => $feeProcessings
        ]);
    }

    public function update($request, $feeProcessing)
    {
        DB::beginTransaction();
        try {
            if ($request->isMethod('put')) {
                $data               = $request->only(['student_id', 'amount', 'student_funds', 'description',]);
                $studentFunds       = StudentAccount::where('student_id', $data['student_id'])->sum('debit') - StudentAccount::where('student_id', $data['student_id'])->sum('credit');
                if ($studentFunds   == $data['student_funds']) {
                    $feeProcessing->update([
                        'amount'            => $data['amount'],
                        'description'       => $data['description']
                    ]);

                    StudentAccount::where('student_id', $data['student_id'])->where('feeProcessing_id', $feeProcessing->id)->update([
                        'credit'            => $data['amount'],
                        'description'       => $data['description'],
                    ]);

                    DB::commit();

                    toastr()->success(__('msgs.updated', ['name' => __('fee.fee_exclusion')]));
                    return redirect()->back();
                } else {
                    return redirect()->back();
                }
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }

    public function destroy($feeProcessing)
    {
        try {
            $feeProcessing->delete();
            toastr()->info(__('msgs.deleted', ['name' => __('fee.fee_exclusion')]));
            return redirect()->back();
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }

    public function addFeeExclusion($student_id)
    {
        $student                = Student::findOrFail($student_id);
        $studentReceipts        = StudentReceipt::where('student_id', $student_id)->get();
        $feeProcessings         = FeeProcessing::where('student_id', $student_id)->get();
        $studentFeeInvoices     = FeeInvoice::with(['student', 'fee'])->where('student_id', $student_id)->get();
        return view('pages.fee-processings.create', [
            'student'               => $student,
            'studentReceipts'       => $studentReceipts,
            'studentFeeInvoices'    => $studentFeeInvoices,
            'feeProcessings'        => $feeProcessings
        ]);
    }
}