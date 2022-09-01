@extends('layouts.master')

@section('livewire-css')
    @livewireStyles
@endsection

@section('title')
    {{ __('trans.dashboard') }}
@endsection

@section('breadcrum')
    {{ __('trans.welcome') }} {{ Auth::guard('student')->user()->name }}
@endsection

@section('breadcrum_home')
    {{ __('trans.dashboard') }}
@endsection

@section('content')
    <div class="row">
        <div class="col mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <livewire:student-calendar />
                </div>
            </div>
        </div>
    </div>
    <!--wrapper -->
@endsection

@section('liwewire-js')
    @livewireScripts
@endsection
