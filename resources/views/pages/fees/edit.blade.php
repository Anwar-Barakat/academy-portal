@extends('layouts.master')

@section('title')
    {{ __('msgs.update', ['name' => __('fee.fee')]) }}
@stop

@section('breadcrum')
    {{ __('fee.fees') }}
@endsection

@section('breadcrum_home')
    {{ __('msgs.update', ['name' => __('fee.fee')]) }}
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

                    <form method="post" action="{{ route('fees.update', $fee) }}" autocomplete="off">
                        @csrf
                        @method('PUT')
                        <div class="form-row">
                            <div class="form-group col">
                                <x-label for="title_ar" :value="__('trans.name_ar')" />
                                <x-input id="title_ar" name="title_ar" :value="old('title_ar', $fee->getTranslation('title', 'ar'))" class="form-control"
                                    type="text" />
                                @error('title_ar')
                                    <small class="text text-danger font-weight-bold">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group col">
                                <x-label for="title_en" :value="__('trans.name_en')" />
                                <x-input id="title_en" name="title_en" :value="old('title_en', $fee->getTranslation('title', 'en'))" class="form-control"
                                    type="text" />
                                @error('title_en')
                                    <small class="text text-danger font-weight-bold">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group col">
                                <x-label for="amount" :value="__('fee.amount')" />
                                <x-input id="amount" name="amount" :value="old('amount', $fee->amount)" class="form-control"
                                    type="number" />
                                @error('amount')
                                    <small class="text text-danger font-weight-bold">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>


                        <div class="form-row">
                            <div class="form-group col">
                                <x-label for="grade_id" :value="__('grade.grades')" />
                                <select class="custom-select mr-sm-2" name="grade_id">
                                    <option selected disabled>{{ __('msgs.select', ['name' => '...']) }}</option>
                                    @foreach ($grades as $grade)
                                        <option value="{{ $grade->id }}"
                                            {{ $grade->id == $fee->grade_id ? 'selected' : '' }}>{{ $grade->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col">
                                <x-label for="classroom_id" :value="__('classroom.classrooms')" />
                                <select class="custom-select mr-sm-2" name="classroom_id">
                                    @foreach ($grades as $grade)
                                        @if ($grade->id == $fee->grade_id)
                                            @foreach ($grade->classrooms as $classroom)
                                                <option value="{{ $classroom->id }}"
                                                    {{ $classroom->id == $fee->classroom_id }}>
                                                    {{ $classroom->name }}</option>
                                            @endforeach
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col">
                                <x-label for="classroom_id" :value="__('student.academic_year')" />
                                <select class="custom-select mr-sm-2" name="year">
                                    <option selected disabled>{{ __('msgs.select', ['name' => '...']) }}</option>
                                    @php
                                        $current_year = date('Y');
                                    @endphp
                                    @for ($year = $current_year; $year <= $current_year + 1; $year++)
                                        <option value="{{ $year }}" {{ $year == $fee->year ? 'selected' : '' }}>
                                            {{ $year }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <x-label for="classroom_id" :value="__('fee.notes')" />
                            <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="4">{{ old('notes', $fee->notes) }}
                            </textarea>
                        </div>
                        <br>

                        <button type="submit" class="button button-border x-small">{{ __('buttons.update') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('select[name=grade_id]').on('change', function() {
                var grade_id = $(this).val()
                if (grade_id) {
                    $.ajax({
                        url: "{{ URL::to('get-classrooms') }}/" + grade_id,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('select[name=classroom_id]').empty();
                            $('select[name=classroom_id]').append(
                                '<option disabled  value="" selected>{{ __('msgs.select', ['name' => '...']) }}</option>'
                            );
                            $.each(data, function(key, value) {

                                $('select[name=classroom_id]').append(
                                    '<option value="' + key + '">' + value +
                                    '</option>');
                            });
                        },
                    });
                }
            })
        })
    </script>
@stop
