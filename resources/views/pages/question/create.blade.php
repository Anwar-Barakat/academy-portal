@extends('layouts.master')
@section('css')

@section('title')
    {{ __('msgs.add', ['name' => __('trans.question')]) }}
@stop

@endsection
@section('breadcrum')
{{ __('trans.quizzes') }}
@endsection

@section('breadcrum_home')
{{ __('msgs.add', ['name' => __('trans.question')]) }}
@endsection

@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <form method="post" action="{{ route('questions.store') }}" autocomplete="off">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <x-label for="title_ar" :value="__('trans.arabic_question')" />
                                <x-input type="text" name="title_ar" class="form-control" name="title_ar"
                                    :value="old('title_ar')" aria-required="" />
                                @error('title_ar')
                                    <small class="text text-danger font-weight-bold">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <x-label for="title_en" :value="__('trans.english_question')" />
                                <x-input type="text" name="title_en" class="form-control" name="title_en"
                                    :value="old('title_en')" aria-required="" />
                                @error('title_en')
                                    <small class="text text-danger font-weight-bold">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <x-label for="all_answers" :value="__('trans.all_answers')" />
                                <textarea id="all_answers" class="form-control w-100" name="all_answers" rows="3"
                                    placeholder="{{ __('msgs.question_condition') }}" required>{{ old('all_answers') }}</textarea>
                                @error('all_answers')
                                    <small class="text text-danger font-weight-bold">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <x-label for="right_answer" :value="__('trans.right_answer')" />
                                <x-input type="text" name="right_answer" class="form-control" name="right_answer"
                                    :value="old('right_answer')" aria-required="" />
                                @error('right_answer')
                                    <small class="text text-danger font-weight-bold">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-xl-6">
                            <div class="form-group">
                                <x-label for="degrees" :value="__('trans.degrees')" />
                                <select class="custom-select mr-sm-2" name="degrees">
                                    <option value="" disabled selected>
                                        {{ __('msgs.select', ['name' => __('...')]) }}
                                    </option>
                                    <option value="5">5</option>
                                    <option value="10">10</option>
                                    <option value="15">15</option>
                                    <option value="20">20</option>
                                    <option value="25">25</option>
                                </select>
                                @error('degrees')
                                    <small class="text text-danger font-weight-bold">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="form-group">
                                <x-label for="quiz_id" :value="__('trans.quizzes')" />
                                <select class="custom-select mr-sm-2" name="quiz_id">
                                    <option value="" @selected(true)>
                                        {{ __('msgs.select', ['name' => '...']) }}</option>
                                    @foreach ($quizzes as $quiz)
                                        <option value="{{ $quiz->id }}">{{ $quiz->name }}</option>
                                    @endforeach
                                </select>
                                @error('quiz_id')
                                    <small class="text text-danger font-weight-bold">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <hr>
                    <button type="submit" class="button button-border x-small">
                        {{ __('buttons.submit') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
