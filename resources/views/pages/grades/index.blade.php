@extends('layouts.master')
@section('css')

@section('title')
    {{ __('trans.list', ['name' => __('grade.grades')]) }}
@stop

@section('breadcrum')
    {{ __('grade.grades') }}
@stop

@section('breadcrum_home')
    {{ __('trans.list', ['name' => __('grade.grades')]) }}
@stop

@endsection

@section('content')
<!-- row -->
<!-- main body -->
<div class="row">
    <div class="col-xl-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <button type="button" class="button button-border x-small mb-3" data-toggle="modal"
                    data-target="#addNewGrade">
                    {{ __('msgs.add', ['name' => __('grade.grade')]) }}
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
                                <th>{{ __('grade.name') }}</th>
                                <th>{{ __('trans.created_at') }}</th>
                                <th>{{ __('buttons.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($grades as $grade)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $grade->name }}</td>
                                    <td>{{ $grade->created_at }}</td>
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                            data-target="#editGrade{{ $grade->id }}"
                                            title="{{ __('buttons.update') }}">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                            data-target="#delete{{ $grade->id }}"
                                            title="{{ __('buttons.delete') }}">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>

                                {{-- Edit The Grade --}}
                                @include('pages.grades.edit')

                                {{-- Delete The Grade --}}
                                <x-delete-modal :id="$grade->id" :title="__('msgs.delete', ['name' => __('grade.grade')])" :action="route('grades.destroy', $grade)" />
                            @empty
                                <tr class="text-center">
                                    <td colspan="4">{{ __('msgs.not_found_yet') }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Add A New Grade --}}
    @include('pages.grades.add')
</div>

<!-- row closed -->
@endsection
@section('js')

@endsection
