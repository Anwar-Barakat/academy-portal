@extends('layouts.master')

@section('livewire-css')
    @livewireStyles
@endsection

@section('title')
    {{ __('student.enter_exam') }}
@stop
@section('breadcrum')
    {{ __('trans.quiz_name') }} - {{ $quiz->name }}
@endsection

@section('breadcrum_home')
    {{ __('student.enter_exam') }}
@endsection


@section('content')
    <!-- main body -->
    <div class="row">
        <div class="col-xl-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    @livewire('show-question', [
                        'quiz_id' => $quiz->id,
                        'student_id' => auth()->guard('student')->user()->id,
                    ])
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection

@section('liwewire-js')
    @livewireScripts
@endsection
