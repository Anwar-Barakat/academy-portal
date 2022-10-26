<?php

namespace App\Http\Controllers\Dashboard;

use App\Charts\StudentsMonthlyChart;
use App\Http\Controllers\Controller;
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
        $start = Carbon::now()->startOfMonth();

        $chart = new StudentsMonthlyChart;


        $f_d_current_month      = Carbon::today()->startOfMonth()->toDateString();
        $l_d_current_month      = Carbon::today()->endOfMonth()->toDateString();

        $f_d_prev_month         = Carbon::today()->startOfMonth()->subMonth(1)->toDateString();
        $l_d_prev_month         = Carbon::today()->endOfMonth()->subMonth(1)->toDateString();

        $f_d_prev2_month        = Carbon::today()->startOfMonth()->subMonth(2)->toDateString();
        $l_d_prev2_month        = Carbon::today()->endOfMonth()->subMonth(2)->toDateString();

        $curMonthstudents       = Student::whereBetween('created_at', [$f_d_current_month, $l_d_current_month])->count();
        $prevMonthstudents      = Student::whereBetween('created_at', [$f_d_prev_month, $l_d_prev_month])->count();
        $prev2Monthstudents     = Student::whereBetween('created_at', [$f_d_prev2_month, $l_d_prev2_month])->count();

        $chart->labels(['2 Months Ago', 'Previous Month', 'Current Month']);
        $chart->dataset('My dataset', 'line', [$prev2Monthstudents, $prevMonthstudents, $curMonthstudents]);

        return view('dashboard', ['chart' => $chart]);
    }
}