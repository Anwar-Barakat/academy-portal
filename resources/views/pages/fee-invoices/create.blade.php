@extends('layouts.master')

@section('title')
    {{ __('msgs.add', ['name' => __('fee.student_invoice')]) }}
@stop

@section('breadcrum')
    {{ __('fee.fees_invoices') }}@endsection

@section('breadcrum_home')
    {{ __('msgs.add', ['name' => __('fee.student_invoice')]) }}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <h5 class="text text-info mb-4">
                        {{ __('fee.student_fees_invoices') }}</h5>
                    <div class="table-responsive mt-15">
                        <table class="table center-aligned-table  text-center mb-0 table-hover table-sm">
                            <thead>
                                <tr class="text-dark">
                                    <th class="alert alert-info">#</th>
                                    <th class="alert alert-info">{{ __('student.name') }}</th>
                                    <th class="alert alert-info">{{ __('fee.fees_type') }}</th>
                                    <th class="alert alert-info">{{ __('fee.amount') }}</th>
                                    <th class="alert alert-info">{{ __('trans.created_at') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($studentFeeInvoices as $feeInvoice)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $feeInvoice->student->name }}</td>
                                        <td>{{ $feeInvoice->fee->type }}</td>
                                        <td>{{ $feeInvoice->amount }}</td>
                                        <td>{{ $feeInvoice->created_at }}</td>
                                    </tr>
                                @empty
                                    <tr class="text-center">
                                        <td colspan="5">
                                            {{ __('msgs.not_found_yet') }}
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <h5 class="text text-info">
                        {{ __('msgs.add', ['name' => __('fee.fees_invoices')]) }}</h5>
                    <form class=" row mb-30" action="{{ route('fee-invoices.store') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 col-lg-4 mb-2 d-flex flex-column">
                                    <x-label for="student_id" class="mr-sm-2" :value="__('fee.student_name')" />
                                    <select class="form-control" name="student_id">
                                        <option value="{{ $student->id }}" selected aria-readonly="">
                                            {{ $student->name }}</option>
                                    </select>
                                    @error('student_id')
                                        <small class="text text-danger font-weight-bold">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-md-12 col-lg-4 mb-2 d-flex flex-column">
                                    <x-label for="fee_id" class="mr-sm-2" :value="__('fee.fees_type')" />
                                    <select class="fancyselect" name="fee_id" required>
                                        <option disabled value="" selected>
                                            {{ __('msgs.select', ['name' => '...']) }}</option>
                                        @foreach ($fees as $fee)
                                            <option value="{{ $fee->id }}">{{ __('fee.' . $fee->type) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('fee_id')
                                        <small class="text text-danger font-weight-bold">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-md-12 col-lg-4 mb-2">
                                    <x-label for="amount" class="mr-sm-2" :value="__('fee.amount')" />
                                    <div class="box">
                                        <select aria-readonly="" class="form-control" name="amount"
                                            id="amount"></select>
                                        @error('amount')
                                            <small class="text text-danger font-weight-bold">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <input type="hidden" name="grade_id" value="{{ $student->grade_id }}">
                                <input type="hidden" name="classroom_id" value="{{ $student->classroom_id }}">
                            </div>
                            <hr>
                            <button type="submit"
                                class="button button-border x-small mb-3">{{ __('buttons.submit') }}</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection


@section('js')
    <script src="{{ asset('assets/js/custom/get-fee-amount.js') }}"></script>
@stop
