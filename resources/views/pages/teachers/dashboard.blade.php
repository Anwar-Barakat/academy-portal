@extends('layouts.master')


@section('title')
    {{ __('trans.dashboard') }}
@endsection

@section('breadcrum')
    {{ __('trans.dashboard') }}
@endsection

@section('breadcrum_home')
    {{ __('trans.dashboard') }}
@endsection

@section('content')
    <div class="page-title pt-2 pb-2">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0">{{ __('trans.welcome') }} {{ Auth::guard('teacher')->user()->name }}</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="{{ route('teacher.dashboard') }}"
                            class="default-color">{{ __('grade.home') }}</a></li>
                    <li class="breadcrumb-item active">{{ __('trans.dashboard') }}</li>
                </ol>
            </div>
        </div>
    </div>
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


    <!--wrapper -->
@endsection
