@extends('layouts.master')

@section('title')
    {{ __('msgs.update', ['name' => __('fee.fee_exclusion')]) }}
@stop

@section('breadcrum')
    {{ __('fee.fee_exclusion') }}@endsection

@section('breadcrum_home')
    {{ __('msgs.update', ['name' => __('fee.fee_exclusion')]) }}
@endsection

@section('content')
    <!-- row -->
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

    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <h5 class="text text-info mb-4">
                        {{ __('fee.receipts') }}</h5>
                    <div class="table-responsive mt-15">
                        <table class="table center-aligned-table  text-center mb-0 table-hover table-sm">
                            <thead>
                                <tr class="text-dark">
                                    <th class="alert alert-info">#</th>
                                    <th class="alert alert-info">{{ __('student.name') }}</th>
                                    <th class="alert alert-info">{{ __('fee.been_paid') }}</th>
                                    <th class="alert alert-info">{{ __('trans.created_at') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($studentReceipts as $studentReceipt)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $studentReceipt->student->name }}</td>
                                        <td>{{ $studentReceipt->debit }}</td>
                                        <td>{{ $studentReceipt->created_at }}</td>
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

    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <h5 class="text text-info mb-4">
                        {{ __('fee.fee_exclusion') }}</h5>
                    <div class="table-responsive mt-15">
                        <table class="table center-aligned-table  text-center mb-0 table-hover table-sm">
                            <thead>
                                <tr class="text-dark">
                                    <th class="alert alert-info">#</th>
                                    <th class="alert alert-info">{{ __('student.name') }}</th>
                                    <th class="alert alert-info">{{ __('fee.been_paid') }}</th>
                                    <th class="alert alert-info">{{ __('trans.created_at') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($feeProcessings as $feeProcessing)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $feeProcessing->student->name }}</td>
                                        <td>{{ $feeProcessing->amount }}</td>
                                        <td>{{ $feeProcessing->created_at }}</td>
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
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <h5 class="text text-info mb-4">{{ __('student.student') }} ({{ $student->name }})</h5>
                    <form method="post" action="{{ route('fee-processings.update', $feeProcessing) }}" autocomplete="off">
                        @csrf
                        @method('PUT')
                        <x-input type="hidden" name="student_id" :value="$student->id" class="form-control" />
                        <div class="row">
                            <div class="col-md-12 col-lg-6">
                                <div class="form-group">
                                    <x-label for="amount" :value="__('fee.amount')" />
                                    <x-input type="number" id="amount" name="amount" :value="old('amount', $feeProcessing->amount)" class="form-control" />
                                    @error('amount')
                                        <small class="text text-danger font-weight-bold">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-6">
                                <div class="form-group">
                                    <x-label for="student_funds" :value="__('fee.student_funds')" />
                                    <select id="student_funds" class="form-control">
                                        <option value="{{ number_format($student->studentAccounts->sum('debit') - $student->studentAccounts->sum('credit')) }}" selected aria-readonly="" disabled>
                                            {{ number_format($student->studentAccounts->sum('debit') - $student->studentAccounts->sum('credit')) }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <x-label for="description" :value="__('fee.report')" />
                                    <textarea class="form-control" name="description" id="description" rows="3">{{ old('description', $feeProcessing->description) }}</textarea>
                                    @error('description')
                                        <small class="text text-danger font-weight-bold">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <hr>
                        <button class="button button-border x-small mb-3" type="submit">
                            {{ __('buttons.update') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
