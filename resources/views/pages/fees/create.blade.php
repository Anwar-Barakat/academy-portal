@extends('layouts.master')

@section('title')
    {{ __('msgs.add', ['name' => __('fee.fee')]) }}
@stop

@section('breadcrum')
    {{ __('fee.fees') }}
@endsection

@section('breadcrum_home')
    {{ __('msgs.add', ['name' => __('fee.fee')]) }}
@endsection


@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    <form method="post" action="{{ route('fees.store') }}" autocomplete="off">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-12 col-lg-6 mb-3">
                                <x-label for="type" :value="__('fee.fees_type')" />
                                <select class="custom-select mr-sm-2" name="type">
                                    <option selected disabled>{{ __('msgs.select', ['name' => '...']) }}</option>
                                    <option value="0">{{ __('fee.study') }}</option>
                                    <option value="1">{{ __('fee.bus') }}</option>
                                </select>
                                @error('type')
                                    <small class="text text-danger font-weight-bold">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group col">
                                <x-label for="amount" :value="__('fee.amount')" />
                                <x-input id="amount" name="amount" :value="old('amount')" class="form-control"
                                    type="number" />
                                @error('amount')
                                    <small class="text text-danger font-weight-bold">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>


                        <div class="row">
                            <div class="form-group col-md-12 col-lg-6 mb-3">
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
                            <div class="form-group col-md-12 col-lg-6 mb-3">
                                <x-label for="classroom_id" :value="__('classroom.classrooms')" />
                                <select class="custom-select mr-sm-2" name="classroom_id"></select>
                                @error('classroom_id')
                                    <small class="text text-danger font-weight-bold">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12 col-lg-6 mb-3">
                                <x-label for="year" :value="__('student.academic_year')" />
                                <select class="custom-select mr-sm-2" name="year" id="year">
                                    <option selected disabled>{{ __('msgs.select', ['name' => '...']) }}</option>
                                    @php
                                        $current_year = date('Y');
                                    @endphp
                                    @for ($year = $current_year; $year <= $current_year + 1; $year++)
                                        <option value="{{ $year }}">{{ $year }}</option>
                                    @endfor
                                </select>
                                @error('year')
                                    <small class="text text-danger font-weight-bold">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <x-label for="description" :value="__('fee.notes')" />
                            <textarea class="form-control" name="description" id="description" rows="4">{{ old('description') }}</textarea>
                            @error('description')
                                <small class="text text-danger font-weight-bold">{{ $message }}</small>
                            @enderror
                        </div>
                        <br>

                        <button type="submit" class="button button-border x-small">{{ __('buttons.submit') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection

@section('js')
    <script src="{{ asset('assets/js/custom/get-classtooms.js') }}"></script>
@endsection
