<?php

namespace App\Http\Controllers\Dashboard;

use App\Charts\StudentInvoicesAndPaymentChart;
use App\Charts\StudentsMonthlyChart;
use App\Http\Controllers\Controller;
use App\Models\FeeInvoice;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $studentChart       = new StudentsMonthlyChart;

        $f_d_current        = Carbon::today()->startOfMonth()->toDateString();
        $l_d_current        = Carbon::today()->endOfMonth()->toDateString();

        $f_d_prev           = Carbon::today()->startOfMonth()->subMonth(1)->toDateString();
        $l_d_prev           = Carbon::today()->endOfMonth()->subMonth(1)->toDateString();

        $f_d_prev2          = Carbon::today()->startOfMonth()->subMonth(2)->toDateString();
        $l_d_prev2          = Carbon::today()->endOfMonth()->subMonth(2)->toDateString();

        $currStudCount      = Student::whereBetween('created_at', [$f_d_current, $l_d_current])->count();
        $prevStudCount      = Student::whereBetween('created_at', [$f_d_prev, $l_d_prev])->count();
        $prev2StudCount     = Student::whereBetween('created_at', [$f_d_prev2, $l_d_prev2])->count();

        $studentChart->labels(['2 Months Ago', 'Previous Month', 'Current Month']);
        $studentChart->dataset('Students Count', 'line', [$prev2StudCount, $prevStudCount, $currStudCount]);

        $studentInvoices    = new StudentsMonthlyChart;

        $currInvoicesSum    = FeeInvoice::whereBetween('created_at', [$f_d_current, $l_d_current])->sum('amount');
        $prevInvoicesSum    = FeeInvoice::whereBetween('created_at', [$f_d_prev, $l_d_prev])->sum('amount');
        $prev2InvoicesSum   = FeeInvoice::whereBetween('created_at', [$f_d_prev2, $l_d_prev2])->sum('amount');

        $studentInvoices->labels(['2 Months Ago', 'Previous Month', 'Current Month']);
        $studentInvoices->dataset('Students Fee Invoices', 'bar', [$prev2InvoicesSum, $prevInvoicesSum, $currInvoicesSum]);

        $stidentInvoices        = new StudentInvoicesAndPaymentChart;



        return view('dashboard', ['studentChart' => $studentChart, 'studentInvoices' => $studentInvoices]);
    }
}