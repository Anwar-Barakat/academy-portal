@extends('layouts.master')
@section('css')

@section('title')
    {{ __('trans.list', ['name' => __('trans.quizzes')]) }}
@stop
@endsection

@section('breadcrum')
{{ __('trans.quizzes') }}
@endsection

@section('breadcrum_home')
{{ __('trans.list', ['name' => __('trans.quizzes')]) }}
@endsection


@section('content')
<!-- main body -->
<div class="row">
    <div class="col-xl-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered text-center p-0 table-hover table-sm">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('trans.quiz_name') }}</th>
                                <th>{{ __('trans.subject') }}</th>
                                <th>{{ __('teacher.date') }}</th>
                                <th>{{ __('trans.degrees') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($degrees as $degree)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $degree->quiz->name }}</td>
                                    <td>{{ $degree->quiz->subject->name }}</td>
                                    <td>{{ $degree->created_at }}</td>
                                    <td class="d-flex align-items-center justify-content-center h-100">

                                        @if ($degree->degree >= 50)
                                            <label class="badge badge-success">{{ $degree->degree }}
                                                {{ __('student.successful') }}</label>
                                        @else
                                            <label class="badge badge-danger">{{ $degree->degree }}
                                                {{ __('student.failed') }}</label>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr class="text-center">
                                    <td colspan="5">{{ __('msgs.not_found_yet') }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
