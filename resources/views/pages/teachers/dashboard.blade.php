@extends('layouts.master')

@section('livewire-css')
    @livewireStyles
@endsection

@section('title')
    {{ __('trans.dashboard') }}
@endsection

@section('breadcrum')
    {{ __('trans.welcome') }} {{ Auth::guard('teacher')->user()->name }}
@endsection

@section('breadcrum_home')
    {{ __('trans.dashboard') }}
@endsection

@section('content')
    <!-- widgets -->
    <div class="row">
        <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-left">
                            <span class="text-success">
                                <i class="fas fa-th-large highlight-icon" aria-hidden="true"></i>
                            </span>
                        </div>
                        <div class="float-right text-right">
                            <p class="card-text text-dark">{{ __('section.sections') }}</p>
                            <h4>{{ $sectionsCount }}</h4>
                        </div>
                    </div>
                    <p class="text-muted pt-3 mb-0 mt-2 border-top">
                        <a href="{{ route('teacher.sections.index') }}" target="_blank">
                            <i class="fa fa-exclamation-circle mr-1" aria-hidden="true"></i>
                            {{ __('trans.show_data') }}
                        </a>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-left">
                            <span class="text-info">
                                <i class="fas fa-user-graduate highlight-icon" aria-hidden="true"></i>
                            </span>
                        </div>
                        <div class="float-right text-right">
                            <p class="card-text text-dark">{{ __('student.students') }}</p>
                            <h4>{{ $studentsCount }}</h4>
                        </div>
                    </div>
                    <p class="text-muted pt-3 mb-0 mt-2 border-top">
                        <a href="{{ route('teacher.students.index') }}" target="_blank">
                            <i class="fa fa-exclamation-circle mr-1" aria-hidden="true"></i>
                            {{ __('trans.show_data') }}
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <livewire:calendar />
                </div>
            </div>
        </div>
    </div>


    <!--wrapper -->
@endsection

@section('liwewire-js')
    @livewireScripts
@endsection
