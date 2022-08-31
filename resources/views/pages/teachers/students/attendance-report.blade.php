@extends('layouts.master')

@section('title')
    {{ __('trans.attedances_report') }}
@stop

@section('breadcrum')
    {{ __('trans.attachments') }}@endsection

@section('breadcrum_home')
    {{ __('trans.attedances_report') }}
@endsection

@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-xl-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger">{{ $error }}</div>
                        @endforeach
                    @endif

                    <h5 class="mb-4 text-info">
                        {{ __('trans.today_data') }} :
                        {{ date('Y-m-d') }}
                    </h5>


                    <form method="post" action="{{ route('teacher.attendances-report.store') }}" autocomplete="off">
                        @csrf
                        <h5 class="text-info mb-4">{{ __('teacher.search_information') }}</h5>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="student">{{ __('student.students') }}</label>
                                    <select class="custom-select mr-sm-2" name="student_id" required>
                                        <option value="" disabled selected>{{ __('msgs.select', ['name' => '...']) }}
                                        </option>
                                        <option value="all">{{ __('teacher.all') }}</option>
                                        @foreach ($students as $student)
                                            <option value="{{ $student->id }}">{{ $student->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="card-body datepicker-form">
                                <div class="input-group" data-date-format="yyyy-mm-dd">
                                    <input type="text" class="form-control range-from date-picker-default"
                                        placeholder="{{ __('teacher.start_date') }}" required name="from">
                                    <span class="input-group-addon">{{ __('teacher.to') }}</span>
                                    <input class="form-control range-to date-picker-default"
                                        placeholder="{{ __('teacher.end_date') }}" type="text" required name="to">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <button class="button button-border x-small mb-3" type="submit">
                            {{ __('buttons.search') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->

    @if (isset($searchedStudents))
        <!-- row -->
        <div class="row">
            <div class="col-xl-12 mb-30">
                <div class="card card-statistics h-100">
                    <div class="card-body">
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <div class="alert alert-danger">{{ $error }}</div>
                            @endforeach
                        @endif

                        <h5 class="mb-4 text-info">
                            {{ __('teacher.results') }}
                        </h5>

                        <div class="table-responsive">
                            <table id="datatable"
                                class="table table-striped table-bordered text-center p-0 table-hover table-sm">
                                <thead>
                                    <tr>
                                        <th class="alert-success">#</th>
                                        <th class="alert-success">{{ trans('student.name') }}</th>
                                        <th class="alert-success">{{ trans('grade.grade') }}</th>
                                        <th class="alert-success">{{ trans('section.name') }}</th>
                                        <th class="alert-success">{{ __('teacher.date') }}</th>
                                        <th class="alert-warning">{{ __('section.status') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($searchedStudents as $attendance)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $attendance->student->name }}</td>
                                            <td>{{ $attendance->grade->name }}</td>
                                            <td>{{ $attendance->section->name }}</td>
                                            <td>{{ $attendance->created_at }}</td>
                                            <td>
                                                @if ($attendance->status == 'nonAttendance')
                                                    <span class="badge badge-danger">
                                                        {{ __('trans.' . $attendance->status) }}
                                                    </span>
                                                @else
                                                    <span class="badge badge-success">
                                                        {{ __('trans.' . $attendance->status) }}
                                                    </span>
                                                @endif
                                            </td>
                                        </tr>
                                        {{-- @include('pages.Students.Delete') --}}
                                    @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- row closed -->
    @endif
@endsection
