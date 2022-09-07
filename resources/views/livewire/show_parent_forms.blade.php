@extends('layouts.master')
@section('css')
    @livewireStyles

@section('title')
    {{ __('trans.list', ['name' => __('parent.parents')]) }}
@stop

@section('breadcrum')
    {{ __('trans.parents') }}
@endsection

@section('breadcrum_home')
    {{ __('trans.list', ['name' => __('parent.parents')]) }}
@stop
@endsection

@section('content')
<div class="row">
    <div class="col-xl-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <livewire:add-parent />
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')

@livewireScripts
@endsection
