@extends('layouts.master')
@section('css')

@section('title')
    {{ __('msgs.add', ['name' => __('trans.online_class')]) }}
@stop

@endsection
@section('breadcrum')
{{ __('trans.online_classes') }}
@endsection

@section('breadcrum_home')
{{ __('msgs.add', ['name' => __('trans.online_class')]) }}
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
                <form method="post" action="{{ route('online-classes.store') }}">
                    @csrf
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
                                <select class="custom-select mr-sm-2" name="section_id"></select>
                                @error('section_id')
                                    <small class="text text-danger font-weight-bold">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{ __('trans.title') }}<span class="text-danger">*</span></label>
                                <input class="form-control" name="topic" type="text" value="{{ old('topic') }}">
                                @error('topic')
                                    <small class="text text-danger font-weight-bold">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{ __('trans.start_at') }}<span class="text-danger">*</span></label>
                                <input class="form-control" type="datetime-local" name="start_time"
                                    value="{{ old('start_time') }}">
                                @error('start_time')
                                    <small class="text text-danger font-weight-bold">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{ __('trans.duration_in_min') }}<span class="text-danger">*</span></label>
                                <input class="form-control" name="duration" type="number"
                                    value="{{ old('duration') }}">
                                @error('duration')
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
@endsection
