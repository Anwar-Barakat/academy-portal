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
                                @foreach ($studentReceipts as $studentReceipts)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $studentReceipts->student->name }}</td>
                                        <td>{{ number_format($studentReceipts->debit, 2) }}</td>
                                        <td>{{ $studentReceipts->description }}</td>
                                        <td>
                                            <a href="{{ route('student-receipts.edit', $studentReceipts) }}"
                                                class="btn btn-outline-info btn-sm" role="button" aria-pressed="true"><i
                                                    class="fas fa-edit"></i></a>
                                            <button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal"
                                                data-target="#delete{{ $studentReceipts }}"><i
                                                    class="fas fa-trash-alt"></i></button>
                                        </td>
                                    </tr>
                                    {{-- @include('pages.Receipt.Delete') --}}
                                @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
