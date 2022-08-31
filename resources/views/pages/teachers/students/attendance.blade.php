@extends('layouts.master')

@section('title')
    {{ __('trans.list', ['name' => __('trans.attendances')]) }}
@stop

@section('breadcrum')
    {{ __('trans.attachments') }}@endsection

@section('breadcrum_home')
    {{ __('trans.list', ['name' => __('trans.attendances')]) }}
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

                    <div class="table-responsive">
                        <form action="{{ route('teacher.students-attendance.store') }}" method="POST">
                            @csrf
                            <table id="datatable"
                                class="table table-striped table-bordered text-center p-0 table-hover table-sm">
                                <thead>
                                    <tr>
                                        <th class="alert alert-info">#</th>
                                        <th class="alert alert-info">{{ __('fee.student_name') }}</th>
                                        <th class="alert alert-info">{{ __('grade.grade') }}</th>
                                        <th class="alert alert-info">{{ __('classroom.classroom') }}</th>
                                        <th class="alert alert-info">{{ __('section.section') }}</th>
                                        <th class="alert alert-info">{{ __('trans.attendance') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($students as $student)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $student->name }}</td>
                                            <td>{{ $student->grade->name }}</td>
                                            <td>{{ $student->classroom->name }}</td>
                                            <td>{{ $student->section->name }}</td>
                                            <td>
                                                <div class="d-flex justify-content-around">
                                                    <div>
                                                        <label class="block text-gray-500 font-semibold">
                                                            <input name="attendences[{{ $student->id }}]"
                                                                class="leading-tight"
                                                                @foreach ($student->attendances()->where('created_at', date('Y-m-d'))->get() as $attendance)
                                                                {{ $attendance->status ? 'checked' : '' }} @endforeach
                                                                type="radio" value="presence">
                                                            <span class="text-success">{{ __('trans.attendance') }}</span>
                                                        </label>
                                                    </div>
                                                    <div>
                                                        <label class="ml-4 block text-gray-500 font-semibold">
                                                            <input name="attendences[{{ $student->id }}]"
                                                                @foreach ($student->attendances()->where('created_at', date('Y-m-d'))->get() as $attendance)
                                                            {{ !$attendance->status ? 'checked' : '' }} @endforeach
                                                                class="leading-tight" type="radio" value="absent">
                                                            <span
                                                                class="text-danger">{{ __('trans.nonAttendance') }}</span>
                                                        </label>
                                                    </div>
                                                </div>

                                                <input type="hidden" name="student_id[]" value="{{ $student->id }}">
                                                <input type="hidden" name="grade_id" value="{{ $student->grade_id }}">
                                                <input type="hidden" name="classroom_id"
                                                    value="{{ $student->classroom_id }}">
                                                <input type="hidden" name="section_id" value="{{ $student->section_id }}">
                                            </td>
                                        </tr>
                                    @empty
                                        <tr class="text-center">
                                            <td colspan="6">{{ __('msgs.not_found_yet') }}</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <hr>
                            <button class="button button-border x-small mb-3" type="submit">
                                {{ __('buttons.submit') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
