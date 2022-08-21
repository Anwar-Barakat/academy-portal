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
                    <div class="col-xl-12 mb-30">
                        <div class="card card-statistics h-100">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                        data-page-length="50" style="text-align: center">
                                        <thead>
                                            <tr class="alert-success">
                                                <th>#</th>
                                                <th>الاسم</th>
                                                <th>نوع الرسوم</th>
                                                <th>المبلغ</th>
                                                <th>المرحلة الدراسية</th>
                                                <th>الصف الدراسي</th>
                                                <th>البيان</th>
                                                <th>العمليات</th>
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
                                                        <a href="#" class="btn btn-outline-info btn-sm" role="button"
                                                            aria-pressed="true"><i class="fas fa-edit"></i></a>
                                                        <button type="button" class="btn btn-outline-danger btn-sm"
                                                            data-toggle="modal" data-target="#"><i
                                                                class="fas fa-trash-alt"></i></button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
