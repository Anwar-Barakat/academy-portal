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
                @if (!empty($successMessage))
                    <div class="alert alert-success" id="success-alert">
                        <button type="button" class="close" data-dismiss="alert">x</button>
                        {{ $successMessage }}
                    </div>
                @endif

                <div class="stepwizard">
                    <div class="stepwizard-row setup-panel">
                        <div class="stepwizard-step">
                            <a href="#step-1" type="button"
                                class="btn btn-circle {{ $currentStep != 1 ? 'btn-dark' : 'btn-success' }}">1</a>
                            <p>{{ __('parent.step1') }}</p>
                        </div>
                        <div class="stepwizard-step">
                            <a href="#step-2" type="button"
                                class="btn btn-circle {{ $currentStep != 2 ? 'btn-dark' : 'btn-success' }}">2</a>
                            <p>{{ __('parent.step2') }}</p>
                        </div>
                        <div class="stepwizard-step">
                            <a href="#step-3" type="button"
                                class="btn btn-circle {{ $currentStep != 3 ? 'btn-dark' : 'btn-success' }}"
                                disabled="disabled">3</a>
                            <p>{{ __('parent.step3') }}</p>
                        </div>
                    </div>
                </div>

                @include('livewire.father-form')

                @include('livewire.mother-form')
            </div>
        </div>
    </div>
</div>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection
