@extends('layouts.master')
@section('css')

@section('title')
    {{ __('msgs.add', ['name' => __('student.student')]) }}
@stop

@endsection
@section('breadcrum')
{{ __('student.students') }}
@endsection

@section('breadcrum_home')
{{ __('msgs.add', ['name' => __('student.student')]) }}
@endsection

@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <form method="post" action="{{ route('students.store') }}" autocomplete="off"
                    enctype="multipart/form-data">
                    @csrf
                    <h4 class="text text-info mb-3">
                        {{ __('student.personal_information') }}</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <x-label for="name_ar" :value="__('student.name_ar')" />
                                <x-input type="text" name="name_ar" class="form-control" name="name_ar"
                                    :value="old('name_ar')" />
                                @error('name_ar')
                                    <small class="text text-danger font-weight-bold">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
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
                        <div class="col-md-6">
                            <div class="form-group">
                                <x-label for="email" :value="__('student.email')" />
                                <x-input type="email" name="email" class="form-control" name="email"
                                    :value="old('email')" />
                                @error('email')
                                    <small class="text text-danger font-weight-bold">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <x-label for="password" :value="__('trans.password')" />
                                <x-input type="password" name="password" class="form-control" name="password"
                                    :value="old('password')" />
                                @error('password')
                                    <small class="text text-danger font-weight-bold">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <x-label for="gender" :value="__('trans.gender')" />
                                <select class="custom-select mr-sm-2" name="gender">
                                    <option disabled value="" selected>{{ __('msgs.select', ['name' => '...']) }}
                                    </option>
                                    <option value="0">{{ __('trans.male') }}</option>
                                    <option value="1">{{ __('trans.female') }}</option>
                                </select>
                                @error('gender')
                                    <small class="text text-danger font-weight-bold">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <x-label for="nationality_id" :value="__('student.nationality')" />
                                <select class="custom-select mr-sm-2" name="nationality_id">
                                    <option disabled value="">{{ __('msgs.select', ['name' => '...']) }}</option>
                                    @foreach ($nationalities as $nationlity)
                                        <option value="{{ $nationlity->id }}">{{ $nationlity->name }}</option>
                                    @endforeach
                                </select>
                                @error('nationality_id')
                                    <small class="text text-danger font-weight-bold">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <x-label for="blood_id" :value="__('student.blood_type')" />
                                <select class="custom-select mr-sm-2" name="blood_id">
                                    <option selected disabled>{{ __('msgs.select', ['name' => '...']) }}</option>
                                    @foreach ($bloods as $blood)
                                        <option value="{{ $blood->id }}">{{ $blood->name }}</option>
                                    @endforeach
                                </select>
                                @error('blood_id')
                                    <small class="text text-danger font-weight-bold">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <x-label for="birthday" :value="__('student.birthday')" />
                                <x-input class="form-control" type="date" id="datepicker-action" name="birthday"
                                    data-date-format="yyyy-mm-dd" :value="old('birthday')" />
                                @error('birthday')
                                    <small class="text text-danger font-weight-bold">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <hr>
                    <br>
                    <h4 class="text text-info mb-3">{{ __('student.student_information') }}</h4>
                    <div class="row">
                        <div class="col-xl-4 col-md-12">
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

                        <div class="col-xl-4 col-md-12">
                            <div class="form-group">
                                <x-label for="classroom_id" :value="__('classroom.classrooms')" />
                                <select class="custom-select mr-sm-2" name="classroom_id">

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

                                </select>
                                @error('section_id')
                                    <small class="text text-danger font-weight-bold">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-xl-6 col-md-12">
                            <div class="form-group">
                                <x-label for="parent_id" :value="__('parent.parents')" />
                                <select class="custom-select mr-sm-2" name="parent_id">
                                    <option selected disabled>{{ __('msgs.select', ['name' => '...']) }}</option>
                                    @foreach ($parents as $parent)
                                        <option value="{{ $parent->id }}">{{ $parent->father_name }}</option>
                                    @endforeach
                                </select>
                                @error('parent_id')
                                    <small class="text text-danger font-weight-bold">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-xl-6 col-md-12">
                            <div class="form-group">
                                <x-label for="academic_year" :value="__('student.academic_year')" />
                                <select class="custom-select mr-sm-2" name="academic_year">
                                    <option selected disabled>{{ __('msgs.select', ['name' => '...']) }}</option>
                                    @php
                                        $current_year = date('Y');
                                    @endphp
                                    @for ($year = $current_year; $year <= $current_year + 1; $year++)
                                        <option value="{{ $year }}">{{ $year }}</option>
                                    @endfor
                                </select>
                                @error('academic_year')
                                    <small class="text text-danger font-weight-bold">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <br>
                    <hr>
                    <h4 class="text text-info mb-3">{{ __('parent.attachments') }}</h4>
                    <div class="row">
                        <div class="col-xl-6 col-md-12">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"
                                        id="inputGroupFileAddon01">{{ __('buttons.upload') }}</span>
                                </div>
                                <div class="custom-file">
                                    <x-input type="file" name="image" class="custom-file" accept="image/*"
                                        id="images" aria-describedby="inputGroupFileAddon01" />
                                    <x-label class="custom-file-label" for="images" :value="__('msgs.select', ['name' => __('parent.attachments')])" />
                                    @error('image')
                                        <small class="text text-danger font-weight-bold">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <hr>
                    <button type="submit" class="button x-small successful-button">
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
@endsection
