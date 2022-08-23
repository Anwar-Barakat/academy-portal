<?php

use App\Http\Controllers\Classroom\ClassroomController;
use App\Http\Controllers\Classroom\EmptyClassroomController;
use App\Http\Controllers\Classroom\FilterClassroomController;
use App\Http\Controllers\Classroom\GetClassroomController;
use App\Http\Controllers\Fee\FeeController;
use App\Http\Controllers\Fee\GetFeeAmountController;
use App\Http\Controllers\FeeInvoice\FeeInvoiceController;
use App\Http\Controllers\FeeProcessing\FeeProcessingController;
use App\Http\Controllers\Grade\GradeController;
use App\Http\Controllers\Section\GetSectionController;
use App\Http\Controllers\Section\SectionController;
use App\Http\Controllers\Student\DeleteAttachmentController;
use App\Http\Controllers\Student\DownloadAttachmentController;
use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\Student\StudentGraduatedController;
use App\Http\Controllers\Student\StudentPromotionController;
use App\Http\Controllers\Student\UploadAttachmentController;
use App\Http\Controllers\StudentAccount\StudentAccountController;
use App\Http\Controllers\StudentPayment\StudentPaymentController;
use App\Http\Controllers\StudentReceipt\StudentReceiptController;
use App\Http\Controllers\Teacher\TeacherController;
use App\Models\FeeInvoice;
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
            Route::resource('grades',                   GradeController::class);


            //! ===================== Classrooms =====================
            Route::resource('classrooms',               ClassroomController::class);
            Route::post('/delete-all-classrooms',       EmptyClassroomController::class)->name('empty-classrooms');
            Route::get('/filter-classrooms',            FilterClassroomController::class)->name('filter-classrooms');
            Route::post('/filter-classrooms',           FilterClassroomController::class)->name('filter-classrooms');
            Route::get('/get-classrooms/{grade_id}',    GetClassroomController::class)->name('get-classrooms');


            //! ===================== Sections =====================
            Route::resource('sections',                 SectionController::class);
            Route::get('/get-sections/{classroom_id}',  GetSectionController::class)->name('get-sections');


            //! ===================== Parents =====================
            Route::view('/add-parents',                 'livewire.show_parent_forms')->name('add-parents');


            //! ===================== Teachers =====================
            Route::resource('teachers',                 TeacherController::class);


            //! ===================== Students =====================
            Route::resource('students',                                 StudentController::class);
            Route::post('upload-attachments',                           UploadAttachmentController::class)->name('student_upload_attachment');
            Route::get('download-attachment/{studname}/{filename}',     DownloadAttachmentController::class)->name('download_student_attachment');
            Route::delete('delete-attachment',                          DeleteAttachmentController::class)->name('delete_student_attachment');
            Route::delete('student-force-delete/{student}',             [StudentController::class, 'forceDelete'])->name('students.force_delete');

            //? =====================
            Route::resource('students-promotions',                      StudentPromotionController::class);

            //? =====================
            Route::resource('students-graduations',                     StudentGraduatedController::class);



            //! ===================== Fees =====================
            Route::resource('fees',                                     FeeController::class);
            Route::get('/get-fee-amount/{id}',                          GetFeeAmountController::class)->name('get-fee-amount');


            //! ===================== Fee Invoices =====================
            Route::resource('fee-invoices',                             FeeInvoiceController::class);
            Route::get('add-student-invoice/{id}',                      [FeeInvoiceController::class, 'addStudentInvoice'])->name('add_student_invoice');


            //! ===================== Student Receipts =====================
            Route::resource('student-receipts',                         StudentReceiptController::class);
            Route::get('add-student-receipt/{id}',                      [StudentReceiptController::class, 'addStudentReceipt'])->name('add_student_receipt');


            //! ===================== Fee Processings =====================
            Route::resource('fee-processings',                          FeeProcessingController::class);
            Route::get('add-fee-exclusion/{id}',                        [FeeProcessingController::class, 'addFeeExclusion'])->name('add_fee_exclusion');


            //! ===================== Student Payments =====================
            Route::resource('student-payments',                         StudentPaymentController::class);
            Route::get('add-student-payment/{id}',                      [StudentPaymentController::class, 'addStudentPayment'])->name('add_student_payment');
        });
    }
);
