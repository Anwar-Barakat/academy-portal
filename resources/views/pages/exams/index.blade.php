@extends('layouts.master')
@section('css')

@section('title')
    {{ __('trans.exams') }}
@stop
@endsection

@section('breadcrum')
{{ __('trans.exams_list') }}
@endsection

@section('breadcrum_home')
{{ __('trans.exams') }}
@endsection


@section('content')
<!-- row -->
<!-- main body -->
<div class="row">
    <div class="col-xl-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <button type="button" class="button button-border x-small mb-3" data-toggle="modal"
                    data-target="#addNewExam">
                    {{ __('msgs.add', ['name' => __('trans.exam')]) }}
                </button>
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger">{{ $error }}</div>
                    @endforeach
                @endif
                <div class="table-responsive">
                    <table id="datatable"
                        class="table table-striped table-bordered text-center p-0 table-hover table-sm">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('trans.exam_name') }}</th>
                                <th>{{ __('trans.term') }}</th>
                                <th>{{ __('trans.created_at') }}</th>
                                <th>{{ __('buttons.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($exams as $exam)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $exam->name }}</td>
                                    <td>{{ $exam->term }}</td>
                                    <td>{{ $exam->created_at }}</td>
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                            data-target="#edit{{ $exam->id }}" title="{{ __('buttons.update') }}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                            data-target="#delete{{ $exam->id }}"
                                            title="{{ __('buttons.delete') }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>

                                {{-- Edit The Exam --}}
                                @include('pages.exams.edit')

                                {{-- Delete The Exam --}}
                                @include('pages.exams.delete')
                            @empty
                                <tr class="text-center">
                                    <td colspan="5">{{ __('msgs.not_found_yet') }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Add A New Exam --}}
    @include('pages.exams.add')
</div>



<!-- row closed -->
@endsection
