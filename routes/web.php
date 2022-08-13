<?php

use App\Http\Controllers\Classroom\ClassroomController;
use App\Http\Controllers\Classroom\EmptyClassroomController;
use App\Http\Controllers\Classroom\FilterClassroomController;
use App\Http\Controllers\Grade\GradeController;
use App\Http\Controllers\MyParentController;
use App\Http\Controllers\Section\GetClassroomController;
use App\Http\Controllers\Section\SectionController;
use App\Http\Livewire\AddParent;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use PhpParser\Builder\Class_;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {

        Route::get('/', function () {
            return view('welcome');
        });

        require __DIR__ . '/auth.php';

        Route::group(['middleware' => 'auth'], function () {

            Route::get('/dashboard', function () {
                return view('dashboard');
            })->name('dashboard');

            //! ===================== Grades =====================
            Route::resource('grades',               GradeController::class);


            //! ===================== Classrooms =====================
            Route::resource('classrooms',           ClassroomController::class);

            Route::post('/delete-all-classrooms',   EmptyClassroomController::class)->name('empty-classrooms');

            Route::get('/filter-classrooms',        FilterClassroomController::class)->name('filter-classrooms');
            Route::post('/filter-classrooms',       FilterClassroomController::class)->name('filter-classrooms');


            //! ===================== Sections =====================
            Route::resource('sections',             SectionController::class);

            Route::get('/get-classrooms/{grade_id}', GetClassroomController::class)->name('get-classrooms');


            //! ===================== Parents =====================
            Route::get('/add-parents', AddParent::class)->name('add-parents');
        });
    }
);