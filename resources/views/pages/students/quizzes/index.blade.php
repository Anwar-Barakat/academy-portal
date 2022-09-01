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
                                <th>{{ __('student.enter_exam') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($quizzes as $quiz)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $quiz->name }}</td>
                                    <td>{{ $quiz->subject->name }}</td>
                                    <td>{{ $quiz->created_at }}</td>
                                    <td class="d-flex align-items-center justify-content-center h-100">
                                        @if ($quiz->degrees->count() > 0 && $quiz->id == $quiz->degrees[0]->quiz_id)
                                            @if ($quiz->degrees[0]->degree >= 50)
                                                <label class="badge badge-success">{{ $quiz->degrees[0]->degree }}
                                                    {{ __('student.successful') }}</label>
                                            @else
                                                <label class="badge badge-danger">{{ $quiz->degrees[0]->degree }}
                                                    {{ __('student.failed') }}</label>
                                            @endif
                                        @else
                                            <a href="{{ route('student.quizzes.show', $quiz) }}"
                                                class="btn btn-outline-info btn-sm" onclick="ExamWarning()">
                                                <i class="fas fa-sign-in-alt"></i>
                                            </a>
                                        @endif
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
<script>
    function ExamWarning() {
        alert(`{{ __('msgs.exam_refrech_warnings') }}`);
    }
</script>
@endsection
