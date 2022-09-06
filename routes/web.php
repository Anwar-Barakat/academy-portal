<?php

use App\Http\Controllers\Attendance\AttendanceController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\ShowLoginController;
use App\Http\Controllers\Classroom\ClassroomController;
use App\Http\Controllers\Classroom\EmptyClassroomController;
use App\Http\Controllers\Classroom\GetClassroomController;
use App\Http\Controllers\Dashboard\AdminDashboardController;
use App\Http\Controllers\Dashboard\ParentDashboardController;
use App\Http\Controllers\Dashboard\StudentDashboardController;
use App\Http\Controllers\Dashboard\TeacherDashboardController;
use App\Http\Controllers\Fee\FeeController;
use App\Http\Controllers\Fee\GetFeeAmountController;
use App\Http\Controllers\FeeInvoice\FeeInvoiceController;
use App\Http\Controllers\FeeProcessing\FeeProcessingController;
use App\Http\Controllers\Grade\GradeController;
use App\Http\Controllers\HomeControlller;
use App\Http\Controllers\Library\DownloadBookController;
use App\Http\Controllers\Library\LibraryController;
use App\Http\Controllers\OnlineClass\IndirectClassController;
use App\Http\Controllers\OnlineClass\OnlineClassController;
use App\Http\Controllers\Parent\Account\FeeController as AccountFeeController;
use App\Http\Controllers\Parent\Account\ReceiptController;
use App\Http\Controllers\Parent\AttendanceController as ParentAttendanceController;
use App\Http\Controllers\Parent\ChildrenController;
use App\Http\Controllers\Parent\ChildResultController;
use App\Http\Controllers\Parent\ProfileController as ParentProfileController;
use App\Http\Controllers\Question\QuestionController;
use App\Http\Controllers\Quiz\QuizController;
use App\Http\Controllers\Section\GetSectionController;
use App\Http\Controllers\Section\SectionController;
use App\Http\Controllers\Setting\SettingController;
use App\Http\Controllers\Student\DeleteAttachmentController;
use App\Http\Controllers\Student\DownloadAttachmentController;
use App\Http\Controllers\Student\ProfileController as StudentProfileController;
use App\Http\Controllers\Student\Quiz\QuizController as StudentQuizController;
use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\Student\StudentGraduatedController;
use App\Http\Controllers\Student\StudentPromotionController;
use App\Http\Controllers\Student\UploadAttachmentController;
use App\Http\Controllers\StudentPayment\StudentPaymentController;
use App\Http\Controllers\StudentReceipt\StudentReceiptController;
use App\Http\Controllers\Subject\GetSubjectController;
use App\Http\Controllers\Subject\SubjectController;
use App\Http\Controllers\Teacher\AttendanceController as TeacherAttendanceController;
use App\Http\Controllers\Teacher\AttendanceReportController;
use App\Http\Controllers\Teacher\GetTeacherController;
use App\Http\Controllers\Teacher\IndirectClassController as TeacherIndirectClassController;
use App\Http\Controllers\Teacher\OnlineClassController as TeacherOnlineClassController;
use App\Http\Controllers\Teacher\ProfileController;
use App\Http\Controllers\Teacher\QuestionController as TeacherQuestionController;
use App\Http\Controllers\Teacher\Quiz\StudentWasExamedController;
use App\Http\Controllers\Teacher\SectionController as TeacherSectionController;
use App\Http\Controllers\Teacher\StudentController as TeacherStudentController;
use App\Http\Controllers\Teacher\TeacherController;
use App\Http\Controllers\Teacher\TeacherQuizController;
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
        'prefix'            => LaravelLocalization::setLocale(),
        'middleware'        => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {
        require __DIR__ . '/auth.php';
        Route::get('/',                                                 [HomeControlller::class, 'index'])->name('home');
        Route::get('/login/{type}',                                     ShowLoginController::class)->name('login.show');
        Route::post('/login',                                           LoginController::class)->name('login.show');
        Route::get('/logout/{type}',                                    LogoutController::class)->name('all.logout');


        Route::middleware(['auth:teacher,isTeacher'])->prefix('teacher')->name('teacher.')->group(function () {
            Route::get('/dashboard',                                    TeacherDashboardController::class)->name('dashboard');
            Route::resource('students',                                 TeacherStudentController::class)->only(['index']);
            Route::get('sections',                                      TeacherSectionController::class)->name('sections.index');
            Route::resource('students-attendance',                      TeacherAttendanceController::class)->only(['index', 'store']);
            Route::resource('attendances-report',                       AttendanceReportController::class)->only(['index', 'store']);
            Route::resource('quizzes',                                  TeacherQuizController::class);
            Route::get('students-was-examed/{quiz_id}',                 StudentWasExamedController::class)->name('students_was_examed');
            Route::resource('questions',                                TeacherQuestionController::class);
            Route::resource('online-classess',                          TeacherOnlineClassController::class);
            Route::resource('indirect-classess',                        TeacherIndirectClassController::class);
            Route::resource('profile',                                  ProfileController::class)->only(['index', 'update']);
        });


        Route::middleware(['auth:parent,isParent'])->prefix('parent/')->name('parent.')->group(function () {
            Route::get('dashboard',                                     ParentDashboardController::class)->name('dashboard');
            Route::resource('children',                                 ChildrenController::class);
            Route::get('child-result/{id}',                             ChildResultController::class)->name('child_result');
            Route::resource('attendances-report',                       ParentAttendanceController::class);
            Route::get('children-fees',                                 AccountFeeController::class)->name('children_fees');
            Route::get('children-fees-receipt/{id}',                    ReceiptController::class)->name('children_fees_receipt');
            Route::resource('profile',                                  ParentProfileController::class)->only(['index', 'update']);
        });


        Route::middleware(['auth:student,isStudent'])->prefix('student/')->name('student.')->group(function () {
            Route::get('dashboard',                                     StudentDashboardController::class)->name('dashboard');
            Route::resource('quizzes',                                  StudentQuizController::class);
            Route::resource('profile',                                  StudentProfileController::class)->only(['index', 'update']);
        });


        Route::middleware(['auth:web,teacher'])->group(function () {
            Route::get('/get-classrooms/{grade_id}',                    GetClassroomController::class)->name('get-classrooms');
            Route::get('/get-sections/{classroom_id}',                  GetSectionController::class)->name('get-sections');
        });


        Route::middleware(['auth:web,isAdmin'])->prefix('admin/')->group(function () {
            Route::get('/dashboard',                                    AdminDashboardController::class)->name('admin.dashboard');

            //! ===================== Grades =====================
            Route::resource('grades',                                   GradeController::class);

            //! ===================== Classrooms =====================
            Route::resource('classrooms',                               ClassroomController::class);
            Route::delete('delete-checked-classrooms',                  EmptyClassroomController::class);
        });














        //! ===================== Sections =====================
        Route::resource('sections',                                 SectionController::class);


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
        Route::resource('settings',                                 SettingController::class)->only(['index', 'update']);
    }
);