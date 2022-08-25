@extends('layouts.master')
@section('css')

@section('title')
    {{ __('msgs.update', ['name' => __('trans.quiz')]) }}
@stop

@endsection
@section('breadcrum')
{{ __('trans.quizzes') }}
@endsection

@section('breadcrum_home')
{{ __('msgs.update', ['name' => __('trans.quiz')]) }}
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
                <form method="post" action="{{ route('quizzes.update', $quiz) }}" autocomplete="off">
                    @csrf
                    @method('PUT')
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <x-label for="name_ar" :value="__('trans.name_ar')" />
                                <x-input type="text" name="name_ar" class="form-control" name="name_ar"
                                    :value="old('name_ar', $quiz->getTranslation('name', 'ar'))" />
                                @error('name_ar')
                                    <small class="text text-danger font-weight-bold">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <x-label for="name_en" :value="__('student.name_en')" />
                                <x-input type="text" name="name_en" class="form-control" name="name_en"
                                    :value="old('name_ar', $quiz->getTranslation('name', 'en'))" />
                                @error('name_en')
                                    <small class="text text-danger font-weight-bold">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-xl-4">
                            <div class="form-group">
                                <x-label for="grade_id" :value="__('grade.grades')" />
                                <select class="custom-select mr-sm-2" name="grade_id">
                                    <option selected disabled>{{ __('msgs.select', ['name' => '...']) }}</option>
                                    @foreach ($grades as $grade)
                                        <option value="{{ $grade->id }}"
                                            {{ $grade->id == $quiz->grade_id ? 'selected' : '' }}>{{ $grade->name }}
                                        </option>
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
                                        @if ($grade->id == $quiz->grade_id)
                                            @foreach ($grade->classrooms as $classroom)
                                                <option value="{{ $classroom->id }}"
                                                    {{ $classroom->id == $quiz->classroom_id }}>
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

                        <div class="col-xl-4">
                            <div class="form-group">
                                <x-label for="section_id" :value="__('section.section')" />
                                <select class="custom-select mr-sm-2" name="section_id">
                                    @foreach ($grades as $grade)
                                        @foreach ($grade->sections as $section)
                                            @if ($grade->id == $quiz->grade_id)
                                                @foreach ($grade->sections as $section)
                                                    <option value="{{ $section->id }}"
                                                        {{ $section->id == $quiz->section_id }}>
                                                        {{ $section->name }}</option>
                                                @endforeach
                                            @endif
                                        @endforeach
                                    @endforeach
                                </select>
                                @error('section_id')
                                    <small class="text text-danger font-weight-bold">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-xl-6">
                            <div class="form-group">
                                <x-label for="subject_id" :value="__('trans.subjects')" />
                                <select class="custom-select mr-sm-2" name="subject_id">
                                    @foreach ($grades as $grade)
                                        @if ($grade->id == $quiz->grade_id)
                                            @foreach ($grade->subjects as $subject)
                                                <option value="{{ $subject->id }}"
                                                    {{ $subject->id == $quiz->subject_id }}>
                                                    {{ $subject->name }}</option>
                                            @endforeach
                                        @endif
                                    @endforeach
                                </select>
                                @error('subject_id')
                                    <small class="text text-danger font-weight-bold">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-xl-6">
                            <div class="form-group">
                                <x-label for="teacher_id" :value="__('trans.teachers')" />
                                <select class="custom-select mr-sm-2" name="teacher_id">
                                    @foreach ($grades as $grade)
                                        @if ($grade->id == $quiz->grade_id)
                                            @foreach ($grade->classrooms as $classroom)
                                                @if ($classroom->id == $quiz->classroom_id)
                                                    @foreach ($classroom->subjects as $subject)
                                                        @if ($subject->id == $quiz->subject_id)
                                                            <option value="{{ $subject->teacher->id }}">
                                                                {{ $subject->teacher->name }}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                </select>
                                @error('teacher_id')
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
@section('js')
{{-- Get Grade's Classrooms --}}
<script>
    $(function() {
        $('select[name=grade_id]').on('change', function() {
            var grade_id = $(this).val();
            if (grade_id) {
                $.ajax({
                    type: "get",
                    url: "/get-classrooms/" + grade_id,
                    dataType: "json",
                    success: function(response) {
                        $('select[name=classroom_id]').empty();
                        $('select[name=classroom_id]').append(
                            '<option disabled  value="" selected>{{ __('msgs.select', ['name' => '...']) }}</option>'
                        );
                        $.each(response, function(index, value) {
                            $('select[name=classroom_id]').append(
                                '<option value="' + index + '">' + value +
                                '</option>'
                            );
                        });
                    }
                });
            }
        })
    });
</script>

{{-- Get Classroom's Sections --}}
<script>
    $(function() {
        $('select[name=classroom_id]').on('change', function() {
            var classroom_id = $(this).val();
            if (classroom_id) {
                $.ajax({
                    type: "get",
                    url: "/get-sections/" + classroom_id,
                    dataType: "json",
                    success: function(response) {
                        $('select[name=section_id]').empty();
                        $('select[name=section_id]').append(
                            '<option disabled  value="" selected>{{ __('msgs.select', ['name' => '...']) }}</option>'
                        );
                        $.each(response, function(index, value) {
                            $('select[name=section_id]').append(
                                '<option value="' + index + '">' + value +
                                '</option>'
                            );
                        });
                    }
                });
            }
        })
    });
</script>

{{-- Get Classroom's Subjects --}}
<script>
    $(function() {
        $('select[name=classroom_id]').on('change', function() {
            var grade_id = $('select[name=grade_id]').val();
            var classroom_id = $(this).val();
            if (classroom_id) {
                $.ajax({
                    type: "get",
                    url: "/get-subjects/" + grade_id + '/' + classroom_id,
                    dataType: "json",
                    success: function(response) {
                        $('select[name=subject_id]').empty();
                        $('select[name=subject_id]').append(
                            '<option disabled  value="" selected>{{ __('msgs.select', ['name' => '...']) }}</option>'
                        );
                        $.each(response, function(index, value) {
                            $('select[name=subject_id]').append(
                                '<option value="' + index + '">' + value +
                                '</option>'
                            );
                        });
                    }
                });
            }
        })
    });
</script>

{{-- Get Subject's Teacher --}}
<script>
    $(function() {
        $('select[name=subject_id]').on('change', function() {
            var grade_id = $('select[name=grade_id]').val();
            var classroom_id = $('select[name=classroom_id]').val();
            var subject_id = $('select[name=subject_id]').val();
            if (classroom_id) {
                $.ajax({
                    type: "get",
                    url: "/get-teachers/" + grade_id + '/' + classroom_id + '/' + subject_id,
                    dataType: "json",
                    success: function(response) {
                        $('select[name=teacher_id]').empty();
                        $('select[name=teacher_id]').append(
                            '<option disabled  value="" selected>{{ __('msgs.select', ['name' => '...']) }}</option>'
                        );
                        console.log(response);
                        response.forEach((teacher) => {
                            document.querySelector(
                                    'select[name=teacher_id]')
                                .innerHTML +=
                                `<option value=${teacher['id']}>${teacher['name']['en']}</option>`;
                        });
                    }
                });
            }
        })
    });
</script>



{{-- Get Section's Teachers --}}
{{-- <script>
    $(function() {
        $('select[name=section_id]').on('change', function() {
            var section_id = $(this).val();
            if (section_id) {
                $.ajax({
                    type: "get",
                    url: "/get-teachers/" + section_id,
                    dataType: "json",
                    success: function(response) {
                        $('select[name=teacher_id]').empty();
                        $('select[name=teacher_id]').append(
                            '<option disabled  value="" selected>{{ __('msgs.select', ['name' => '...']) }}</option>'
                        );
                        response.forEach((teachers) => {
                            teachers.forEach((teacher) => {
                                document.querySelector(
                                        'select[name=teacher_id]')
                                    .innerHTML +=
                                    `<option value=${teacher['id']}>${teacher['name']['en']}</option>`;
                            })
                        });
                    }
                });
            }
        })
    });
</script> --}}
@endsection
