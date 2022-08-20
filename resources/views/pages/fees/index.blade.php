@extends('layouts.master')

@section('title')
    {{ __('trans.fees_list') }}
@stop

@section('breadcrum')
    {{ __('fee.fees') }}
@endsection

@section('breadcrum_home')
    {{ __('trans.fees_list') }}
@endsection

@section('content')
    <!-- row -->
    <div class="row">

        <div class="col-xl-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <a href="{{ route('fees.create') }}" class="button button-border x-small" role="button"
                        aria-pressed="true">{{ __('msgs.add', ['name' => __('fee.fee')]) }}</a><br><br>
                    <div class="table-responsive">
                        <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                            style="text-align: center">
                            <thead>
                                <tr class="alert-success">
                                    <th>#</th>
                                    <th>{{ __('trans.name') }}</th>
                                    <th>{{ __('fee.amount') }}</th>
                                    <th>{{ __('grade.grade') }}</th>
                                    <th>{{ __('classroom.classroom') }}</th>
                                    <th>{{ __('student.academic_year') }}</th>
                                    <th>{{ __('buttons.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($fees as $fee)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $fee->title }}</td>
                                        <td>{{ number_format($fee->amount, 2) }}</td>
                                        <td>{{ $fee->grade->name }}</td>
                                        <td>{{ $fee->classroom->name }}</td>
                                        <td>{{ $fee->year }}</td>
                                        <td>
                                            <a href="{{ route('fees.edit', $fee) }}" class="btn btn-info btn-sm"
                                                role="button" aria-pressed="true"><i class="fa fa-edit"></i></a>
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#delete{{ $fee->id }}"
                                                title="{{ __('buttons.delete') }}"><i class="fa fa-trash"></i></button>
                                            <a href="#" class="btn btn-warning btn-sm" role="button"
                                                aria-pressed="true"><i class="far fa-eye"></i></a>
                                        </td>
                                    </tr>
                                    @include('pages.fees.delete')
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
