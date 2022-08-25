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
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="post" action="{{ route('quizzes.store') }}" autocomplete="off">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <x-label for="name_ar" :value="__('trans.name_ar')" />
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

                    <div class="row mb-3">
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
                                <select class="custom-select mr-sm-2" name="classroom_id">

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

                                </select>
                                @error('section_id')
                                    <small class="text text-danger font-weight-bold">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-xl-6">
                            <div class="form-group">
                                <x-label for="teacher_id" :value="__('trans.teachers')" />
                                <select class="custom-select mr-sm-2" name="teacher_id">

                                </select>
                                @error('teacher_id')
                                    <small class="text text-danger font-weight-bold">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-xl-6">
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
                            </div>
                        </div>
                    </div>
                    <hr>
                    <h5 class="text text-info">{{ __('parent.attachments') }}</h5>
                    <div class="row mb-3">
                        <div class="col-xl-6 col-md-6">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"
                                        id="inputGroupFileAddon01">{{ __('buttons.upload') }}</span>
                                </div>
                                <div class="custom-file">
                                    <x-input type="file" name="images[]" multiple class="custom-file"
                                        accept="image/*" id="photos" aria-describedby="inputGroupFileAddon01" />
                                    <x-label class="custom-file-label" for="photos" :value="__('msgs.select', ['name' => __('parent.attachments')])" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
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



{{-- Get Section's Teachers --}}
<script>
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
</script>
@endsection
