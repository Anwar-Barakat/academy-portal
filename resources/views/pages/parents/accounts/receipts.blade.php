@extends('layouts.master')

@section('title')
    {{ __('fee.receipts_list') }}
@stop

@section('breadcrum')
    {{ __('fee.receipts') }}@endsection

@section('breadcrum_home')
    {{ __('fee.receipts_list') }}
@endsection

@section('content')
    <!-- row -->
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
                    <div class="table-responsive">
                        <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                            style="text-align: center">
                            <thead>
                                <tr>
                                    <th class=" alert alert-info">#</th>
                                    <th class=" alert alert-info">{{ __('fee.amount') }}</th>
                                    <th class=" alert alert-success">{{ __('fee.student_name') }}</th>
                                    <th class=" alert alert-success">{{ __('fee.report') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($studentReceipts as $studentReceipt)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $studentReceipt->student->name }}</td>
                                        <td>{{ number_format($studentReceipt->debit, 2) }}</td>
                                        <td>{{ $studentReceipt->description }}</td>
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
