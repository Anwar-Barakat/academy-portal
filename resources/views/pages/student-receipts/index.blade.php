@extends('layouts.master')

@section('title')
    {{ __('trans.list', ['name' => __('fee.receipts')]) }}
@stop

@section('breadcrum')
    {{ __('fee.receipts') }}@endsection

@section('breadcrum_home')
    {{ __('trans.list', ['name' => __('fee.receipts')]) }}
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
                                <tr class="alert-success">
                                    <th>#</th>
                                    <th>{{ __('fee.student_name') }}</th>
                                    <th>{{ __('fee.amount') }}</th>
                                    <th>{{ __('fee.report') }}</th>
                                    <th>{{ __('buttons.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($studentReceipts as $studentReceipt)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $studentReceipt->student->name }}</td>
                                        <td>{{ number_format($studentReceipt->debit, 2) }}</td>
                                        <td>{{ $studentReceipt->description }}</td>
                                        <td>
                                            <a href="{{ route('student-receipts.edit', $studentReceipt) }}"
                                                class="btn btn-outline-info btn-sm" role="button" aria-pressed="true"><i
                                                    class="fas fa-edit"></i></a>
                                            <button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal"
                                                data-target="#delete{{ $studentReceipt->id }}"><i
                                                    class="fas fa-trash-alt"></i></button>
                                        </td>
                                    </tr>
                                    <x-delete-modal :id="$studentReceipt->id" :title="__('msgs.delete', ['name' => __('fee.receipt')])" :action="route('student-receipts.destroy', $studentReceipt)" />
                                @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
