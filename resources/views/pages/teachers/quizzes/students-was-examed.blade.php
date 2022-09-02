@extends('layouts.master')

@section('title')
    {{ __('trans.list', ['name' => __('msgs.finished', ['name' => __('trans.quiz')])]) }}
@stop

@section('breadcrum')
    {{ __('trans.quizzes') }}
@endsection

@section('breadcrum_home')
    {{ __('trans.list', ['name' => __('msgs.finished', ['name' => __('trans.quiz')])]) }}
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

                    <div class="table-responsive">
                        <table id="datatable" class="table table-striped table-bordered text-center p-0 table-hover table-sm">
                            <thead>
                                <tr>
                                    <th class="alert-info">#</th>
                                    <th class="alert-info">{{ __('student.name') }}</th>
                                    <th class="alert-info">{{ __('trans.degrees') }}</th>
                                    <th class="alert-success">{{ __('trans.quiz_name') }}</th>
                                    <th class="alert-success">{{ __('trans.subject') }}</th>
                                    <th class="alert-success">{{ __('grade.grade') }}</th>
                                    <th class="alert-success">{{ __('classroom.classroom') }}</th>
                                    <th class="alert-success">{{ __('section.section') }}</th>
                                    <th class="alert-info">{{ __('trans.created_at') }}</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse ($degrees as $degree)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $degree->student->name }}</td>
                                        <td>
                                            @if ($degree->degree >= 50)
                                                <label class="badge badge-success">{{ $degree->degree }}
                                                    {{ __('student.successful') }}</label>
                                            @else
                                                <label class="badge badge-danger">{{ $degree->degree }}
                                                    {{ __('student.failed') }}</label>
                                            @endif
                                        </td>
                                        <td>{{ $degree->quiz->name }}</td>
                                        <td>{{ $degree->quiz->subject->name }}</td>
                                        <td>{{ $degree->quiz->grade->name }}</td>
                                        <td>{{ $degree->quiz->classroom->name }}</td>
                                        <td>{{ $degree->quiz->section->name }}</td>
                                        <td>{{ $degree->created_at }}</td>
                                    </tr>
                                @empty
                                    <tr class="text-center">
                                        <td colspan="8">{{ __('msgs.not_found_yet') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
