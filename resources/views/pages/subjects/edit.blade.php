@extends('layouts.master')
@section('css')

@section('title')
    {{ __('msgs.update', ['name' => __('trans.subject')]) }}
@stop

@endsection
@section('breadcrum')
{{ __('trans.subjects') }}
@endsection

@section('breadcrum_home')
{{ __('msgs.update', ['name' => __('trans.subject')]) }}
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
                <form method="post" action="{{ route('subjects.update', $subject) }}" autocomplete="off">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <x-label for="name_ar" :value="__('trans.name_ar')" />
                                <x-input type="text" name="name_ar" class="form-control" name="name_ar"
                                    :value="old('name_ar', $subject->getTranslation('name', 'ar'))" />
                                @error('name_ar')
                                    <small class="text text-danger font-weight-bold">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <x-label for="name_en" :value="__('trans.name_en')" />
                                <x-input type="text" name="name_en" class="form-control" name="name_en"
                                    :value="old('name_en', $subject->getTranslation('name', 'en'))" />
                                @error('name_en')
                                    <small class="text text-danger font-weight-bold">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-xl-4">
                            <div class="form-group">
                                <x-label for="grade_id" :value="__('grade.grades')" />
                                <select class="custom-select mr-sm-2" name="grade_id">
                                    <option selected disabled>{{ __('msgs.select', ['name' => '...']) }}</option>
                                    @foreach ($grades as $grade)
                                        <option value="{{ $grade->id }}"
                                            {{ $subject->grade_id == $grade->id ? 'selected' : '' }}>
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
                                        @if ($grade->id == $subject->grade_id)
                                            @foreach ($grade->classrooms as $classroom)
                                                <option value="{{ $classroom->id }}"
                                                    {{ $classroom->id == $subject->classroom_id }}>
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
                                <x-label for="grade_id" :value="__('grade.grades')" />
                                <select class="custom-select mr-sm-2" name="grade_id">
                                    <option selected disabled>{{ __('msgs.select', ['name' => '...']) }}</option>
                                    @foreach ($grades as $grade)
                                        <option value="{{ $grade->id }}"
                                            {{ $grade->id == $student->grade_id ? 'selected' : '' }}>
                                            {{ $grade->name }}
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
                                <x-label for="teacher_id" :value="__('trans.teachers')" />
                                <select class="custom-select mr-sm-2" name="teacher_id">
                                    <option value="" selected disabled>
                                        {{ __('msgs.select', ['name' => '...']) }}
                                    </option>
                                    @foreach ($teachers as $teacher)
                                        <option value="{{ $teacher->id }}"
                                            {{ $subject->teacher_id == $teacher->id ? 'selected' : '' }}>
                                            {{ $teacher->name }} - {{ $teacher->specialization->name }}
                                        </option>
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

@endsection
