@extends('layouts.master')
@section('css')

@section('title')
    {{ __('msgs.update', ['name' => __('trans.book')]) }}
@stop

@endsection
@section('breadcrum')
{{ __('trans.library') }}
@endsection

@section('breadcrum_home')
{{ __('msgs.update', ['name' => __('trans.book')]) }}
@endsection

@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="post" action="{{ route('teacher.library.update', $library) }}" autocomplete="off"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-xl-4">
                            <div class="form-group">
                                <x-label for="grade_id" :value="__('grade.grades')" />
                                <select class="custom-select mr-sm-2" name="grade_id">
                                    <option selected disabled>{{ __('msgs.select', ['name' => '...']) }}</option>
                                    @foreach ($grades as $grade)
                                        <option value="{{ $grade->id }}"
                                            {{ $library->grade_id == $grade->id ? 'selected' : '' }}>
                                            {{ $grade->name }}</option>
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
                                <select class="custom-select mr-sm-2" name="classroom_id">
                                    @foreach ($grades as $grade)
                                        @if ($grade->id == $library->grade_id)
                                            @foreach ($grade->classrooms as $classroom)
                                                <option value="{{ $classroom->id }}"
                                                    {{ $classroom->id == $library->classroom_id }}>
                                                    {{ $classroom->name }}</option>
                                            @endforeach
                                        @endif
                                    @endforeach
                                </select>
                                @error('classroom_id')
                                    <small class="text text-danger font-weight-bold">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-xl-4 col-md-12">
                            <div class="form-group">
                                <x-label for="section_id" :value="__('section.section')" />
                                <select class="custom-select mr-sm-2" name="section_id">
                                    @foreach ($grades as $grade)
                                        @if ($grade->id == $library->grade_id)
                                            @foreach ($grade->sections as $section)
                                                @if ($section->id == $library->section_id)
                                                    <option value="{{ $section->id }}">{{ $section->name }}</option>
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                </select>
                                @error('section_id')
                                    <small class="text text-danger font-weight-bold">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ __('trans.title') }}<span class="text-danger">*</span></label>
                                <input class="form-control" name="title" type="text"
                                    value="{{ old('title', $library->title) }}">
                                @error('title')
                                    <small class="text text-danger font-weight-bold">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label>{{ __('student.filename') }}<span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"
                                        id="inputGroupFileAddon01">{{ __('buttons.upload') }}</span>
                                </div>
                                <div class="custom-file">
                                    <x-input type="file" name="file_name" class="custom-file" id="file_name"
                                        aria-describedby="inputGroupFileAddon01" />
                                    <x-label class="custom-file-label" for="file_name" :value="__('msgs.select', ['name' => __('parent.attachments')])" />
                                </div>
                            </div>
                        </div>

                    </div>
                    <hr>
                    <button type="submit" class="button button-border x-small">
                        {{ __('buttons.update') }}
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
@endsection
