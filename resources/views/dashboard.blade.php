@extends('layouts.master')

@section('livewire-css')
    @livewireStyles
@endsection

@section('title')
    {{ __('trans.dashboard') }}
@endsection

@section('breadcrum')
    {{ __('trans.welcome_back') }} : {{ auth()->guard('web')->user()->name }}
@endsection

@section('breadcrum_home')
    {{ __('trans.dashboard') }}
@endsection

@section('content')
    <!-- widgets -->
    <div class="row">
        <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-left">
                            <span class="text-success">
                                <i class="fas fa-user-graduate highlight-icon" aria-hidden="true"></i>
                            </span>
                        </div>
                        <div class="float-right text-right">
                            <p class="card-text text-dark">{{ __('student.students') }}</p>
                            <h4>{{ App\Models\Student::count() }}</h4>
                        </div>
                    </div>
                    <p class="text-muted pt-3 mb-0 mt-2 border-top">
                        <a href="{{ route('students.index') }}" target="_blank">
                            <i class="fa fa-exclamation-circle mr-1" aria-hidden="true"></i>
                            {{ __('trans.show_data') }}
                        </a>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-left">
                            <span class="text-info">
                                <i class="fas fa-chalkboard-teacher highlight-icon" aria-hidden="true"></i>
                            </span>
                        </div>
                        <div class="float-right text-right">
                            <p class="card-text text-dark">{{ __('trans.teachers') }}</p>
                            <h4>{{ App\Models\Teacher::count() }}</h4>
                        </div>
                    </div>
                    <p class="text-muted pt-3 mb-0 mt-2 border-top">
                        <a href="{{ route('teachers.index') }}" target="_blank">
                            <i class="fa fa-exclamation-circle mr-1" aria-hidden="true"></i>
                            {{ __('trans.show_data') }}
                        </a>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-left">
                            <span class="text-gray-200">
                                <i class="fas fa-user-tie highlight-icon" aria-hidden="true"></i>
                            </span>
                        </div>
                        <div class="float-right text-right">
                            <p class="card-text text-dark">{{ __('trans.parents') }}</p>
                            <h4>{{ App\Models\MyParent::count() }}</h4>
                        </div>
                    </div>
                    <p class="text-muted pt-3 mb-0 mt-2 border-top">
                        <a href="{{ route('add-parents') }}" target="_blank">
                            <i class="fa fa-exclamation-circle mr-1" aria-hidden="true"></i>
                            {{ __('trans.show_data') }}
                        </a>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-left">
                            <span class="text-warning">
                                <i class="fas fa-users-class highlight-icon" aria-hidden="true"></i>
                            </span>
                        </div>
                        <div class="float-right text-right">
                            <p class="card-text text-dark">{{ __('trans.classrooms') }}</p>
                            <h4>{{ App\Models\Classroom::count() }}</h4>
                        </div>
                    </div>
                    <p class="text-muted pt-3 mb-0 mt-2 border-top">
                        <a href="{{ route('classrooms.index') }}" target="_blank">
                            <i class="fa fa-exclamation-circle mr-1" aria-hidden="true"></i>
                            {{ __('trans.show_data') }}
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div style="height: 400px;" class="col-xl-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="tab nav-border" style="position: relative;">
                        <div class="d-block d-md-flex justify-content-between">
                            <div class="d-block w-100">
                                <h5 style="font-family: 'Cairo', sans-serif" class="card-title">
                                    {{ __('msgs.last_operations') }}</h5>
                            </div>
                            <div class="d-block d-md-flex nav-tabs-custom">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">

                                    <li class="nav-item">
                                        <a class="nav-link active show " id="students-tab" data-toggle="tab"
                                            href="#students" role="tab" aria-controls="students" aria-selected="true">
                                            {{ __('student.students') }}</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" id="teachers-tab" data-toggle="tab" href="#teachers"
                                            role="tab" aria-controls="teachers"
                                            aria-selected="false">{{ __('teacher.teachers') }}
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" id="parents-tab" data-toggle="tab" href="#parents"
                                            role="tab" aria-controls="parents"
                                            aria-selected="false">{{ __('parent.parents') }}
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" id="fee_invoices-tab" data-toggle="tab" href="#fee_invoices"
                                            role="tab" aria-controls="fee_invoices"
                                            aria-selected="false">{{ __('fee.fees_invoices') }}
                                        </a>
                                    </li>

                                </ul>
                            </div>
                        </div>
                        <div class="tab-content" id="myTabContent">

                            {{-- students Table --}}
                            <div class="tab-pane fade active show" id="students" role="tabpanel"
                                aria-labelledby="students-tab">
                                <div class="table-responsive mt-15">
                                    <table class="table center-aligned-table text-center mb-0 table-hover table-sm">
                                        <thead>
                                            <tr class="table-success">
                                                <th>#</th>
                                                <th>{{ __('student.name') }}</th>
                                                <th>{{ __('trans.email') }}</th>
                                                <th>{{ __('trans.gender') }}</th>
                                                <th>{{ __('grade.grade') }}</th>
                                                <th>{{ __('classroom.classroom') }}</th>
                                                <th>{{ __('section.name') }}</th>
                                                <th>{{ __('trans.created_at') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse(\App\Models\Student::latest()->take(5)->get() as $student)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $student->name }}</td>
                                                    <td>{{ $student->email }}</td>
                                                    <td>{{ $student->gender }}</td>
                                                    <td>{{ $student->grade->name }}</td>
                                                    <td>{{ $student->classroom->name }}</td>
                                                    <td>{{ $student->section->name }}</td>
                                                    <td class="text-success">{{ $student->created_at }}</td>
                                                @empty
                                                    <td colspan="8">
                                                        {{ __('msgs.not_found_yet') }}</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            {{-- teachers Table --}}
                            <div class="tab-pane fade" id="teachers" role="tabpanel" aria-labelledby="teachers-tab">
                                <div class="table-responsive mt-15">
                                    <table class="table center-aligned-table text-center mb-0 table-hover table-sm">
                                        <thead>
                                            <tr class="table-info">
                                                <th>#</th>
                                                <th>{{ __('teacher.name') }}</th>
                                                <th>{{ __('trans.gender') }}</th>
                                                <th>{{ __('teacher.joining_data') }}</th>
                                                <th>{{ __('teacher.specialization') }}</th>
                                                <th>{{ __('trans.created_at') }}</th>
                                            </tr>
                                        </thead>

                                        @forelse(\App\Models\Teacher::latest()->take(5)->get() as $teacher)
                                            <tbody>
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $teacher->name }}</td>
                                                    <td>{{ $teacher->gender }}</td>
                                                    <td>{{ $teacher->joining }}</td>
                                                    <td>{{ $teacher->specialization->name }}</td>
                                                    <td class="text-success">{{ $teacher->created_at }}</td>
                                                @empty
                                                    <td colspan="8">
                                                        {{ __('msgs.not_found_yet') }}</td>
                                                </tr>
                                            </tbody>
                                        @endforelse
                                    </table>
                                </div>
                            </div>

                            {{-- parents Table --}}
                            <div class="tab-pane fade" id="parents" role="tabpanel" aria-labelledby="parents-tab">
                                <div class="table-responsive mt-15">
                                    <table class="table center-aligned-table text-center mb-0 table-hover table-sm">
                                        <thead>
                                            <tr class="table-dark">
                                                <th>#</th>
                                                <th>{{ __('parent.father_name') }}</th>
                                                <th>{{ __('trans.email') }}</th>
                                                <th>{{ __('parent.father_identification') }}</th>
                                                <th>{{ __('parent.father_phone') }}</th>
                                                <th>{{ __('trans.created_at') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse(\App\Models\MyParent::latest()->take(5)->get() as $parent)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $parent->father_name }}</td>
                                                    <td>{{ $parent->email }}</td>
                                                    <td>{{ $parent->father_identification }}</td>
                                                    <td>{{ $parent->father_phone }}</td>
                                                    <td class="text-success">{{ $parent->created_at }}</td>
                                                @empty
                                                    <td colspan="8">
                                                        {{ __('msgs.not_found_yet') }}</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            {{-- sections Table --}}
                            <div class="tab-pane fade" id="fee_invoices" role="tabpanel"
                                aria-labelledby="fee_invoices-tab">
                                <div class="table-responsive mt-15">
                                    <table class="table center-aligned-table text-center mb-0 table-hover table-sm">
                                        <thead>
                                            <tr class="table-info">
                                                <th>#</th>
                                                <th>{{ __('student.name') }}</th>
                                                <th>{{ __('grade.grade') }}</th>
                                                <th>{{ __('classroom.classroom') }}</th>
                                                <th>{{ __('fee.fees_type') }}</th>
                                                <th>{{ __('fee.amount') }}</th>
                                                <th>{{ __('trans.created_at') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse(\App\Models\FeeInvoice::latest()->take(10)->get() as $feeInvoice)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $feeInvoice->grade->name }}</td>
                                                    <td>{{ $feeInvoice->student->name }}</td>
                                                    <td>{{ $feeInvoice->classroom->name }}</td>
                                                    <td>{{ $feeInvoice->fee->type }}</td>
                                                    <td>{{ $feeInvoice->amount }}</td>
                                                    <td>{{ $feeInvoice->created_at }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="7">لاتوجد بيانات</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <livewire:calendar />
    <!--wrapper -->
@endsection

@section('liwewire-js')
    @livewireScripts
@endsection
