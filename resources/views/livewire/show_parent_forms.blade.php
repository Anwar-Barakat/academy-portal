@extends('layouts.master')
@section('css')
    @livewireStyles

@section('title')
    {{ __('msgs.add', ['name' => __('parent.parent')]) }}
@stop

@endsection
@section('breadcrum')
{{ __('trans.parents_list') }}
@endsection

@section('breadcrum_home')
{{ __('msgs.add', ['name' => __('parent.parent')]) }}
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
