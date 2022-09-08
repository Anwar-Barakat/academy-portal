@extends('layouts.master')

@section('title')
    {{ __('msgs.update', ['name' => __('fee.student_invoice')]) }}
@stop

@section('breadcrum')
    {{ __('fee.fees_invoices') }}@endsection

@section('breadcrum_home')
    {{ __('msgs.update', ['name' => __('fee.student_invoice')]) }}
@endsection

@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <form class=" row mb-30" action="{{ route('fee-invoices.update', $feeInvoice) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="repeater">
                                <div class="row">
                                    <div class="col-md-12 col-lg-6 mb-2">
                                        <x-label for="student_id" class="mr-sm-2" :value="__('fee.student_name')" />
                                        <select class="fancyselect" id="student_id">
                                            <option value="" selected aria-readonly="">
                                                {{ $feeInvoice->student->name }}</option>
                                        </select>
                                    </div>

                                    <div class="col-md-12 col-lg-6 mb-2">
                                        <x-label for="fee_id" class="mr-sm-2" :value="__('fee.fees_type')" />
                                        <div class="box">
                                            <select class="fancyselect" name="fee_id" required>
                                                <option disabled value="" selected>
                                                    {{ __('msgs.select', ['name' => '...']) }}</option>
                                                @foreach ($fees as $fee)
                                                    <option value="{{ $fee->id }}"
                                                        {{ $feeInvoice->fee_id == $fee->id ? 'selected' : '' }}>
                                                        {{ $fee->title }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>

                                    <div class="col-md-12 col-lg-6 mb-2">
                                        <x-label for="amount" class="mr-sm-2" :value="__('fee.amount')" />
                                        <div class="box">
                                            <select class="fancyselect" name="amount" required>
                                                <option disabled value="" selected>
                                                    {{ __('msgs.select', ['name' => '...']) }}</option>
                                                @foreach ($fees as $fee)
                                                    <option value="{{ $fee->amount }}"
                                                        {{ $feeInvoice->amount == $fee->amount ? 'selected' : '' }}>
                                                        {{ $fee->amount }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <x-input :value="$feeInvoice->id" name="id" type="hidden" />
                                </div>
                                <hr>
                                <button type="submit"
                                    class="button button-border x-small mb-3">{{ __('buttons.update') }}</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection

@section('js')
    <script src="{{ asset('assets/js/custom/get-fee-amount.js') }}"></script>
@stop
