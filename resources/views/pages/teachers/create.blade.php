@extends('layouts.master')
@section('css')
    @livewireStyles

@section('title')
    {{ __('msgs.add', ['name' => __('teacher.teacher')]) }}
@stop

@endsection
@section('breadcrum')
{{ __('msgs.add', ['name' => __('teacher.teachers')]) }}
@endsection

@section('breadcrum_home')
{{ __('msgs.add', ['name' => __('teacher.teacher')]) }}
@endsection


@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                @if (session()->has('error'))
                    <small class="text text-danger font-weight-bold alert-dismissible fade show" role="alert">
                        <strong>{{ session()->get('error') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </small>
                @endif
                <div class="col-xs-12">
                    <div class="col-md-12">
                        <br>
                        <form action="{{ route('teachers.store') }}" method="post">
                            @csrf
                            <div class="form-row">
                                <div class="col">
                                    <x-label for="email" :value="__('trans.email')" />
                                    <x-input type="email" name="email" class="form-control" :value="old('email')"
                                        id="email" required />
                                    @error('email')
                                        <small class="text text-danger font-weight-bold">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col">
                                    <x-label for="password" :value="__('trans.password')" />
                                    <x-input type="password" name="password" class="form-control" id="password"
                                        required />
                                    @error('password')
                                        <small class="text text-danger font-weight-bold">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <br>
                            <div class="form-row">
                                <div class="col">
                                    <x-label for="name_ar" :value="__('teacher.name_ar')" />
                                    <x-input type="text" name="name_ar" class="form-control" :value="old('name_ar')"
                                        id="name_ar" required />
                                    @error('name_ar')
                                        <small class="text text-danger font-weight-bold">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col">
                                    <x-label for="name_en" :value="__('teacher.name_en')" />
                                    <x-input type="text" name="name_en" class="form-control" :value="old('name_en')"
                                        id="name_en" required />
                                    @error('name_en')
                                        <small class="text text-danger font-weight-bold">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <br>
                            <div class="form-row">
                                <div class="form-group col">
                                    <x-label for="specialization_id" :value="__('teacher.specialization')" />
                                    <select class="custom-select my-1 mr-sm-2" name="specialization_id">
                                        <option selected disabled value="">
                                            {{ __('msgs.select', ['name' => '...']) }}</option>
                                        @foreach ($specializations as $specialization)
                                            <option value="{{ $specialization->id }}">{{ $specialization->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('specialization_id')
                                        <small class="text text-danger font-weight-bold">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group col">
                                    <x-label for="gender" :value="__('teacher.gender')" />
                                    <select class="custom-select my-1 mr-sm-2" name="gender">
                                        <option selected disabled value="">
                                            {{ __('msgs.select', ['name' => '...']) }}</option>
                                        <option value="0">{{ __('trans.male') }}</option>
                                        <option value="1">{{ __('trans.female') }}</option>
                                    </select>
                                    @error('gender')
                                        <small class="text text-danger font-weight-bold">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <br>

                            <div class="form-row">
                                <div class="col">
                                    <x-label for="datepicker-action" :value="__('teacher.joining_data')" />
                                    <div class='input-group date'>
                                        <input class="form-control" type="text" id="datepicker-action" name="joining"
                                            data-date-format="yyyy-mm-dd" required :value="old('joining')">
                                    </div>
                                    @error('joining')
                                        <small class="text text-danger font-weight-bold">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <br>

                            <div class="form-group">
                                <x-label for="address" :value="__('teacher.address')" />
                                <textarea class="form-control" name="address" id="address" rows="4">{{ old('address') }}</textarea>
                                @error('address')
                                    <small class="text text-danger font-weight-bold">{{ $message }}</small>
                                @enderror
                            </div>
                            <x-button class="btn btn-success btn-sm nextBtn btn-lg pull-right">
                                {{ __('buttons.submit') }}
                            </x-button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
