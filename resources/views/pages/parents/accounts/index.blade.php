@extends('layouts.master')

@section('title')
    {{ __('fee.fees_invoices_list') }}
@stop

@section('breadcrum')
    {{ __('fee.fees_invoices') }}@endsection

@section('breadcrum_home')
    {{ __('fee.fees_invoices_list') }}
@endsection

@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                            style="text-align: center">
                            <thead>
                                <tr>
                                    <th class="alert alert-info">#</th>
                                    <th class="alert alert-info">{{ __('fee.amount') }}</th>
                                    <th class="alert alert-success">{{ __('fee.student_name') }}</th>
                                    <th class="alert alert-success">{{ __('fee.fees_type') }}</th>
                                    <th class="alert alert-success">{{ __('grade.grade') }}</th>
                                    <th class="alert alert-success">{{ __('classroom.classroom') }}</th>
                                    <th class="alert alert-success">{{ __('fee.fee_invoice_type') }}</th>
                                    <th class="alert alert-success">{{ __('fee.been_paid') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($feesInvoices as $feeInvoice)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ number_format($feeInvoice->amount, 2) }}</td>
                                        <td>{{ $feeInvoice->student->name }}</td>
                                        <td>{{ $feeInvoice->fee->title }}</td>
                                        <td>{{ $feeInvoice->grade->name }}</td>
                                        <td>{{ $feeInvoice->classroom->name }}</td>
                                        <td>{{ $feeInvoice->description }}</td>
                                        <td>
                                            <a href="{{ route('parent.children_fees_receipt', $feeInvoice->student->id) }}"
                                                class="btn btn-info btn-sm">
                                                <i class="fas fa-dollar"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="text-center">
                                        <td colspan="7">{{ __('msgs.not_found_yet') }}</td>
                                    </tr>
                                @endforelse
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
