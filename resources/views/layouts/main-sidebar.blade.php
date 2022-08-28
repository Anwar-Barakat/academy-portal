<div class="container-fluid">
    <div class="row">
        <!-- Left Sidebar start-->
        <div class="side-menu-fixed">
            <div class="scrollbar side-menu-bg">
                <ul class="nav navbar-nav side-menu" id="sidebarnav">
                    <!-- menu item Dashboard-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#dashboard">
                            <div class="pull-left">
                                <i class="ti-home"></i>
                                <span class="right-nav-text">{{ __('trans.dashboard') }}</span>
                            </div>
                            <div class="clearfix"></div>
                        </a>
                    </li>
                    <!-- menu title -->
                    <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">{{ __('trans.components') }} </li>

                    <!-- Grades-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#grades">
                            <div class="pull-left"><i class="fa fa-university"></i><span
                                    class="right-nav-text">{{ __('trans.grades') }}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="grades" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{ route('grades.index') }}">{{ __('trans.grades_list') }}</a></li>
                        </ul>
                    </li>

                    <!-- Classrooms-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#classrooms-menu">
                            <div class="pull-left"><i class="fas fa-users-class"></i></i><span
                                    class="right-nav-text">{{ __('trans.classrooms') }}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="classrooms-menu" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{ route('classrooms.index') }}">{{ __('trans.classrooms_list') }} </a> </li>
                        </ul>
                    </li>

                    <!-- Sections-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#sections-menu">
                            <div class="pull-left"><i class="fas fa-th-large" aria-hidden="true"></i><span
                                    class="right-nav-text">{{ __('trans.sections') }}</span>
                            </div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="sections-menu" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{ route('sections.index') }}">{{ __('trans.sections_lost') }} </a> </li>
                        </ul>
                    </li>

                    <!-- Parents-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#parents-menu">
                            <div class="pull-left"><i class="fas fa-user-tie"></i><span
                                    class="right-nav-text">{{ __('trans.parents') }}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="parents-menu" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{ route('add-parents') }}">{{ __('trans.parents_list') }}</a></li>
                        </ul>
                    </li>

                    <!-- Teachers-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#teachers-menu">
                            <div class="pull-left"><i class="fas fa-chalkboard-teacher"></i><span
                                    class="right-nav-text">{{ __('trans.teachers') }}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="teachers-menu" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{ route('teachers.index') }}">{{ __('trans.teachers_list') }}</a></li>
                        </ul>
                    </li>

                    <!-- Students-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#students-menu">
                            <div class="pull-left"><i class="fas fa-user-graduate"></i><span
                                    class="right-nav-text">{{ __('trans.students') }}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="students-menu" class="collapse" data-parent="#sidebarnav">
                            <li>
                                <a href="javascript:void(0);" data-toggle="collapse"
                                    data-target="#student_information">{{ __('student.student_information') }}
                                    <div class="pull-right"><i class="ti-plus"></i></div>
                                    <div class="clearfix"></div>
                                </a>
                                <ul id="student_information" class="collapse">
                                    <li> <a href="{{ route('students.index') }}">{{ __('trans.students_list') }}</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('students.create') }}">{{ __('msgs.add', ['name' => __('student.student')]) }}
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript:void(0);" data-toggle="collapse"
                                    data-target="#students_promotion">{{ __('trans.students_promotion') }}<div
                                        class="pull-right"><i class="ti-plus"></i></div>
                                    <div class="clearfix"></div>
                                </a>
                                <ul id="students_promotion" class="collapse">
                                    <li> <a
                                            href="{{ route('students-promotions.index') }}">{{ __('trans.promotions_list') }}</a>
                                    </li>
                                    <li> <a
                                            href="{{ route('students-promotions.create') }}">{{ __('msgs.add', ['name' => __('student.promotion')]) }}</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0);" data-toggle="collapse"
                                    data-target="#graduation_students">{{ __('trans.graduation_students') }}<div
                                        class="pull-right"><i class="ti-plus"></i></div>
                                    <div class="clearfix"></div>
                                </a>
                                <ul id="graduation_students" class="collapse">
                                    <li> <a
                                            href="{{ route('students-graduations.index') }}">{{ __('trans.graduations_list') }}</a>
                                    </li>
                                    <li> <a
                                            href="{{ route('students-graduations.create') }}">{{ __('msgs.add', ['name' => __('trans.graduation')]) }}</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>

                    <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">{{ __('trans.accounts') }} </li>
                    <!-- Fees -->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#fees-menu">
                            <div class="pull-left"><i class="fas fa-money"></i><span
                                    class="right-nav-text">{{ __('fee.fees') }}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="fees-menu" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{ route('fees.index') }}">{{ __('trans.fees_list') }}</a></li>
                            <li><a
                                    href="{{ route('fees.create') }}">{{ __('msgs.add', ['name' => __('trans.fees')]) }}</a>
                            </li>
                        </ul>
                    </li>

                    <!-- Fees Invoices -->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#fee-invoices-menu">
                            <div class="pull-left"><i class="fas fa-file-invoice-dollar"></i><span
                                    class="right-nav-text">{{ __('fee.fees_invoices') }}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="fee-invoices-menu" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{ route('fee-invoices.index') }}">{{ __('fee.fees_invoices_list') }}</a>
                            </li>

                        </ul>
                    </li>

                    <!-- Student Receipts -->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#student-receipts-menu">
                            <div class="pull-left"><i class="fas fa-money-bill-wave-alt"></i><span
                                    class="right-nav-text">{{ __('fee.receipts') }}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="student-receipts-menu" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{ route('student-receipts.index') }}">{{ __('fee.receipts_list') }}</a>
                            </li>
                        </ul>
                    </li>

                    <!-- Fee exclusion -->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#fee-exclusion-menu">
                            <div class="pull-left"><i class="fas fa-money-check-alt"></i><span
                                    class="right-nav-text">{{ __('fee.fee_exclusion') }}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="fee-exclusion-menu" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{ route('fee-processings.index') }}">{{ __('fee.fee_exclusion_list') }}</a>
                            </li>
                        </ul>
                    </li>

                    <!-- Student Payments -->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#student-payments-menu">
                            <div class="pull-left"><i class="fas fa-donate"></i><span
                                    class="right-nav-text">{{ __('fee.payments') }}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="student-payments-menu" class="collapse" data-parent="#sidebarnav">
                            <li>
                                <a href="{{ route('student-payments.index') }}">{{ __('fee.payments_list') }}</a>
                            </li>

                        </ul>
                    </li>

                    <!-- Attendances -->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#attendances-menu">
                            <div class="pull-left"><i class="fas fa-calendar-alt"></i><span
                                    class="right-nav-text">{{ __('trans.attendances') }}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="attendances-menu" class="collapse" data-parent="#sidebarnav">
                            <li>
                                <a href="{{ route('attendances.index') }}">{{ __('trans.attendances_list') }}</a>
                            </li>

                        </ul>
                    </li>

                    <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">{{ __('trans.equipments') }} </li>

                    <!-- Subjects -->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#subjects-menu">
                            <div class="pull-left"><i class="fas fa-folder-open"></i><span
                                    class="right-nav-text">{{ __('trans.subjects') }}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="subjects-menu" class="collapse" data-parent="#sidebarnav">
                            <li>
                                <a href="{{ route('subjects.index') }}">{{ __('trans.subjects_list') }}</a>
                            </li>
                            <li>
                                <a href="{{ route('subjects.create') }}">
                                    {{ __('msgs.add', ['name' => __('trans.subject')]) }}
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Quizzes -->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#quizzes-menu">
                            <div class="pull-left"><i class="fas fa-book-open"></i><span
                                    class="right-nav-text">{{ __('trans.quizzes') }}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="quizzes-menu" class="collapse" data-parent="#sidebarnav">
                            <li>
                                <a href="{{ route('quizzes.index') }}">{{ __('trans.quizzes_list') }}</a>
                            </li>
                            <li>
                                <a href="{{ route('quizzes.create') }}">
                                    {{ __('msgs.add', ['name' => __('trans.quiz')]) }}
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Questions -->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#questions-menu">
                            <div class="pull-left"><i class="fas fa-question"></i><span
                                    class="right-nav-text">{{ __('trans.questions') }}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="questions-menu" class="collapse" data-parent="#sidebarnav">
                            <li>
                                <a href="{{ route('questions.index') }}">{{ __('trans.questions_list') }}</a>
                            </li>
                            <li>
                                <a href="{{ route('questions.create') }}">
                                    {{ __('msgs.add', ['name' => __('trans.quiz')]) }}
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Zoom -->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#zooms-menu">
                            <div class="pull-left"><i class="fas fa-video-camera"></i><span
                                    class="right-nav-text">{{ __('trans.online_classes') }}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="zooms-menu" class="collapse" data-parent="#sidebarnav">
                            <li>
                                <a href="{{ route('online-classes.index') }}">
                                    {{ __('trans.list', ['name' => __('trans.online_classes')]) }}
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Libarary -->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#library-menu">
                            <div class="pull-left"><i class="fas fa-books"></i><span
                                    class="right-nav-text">{{ __('trans.library') }}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="library-menu" class="collapse" data-parent="#sidebarnav">
                            <li>
                                <a href="{{ route('libraries.index') }}">
                                    {{ __('trans.list', ['name' => __('trans.books')]) }}
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Left Sidebar End-->

        <!--=================================
