@extends('layouts.master')

@section('title')
    {{ __('msgs.add', ['name' => __('trans.graduation')]) }}
@stop

@section('breadcrum')
    {{ __('trans.graduations_students') }}@endsection

@section('breadcrum_home')
    {{ __('msgs.add', ['name' => __('trans.graduation')]) }}
@endsection

@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger">{{ $error }}</div>
                        @endforeach
                    @endif
                    <form method="post" action="{{ route('students-graduations.store') }}">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-12 col-lg-6">
                                <x-label for="grade_id" :value="__('grade.grade')" />
                                <select class="custom-select mr-sm-2" name="grade_id">
                                    <option disabled value="" selected>{{ __('msgs.select', ['name' => '...']) }}
                                    </option>
                                    @foreach ($grades as $grade)
                                        <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                                    @endforeach
                                </select>
                                @error('grade_id')
                                    <small class="text text-danger font-weight-bold">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group col-md-12 col-lg-6">
                                <x-label for="classroom_id" :value="__('classroom.classroom')" />
                                <select class="custom-select mr-sm-2" name="classroom_id"></select>
                                @error('classroom_id')
                                    <small class="text text-danger font-weight-bold">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group col-md-12 col-lg-6">
                                <x-label for="section_id" :value="__('section.section')" />
                                <select class="custom-select mr-sm-2" name="section_id"></select>
                                @error('section_id')
                                    <small class="text text-danger font-weight-bold">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
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
@endsection
