<?php

use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\EmptyClassroomController;
use App\Http\Controllers\GradeController;
use App\Models\Classroom;
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
            Route::resource('grades',       GradeController::class);

            //! ===================== Classrooms =====================
            Route::resource('classrooms', ClassroomController::class);

            Route::post('/delete-all-classrooms', EmptyClassroomController::class)->name('empty-classrooms');
        });
    }
);