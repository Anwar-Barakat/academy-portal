@extends('layouts.master')

@section('title')
    {{ __('fee.payments_list') }}
@stop

@section('breadcrum')
    {{ __('fee.payments') }}@endsection

@section('breadcrum_home')
    {{ __('fee.payments_list') }}
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
                                @foreach ($studentPayments as $studentPayment)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $studentPayment->student->name }}</td>
                                        <td>{{ number_format($studentPayment->amount, 2) }}</td>
                                        <td>{{ $studentPayment->description }}</td>
                                        <td>
                                            <a href="{{ route('student-payments.edit', $studentPayment) }}"
                                                class="btn btn-outline-info btn-sm" role="button" aria-pressed="true"><i
                                                    class="fas fa-edit"></i></a>
                                            <button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal"
                                                data-target="#delete{{ $studentPayment->id }}"><i
                                                    class="fas fa-trash-alt"></i></button>
                                        </td>
                                    </tr>
                                    <x-delete-modal :id="$studentPayment->id" :title="__('msgs.delete', ['name' => __('fee.payment')])" :action="route('student-payments.destroy', $studentPayment)" />
                                @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
