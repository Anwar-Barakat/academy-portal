@extends('layouts.master')
@section('css')

@section('title')
    {{ __('trans.settings') }}
@stop

@endsection
@section('breadcrum')
{{ __('trans.settings') }}
@endsection

@section('breadcrum_home')
{{ __('trans.settings') }}
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
                    <div class="col-md-12" style="display: grid; grid-template-columns: repeat(2,1fr)">

                        <form action="{{ route('settings.update', 'test') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="form-group row mb-lg-5 mb-4">
                                <x-label for="title" :value="__('trans.title')"
                                    class="col-lg-2 col-form-label font-weight-bold" />
                                <div class="col-lg-9">
                                    <x-input type="text" name="title" class="form-control" :value="old('title', $setting['title'])"
                                        id="title" required />
                                    @error('title')
                                        <small class="text text-danger font-weight-bold">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-lg-5 mb-4">
                                <x-label for="name" :value="__('trans.name')"
                                    class="col-lg-2 col-form-label font-weight-bold" />
                                <div class="col-lg-9">
                                    <x-input type="text" name="name" class="form-control" :value="old('name', $setting['name'])"
                                        id="name" required />
                                    @error('name')
                                        <small class="text text-danger font-weight-bold">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row  mb-lg-5 mb-4">
                                <x-label for="email" :value="__('trans.email')"
                                    class="col-lg-2 col-form-label font-weight-bold" />
                                <div class="col-lg-9">
                                    <x-input type="email" name="email" class="form-control" :value="old('email', $setting['email'])"
                                        id="email" required />
                                    @error('email')
                                        <small class="text text-danger font-weight-bold">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-lg-5 mb-4">
                                <x-label for="phone" :value="__('trans.phone')"
                                    class="col-lg-2 col-form-label font-weight-bold" />
                                <div class="col-lg-9">
                                    <x-input type="tel" phone="phone" class="form-control" :value="old('phone', $setting['phone'])"
                                        id="phone" required />
                                    @error('phone')
                                        <small class="text text-danger font-weight-bold">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-lg-5 mb-4">
                                <x-label for="address" :value="__('teacher.address')"
                                    class="col-lg-2 col-form-label font-weight-bold" />
                                <div class="col-lg-9">
                                    <x-input type="text" address="address" class="form-control" :value="old('address', $setting['address'])"
                                        id="address" required />
                                    @error('address')
                                        <small class="text text-danger font-weight-bold">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-lg-5 mb-4">
                                <x-label for="datepicker-action" class="col-lg-2 col-form-label font-weight-bold"
                                    :value="__('trans.end_first_term')" />
                                <div class='input-group date col-lg-9'>
                                    <input class="form-control" type="date" id="datepicker-action"
                                        name="end_first_term" data-date-format="yyyy-mm-dd" required
                                        value="{{ old('end_first_term', $setting['end_first_term']) }}">
                                </div>
                                @error('end_first_term')
                                    <small class="text text-danger font-weight-bold">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group row mb-lg-5 mb-4">
                                <x-label for="datepicker-action" class="col-lg-2 col-form-label font-weight-bold"
                                    :value="__('trans.end_second_term')" />
                                <div class='input-group date col-lg-9'>
                                    <input class="form-control" type="date" id="datepicker-action"
                                        name="end_second_term" data-date-format="yyyy-mm-dd" required
                                        value="{{ old('end_second_term', $setting['end_second_term']) }}">
                                </div>
                                @error('end_second_term')
                                    <small class="text text-danger font-weight-bold">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group row mb-lg-5 mb-4">
                                <x-label class="col-lg-2 col-form-label font-weight-bold" :value="__('trans.logo')" />
                                <div class="input-group col-lg-9">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"
                                            id="inputGroupFileAddon01">{{ __('buttons.upload') }}</span>
                                    </div>
                                    <div class="custom-file">
                                        <x-input type="file" name="logo" multiple class="custom-file"
                                            accept="image/*" id="logo" aria-describedby="inputGroupFileAddon01" />
                                        <x-label class="custom-file-label" for="logo" :value="__('msgs.select', ['name' => __('parent.attachments')])" />
                                    </div>
                                </div>
                            </div>
                            <br>

                            <hr>
                            <button class="button button-border x-small" type="submit">
                                {{ __('buttons.update') }}
                            </button>
                        </form>
                        @if (isset($setting['logo']) && !empty($setting['logo']))
                            <img src="{{ asset('attachments/logo/' . $setting['logo']) }}" alt=""
                                class="img img-thumbnail">
                        @else
                            <img src="{{ asset('assets/images/logo-icon.png') }}" width="300" alt="">
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
