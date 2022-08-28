<?php

use App\Http\Controllers\Attendance\AttendanceController;
use App\Http\Controllers\Classroom\ClassroomController;
use App\Http\Controllers\Classroom\EmptyClassroomController;
use App\Http\Controllers\Classroom\FilterClassroomController;
use App\Http\Controllers\Classroom\GetClassroomController;
use App\Http\Controllers\Fee\FeeController;
use App\Http\Controllers\Fee\GetFeeAmountController;
use App\Http\Controllers\FeeInvoice\FeeInvoiceController;
use App\Http\Controllers\FeeProcessing\FeeProcessingController;
use App\Http\Controllers\Grade\GradeController;
use App\Http\Controllers\Library\DownloadBookController;
use App\Http\Controllers\Library\LibraryController;
use App\Http\Controllers\OnlineClass\IndirectClassController;
use App\Http\Controllers\OnlineClass\OnlineClassController;
use App\Http\Controllers\Question\QuestionController;
use App\Http\Controllers\Quiz\QuizController;
use App\Http\Controllers\Section\GetSectionController;
use App\Http\Controllers\Section\SectionController;
use App\Http\Controllers\Setting\SettingController;
use App\Http\Controllers\Student\DeleteAttachmentController;
use App\Http\Controllers\Student\DownloadAttachmentController;
use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\Student\StudentGraduatedController;
use App\Http\Controllers\Student\StudentPromotionController;
use App\Http\Controllers\Student\UploadAttachmentController;
use App\Http\Controllers\StudentPayment\StudentPaymentController;
use App\Http\Controllers\StudentReceipt\StudentReceiptController;
use App\Http\Controllers\Subject\GetSubjectController;
use App\Http\Controllers\Subject\SubjectController;
use App\Http\Controllers\Teacher\GetTeacherController;
use App\Http\Controllers\Teacher\TeacherController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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
            return view('auth.login');
        });

        require __DIR__ . '/auth.php';

        Route::group(['middleware' => 'auth'], function () {

            Route::get('/dashboard', function () {
                return view('dashboard');
            })->name('dashboard');

            //! ===================== Grades =====================
            Route::resource('grades',                                   GradeController::class);


            //! ===================== Classrooms =====================
            Route::resource('classrooms',                               ClassroomController::class);
            Route::post('/delete-all-classrooms',                       EmptyClassroomController::class)->name('empty-classrooms');
            Route::get('/filter-classrooms',                            FilterClassroomController::class)->name('filter-classrooms');
            Route::post('/filter-classrooms',                           FilterClassroomController::class)->name('filter-classrooms');
            Route::get('/get-classrooms/{grade_id}',                    GetClassroomController::class)->name('get-classrooms');


            //! ===================== Sections =====================
            Route::resource('sections',                                 SectionController::class);
            Route::get('/get-sections/{classroom_id}',                  GetSectionController::class)->name('get-sections');


            //! ===================== Parents =====================
            Route::view('/add-parents',                                 'livewire.show_parent_forms')->name('add-parents');


            //! ===================== Teachers =====================
            Route::resource('teachers',                                             TeacherController::class);
            Route::get('/get-teachers/{grade_id}/{classroom_id}/{subject_id}',      GetTeacherController::class)->name('get-teachers');



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


            //! ===================== Attendances =====================
            Route::resource('attendances',                              AttendanceController::class);
            Route::get('add-attendances/{id}',                          [AttendanceController::class, 'addAttendance'])->name('add_attendances');


            //! ===================== Subjects =====================
            Route::resource('subjects',                                 SubjectController::class);
            Route::get('/get-subjects/{grade_id}/{classroom_id}',       GetSubjectController::class)->name('get-subjects');


            //! ===================== Quizzes =====================
            Route::resource('quizzes',                                  QuizController::class);


            //! ===================== Questions =====================
            Route::resource('questions',                                QuestionController::class);


            //! ===================== Online Classes =====================
            Route::resource('online-classes',                           OnlineClassController::class);
            Route::resource('indirect-classes',                         IndirectClassController::class)->only(['create', 'store']);


            //! ===================== Library =====================
            Route::resource('library',                                  LibraryController::class);
            Route::get('download-book-attachment/{file_name}',          DownloadBookController::class)->name('download_book_attachment');


            //! ===================== Settings =====================
            Route::resource('settings',                                 SettingController::class);
        });
    }
);