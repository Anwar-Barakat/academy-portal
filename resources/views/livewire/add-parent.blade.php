@extends('layouts.master')
@section('css')

@section('title')
    {{ __('parent.parents') }}
@stop
@endsection


@section('breadcrum')
{{ __('parent.parents') }}
@endsection

@section('breadcrum_home')
{{ __('msgs.add', ['name' => __('parent.parent')]) }}
@endsection


@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">

            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection
