@extends('layouts.master')
@section('css')
    @livewireStyles

@section('title')
    {{ __('msgs.update', ['name' => __('trans.profile')]) }}
@stop

@endsection
@section('breadcrum')
{{ __('trans.teachers') }}
@endsection

@section('breadcrum_home')
{{ __('msgs.update', ['name' => __('trans.profile')]) }}
@endsection

@section('content')
<div class="row mb-4">
    <div class="col-lg-4">
        <div class="card mb-4">
            <div class="card-body text-center">
                <img src="{{ URL::asset('assets/images/vectors/student.png') }}" alt="avatar"
                    class="rounded-circle img-fluid" style="width: 150px;">
                <h5 class="my-3 text-center">{{ auth()->guard('student')->user()->name }}</h5>
                <p class="text-muted mb-1 text-center">{{ auth()->guard('student')->user()->email }}</p>
                <p class="text-muted mb-4 text-center">
                    {{ __('teacher.joining_data') }} : {{ auth()->guard('student')->user()->created_at }}
                </p>
                <p class="mb-4 text-center badge badge-info d-inline-block">{{ __('student.student') }}</p>
            </div>
        </div>
    </div>
    <div class="col-lg-8 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <h5 class="text-info mb-4">{{ __('msgs.update', ['name' => __('student.personal_information')]) }}</h5>
                <form action="{{ route('student.profile.update', 'test') }}" method="post" autocomplete="off" >
                    @csrf
                    @method('PUT')
                    <div class="row mb-4">
                        <div class="col-lg-3 mb-3">
                            <p class="mb-0">{{ __('student.name_ar') }}</p>
                        </div>
                        <div class="col-lg-9">
                            <p class="text-muted mb-0">
                                <input type="text" name="name_ar"
                                    value="{{ auth()->guard('student')->user()->getTranslation('name', 'ar') }}"
                                    class="form-control">
                                @error('name_ar')
                                    <small class="text text-danger font-weight-bold">{{ $message }}</small>
                                @enderror
                            </p>
                        </div>
                    </div>
                    <hr>
                    <div class="row mb-4">
                        <div class="col-lg-3 mb-3">
                            <p class="mb-0">{{ __('student.name_en') }}</p>
                        </div>
                        <div class="col-lg-9">
                            <p class="text-muted mb-0">
                                <input type="text" name="name_en"
                                    value="{{ auth()->guard('student')->user()->getTranslation('name', 'en') }}"
                                    class="form-control">
                                @error('name_en')
                                    <small class="text text-danger font-weight-bold">{{ $message }}</small>
                                @enderror
                            </p>
                        </div>
                    </div>
                    <hr>
                    <div class="row mb-4">
                        <div class="col-lg-3 mb-3">
                            <p class="mb-0">{{ __('trans.password') }}</p>
                        </div>
                        <div class="col-lg-9  mb-3">
                            <p class="text-muted mb-0">
                                <input type="password" id="password" class="form-control" name="password">
                            </p>
                            @error('password')
                                <small class="text text-danger font-weight-bold">{{ $message }}</small>
                            @enderror
                            <div class="mt-4">
                                <input type="checkbox" class="form-check-inline" onclick="myFunction()" id="show">
                                <label class="form-check-inline" for="show">
                                    {{ __('teacher.show_password') }}</label>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <button type="submit" class="button button-border x-small mb-3">
                        {{ __('buttons.update') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')

<script>
    function myFunction() {
        var x = document.getElementById("password");
        x.type === 'password' ? x.type = 'text' : x.type = 'password'
    }
</script>

@endsection
