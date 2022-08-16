@extends('layouts.master')
@section('css')
    @livewireStyles

@section('title')
    {{ __('trans.teachers_list') }}
@stop

@endsection
@section('breadcrum')
{{ __('trans.teachers_list') }}
@endsection

@section('breadcrum_home')
{{ __('trans.teachers') }}
@endsection

@section('content')
<div class="row">
    <div class="col-xl-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <a href="{{ route('teachers.create') }}" type="button" class="button x-small mb-3">
                    {{ __('msgs.add', ['name' => __('teacher.teacher')]) }}
                </a>
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger">{{ $error }}</div>
                    @endforeach
                @endif
                <div class="table-responsive">
                    <table id="datatable"
                        class="table table-striped table-bordered p-0 table-hover table-sm text-center">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('teacher.name') }}</th>
                                <th>{{ __('teacher.gender') }}</th>
                                <th>{{ __('teacher.joining_data') }}</th>
                                <th>{{ __('teacher.specilization') }}</th>
                                <th>{{ __('buttons.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($teachers as $teacher)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $teacher->email }}</td>
                                    <td>{{ $teacher->father_name }}</td>
                                    <td>{{ $teacher->father_identification }}</td>
                                    <td>{{ $teacher->father_passport }}</td>
                                    <td>{{ $teacher->father_phone }}</td>
                                    <td>{{ $teacher->created_at }}</td>
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm"
                                            title="{{ __('buttons.update') }}">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm"
                                            title="{{ __('buttons.delete') }}">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr class="text-center">
                                    <td colspan="8">{{ __('msgs.not_found_yet') }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
@livewireScripts

@endsection
