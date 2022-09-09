@extends('layouts.master')
@section('css')

@section('title')
    {{ __('msgs.add', ['name' => __('trans.quiz')]) }}
@stop

@endsection
@section('breadcrum')
{{ __('trans.quizzes') }}
@endsection

@section('breadcrum_home')
{{ __('msgs.add', ['name' => __('trans.quiz')]) }}
@endsection

@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <form method="post" action="{{ route('quizzes.store') }}" autocomplete="off">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <x-label for="name_ar" :value="__('trans.name_ar')" />
                                <x-input type="text" name="name_ar" class="form-control" name="name_ar"
                                    :value="old('name_ar')" />
                                @error('name_ar')
                                    <small class="text text-danger font-weight-bold">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <x-label for="name_en" :value="__('student.name_en')" />
                                <x-input type="text" name="name_en" class="form-control" name="name_en"
                                    :value="old('name_en')" />
                                @error('name_en')
                                    <small class="text text-danger font-weight-bold">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-4">
                            <div class="form-group">
                                <x-label for="grade_id" :value="__('grade.grades')" />
                                <select class="custom-select mr-sm-2" name="grade_id">
                                    <option selected disabled>{{ __('msgs.select', ['name' => '...']) }}</option>
                                    @foreach ($grades as $grade)
                                        <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                                    @endforeach
                                </select>
                                @error('grade_id')
                                    <small class="text text-danger font-weight-bold">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-xl-4">
                            <div class="form-group">
                                <x-label for="classroom_id" :value="__('classroom.classrooms')" />
                                <select class="custom-select mr-sm-2" name="classroom_id"></select>
                                @error('classroom_id')
                                    <small class="text text-danger font-weight-bold">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-xl-4 col-md-12">
                            <div class="form-group">
                                <x-label for="section_id" :value="__('section.section')" />
                                <select class="custom-select mr-sm-2" name="section_id">

                                </select>
                                @error('section_id')
                                    <small class="text text-danger font-weight-bold">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div class="form-group">
                                <x-label for="teacher_id" :value="__('trans.teachers')" />
                                <select class="custom-select mr-sm-2" name="teacher_id">

                                </select>
                                @error('teacher_id')
                                    <small class="text text-danger font-weight-bold">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-xl-4">
                            <div class="form-group">
                                <x-label for="subject_id" :value="__('trans.subjects')" />
                                <select class="custom-select mr-sm-2" name="subject_id">

                                </select>
                                @error('subject_id')
                                    <small class="text text-danger font-weight-bold">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <hr>
                    <br>
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
@section('js')
<script src="{{ asset('assets/js/custom/get-classtooms.js') }}"></script>
<script src="{{ asset('assets/js/custom/get-sections.js') }}"></script>
<script src="{{ asset('assets/js/custom/get-teachers.js') }}"></script>
<script src="{{ asset('assets/js/custom/get-subjects.js') }}"></script>
@endsection
