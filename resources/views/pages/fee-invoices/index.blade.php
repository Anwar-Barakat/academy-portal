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
                    <a href="{{ route('fee-invoices.create') }}" class="button button-border x-small">
                        {{ __('msgs.add', ['name' => __('fee.fees_invoices')]) }}
                    </a>
                    <br><br>
                    <div class="table-responsive">
                        <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                            style="text-align: center">
                            <thead>
                                <tr class="alert-success">
                                    <th>#</th>
                                    <th>{{ __('fee.student_name') }}</th>
                                    <th>{{ __('fee.fees_type') }}</th>
                                    <th>{{ __('fee.amount') }}</th>
                                    <th>{{ __('grade.grade') }}</th>
                                    <th>{{ __('classroom.classroom') }}</th>
                                    <th>{{ __('fee.fee_invoice_type') }}</th>
                                    <th>{{ __('buttons.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($feeInvoices as $feeInvoice)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $feeInvoice->student->name }}</td>
                                        <td>{{ $feeInvoice->fee->title }}</td>
                                        <td>{{ number_format($feeInvoice->amount, 2) }}</td>
                                        <td>{{ $feeInvoice->grade->name }}</td>
                                        <td>{{ $feeInvoice->classroom->name }}</td>
                                        <td>{{ $feeInvoice->description }}</td>
                                        <td>
                                            <a href="{{ route('fee-invoices.edit', $feeInvoice) }}"
                                                class="btn btn-outline-info btn-sm" role="button" aria-pressed="true"><i
                                                    class="fas fa-edit"></i></a>
                                            <button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal"
                                                data-target="#delete{{ $feeInvoice->id }}"><i
                                                    class="fas fa-trash-alt"></i></button>
                                        </td>

                                        @include('pages.fee-invoices.delete')
                                    </tr>
                                @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
