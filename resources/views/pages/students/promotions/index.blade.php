@extends('layouts.master')

@section('title')
    {{ __('trans.students_promotion') }}
@stop

@section('breadcrum')
    {{ __('student.students') }}@endsection

@section('breadcrum_home')
    {{ __('trans.students_promotion') }}
@endsection

@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    @if (Session::has('error_promotions'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{ Session::get('error_promotions') }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <h5 class="text text-info">{{ __('student.old_grade') }}</h5>
                    <br>
                    <form method="post" action="{{ route('students-promotions.store') }}">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-12 col-lg-6">
                                <x-label for="grade_id" :value="__('grade.grade')" />
                                <select class="custom-select mr-sm-2" name="grade_id" required>
                                    <option disabled value="" selected>{{ __('msgs.select', ['name' => '...']) }}
                                    </option>
                                    @foreach ($grades as $grade)
                                        <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-12 col-lg-6">
                                <x-label for="classroom_id" :value="__('classroom.classroom')" />
                                <select class="custom-select mr-sm-2" name="classroom_id" required></select>
                            </div>

                            <div class="form-group col-md-12 col-lg-6">
                                <x-label for="section_id" :value="__('section.section')" />
                                <select class="custom-select mr-sm-2" name="section_id" required></select>
                            </div>

                            <div class="col-md-12 col-lg-6">
                                <div class="form-group">
                                    <x-label for="academic_year" :value="__('student.academic_year')" />
                                    <select class="custom-select mr-sm-2" name="academic_year">
                                        <option value="" disabled selected>{{ __('msgs.select', ['name' => '...']) }}
                                        </option>
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
                        <br>
                        <h5 class="text text-info">{{ __('student.new_grade') }}</h5>
                        <div class="row">
                            <div class="form-group col-md-12 col-lg-6">
                                <x-label for="new_grade_id" :value="__('grade.grade')" />
                                <select class="custom-select mr-sm-2" name="new_grade_id">
                                    <option selected disabled>{{ __('msgs.select', ['name' => '...']) }}</option>
                                    @foreach ($grades as $grade)
                                        <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-12 col-lg-6">
                                <x-label for="new_classroom_id" :value="__('classroom.classroom')" />
                                <select class="custom-select mr-sm-2" name="new_classroom_id"></select>
                            </div>
                            <div class="form-group col-md-12 col-lg-6">
                                <x-label for="new_section_id" :value="__('section.section')" />
                                <select class="custom-select mr-sm-2" name="new_section_id"></select>
                            </div>
                            <div class="col-md-12 col-lg-6">
                                <div class="form-group">
                                    <label for="new_academic_year">{{ __('student.academic_year') }}<span
                                            class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="new_academic_year">
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
                                '<option disabled selected value="">{{ __('msgs.select', ['name' => '...']) }}</option>'
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
                                '<option disabled selected value="">{{ __('msgs.select', ['name' => '...']) }}</option>'
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

    {{-- Get New Grade's Classrooms --}}
    <script>
        $(function() {
            $('select[name=new_grade_id]').on('change', function() {
                var new_grade_id = $(this).val();
                if (new_grade_id) {
                    $.ajax({
                        type: "get",
                        url: "/get-classrooms/" + new_grade_id,
                        dataType: "json",
                        success: function(response) {
                            $('select[name=new_classroom_id]').empty();
                            $('select[name=new_classroom_id]').append(
                                '<option disabled value="" selected>{{ __('msgs.select', ['name' => '...']) }}</option>'
                            );
                            $.each(response, function(index, value) {
                                $('select[name=new_classroom_id]').append(
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

    {{-- Get New Classroom's Sections --}}
    <script>
        $(function() {
            $('select[name=new_classroom_id]').on('change', function() {
                var new_classroom_id = $(this).val();
                if (new_classroom_id) {
                    $.ajax({
                        type: "get",
                        url: "/get-sections/" + new_classroom_id,
                        dataType: "json",
                        success: function(response) {
                            $('select[name=new_section_id]').empty();
                            $('select[name=new_section_id]').append(
                                '<option disabled>{{ __('msgs.select', ['name' => '...']) }}</option>'
                            );
                            $.each(response, function(index, value) {
                                $('select[name=new_section_id]').append(
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
