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
                                <th>{{ __('trans.created_at') }}</th>
                                <th>{{ __('buttons.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($quizzes as $quiz)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $quiz->name }}</td>
                                    <td>{{ $quiz->subject->name }}</td>
                                    <td>{{ $quiz->created_at }}</td>
                                    <td>

                                    </td>
                                </tr>
                            @empty
                                <tr class="text-center">
                                    <td colspan="4">{{ __('msgs.not_found_yet') }}</td>
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
@section('js')

@endsection
