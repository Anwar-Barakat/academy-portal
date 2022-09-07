@extends('layouts.master')
@section('css')
    @livewireStyles

@section('title')
    {{ __('trans.list', ['name' => __('teacher.teachers')]) }}
@stop

@endsection
@section('breadcrum')
{{ __('trans.teachers') }}
@endsection

@section('breadcrum_home')
{{ __('trans.list', ['name' => __('teacher.teachers')]) }}
@endsection

@section('content')
<div class="row">
    <div class="col-xl-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <a href="{{ route('teachers.create') }}" type="button"class="button button-border x-small mb-3">
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
                                <th class="alert-info">#</th>
                                <th class="alert-info">{{ __('teacher.name') }}</th>
                                <th class="alert-info">{{ __('teacher.gender') }}</th>
                                <th class="alert-info">{{ __('teacher.joining_data') }}</th>
                                <th class="alert-success">{{ __('teacher.specialization') }}</th>
                                <th class="alert-info">{{ __('buttons.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($teachers as $teacher)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $teacher->name }}</td>
                                    <td>{{ __('trans.' . $teacher->gender) }}</td>
                                    <td>{{ $teacher->joining }}</td>
                                    <td>{{ $teacher->specialization->name }}</td>
                                    <td>
                                        <a href="{{ route('teachers.edit', $teacher) }}"
                                            class="btn btn-outline-info btn-sm" title="{{ __('buttons.update') }}">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal"
                                            data-target="#delete{{ $teacher->id }}"
                                            title="{{ __('buttons.delete') }}">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </td>
                                    {{-- Delete The Teacher --}}
                                    <x-delete-modal :id="$teacher->id" :title="__('msgs.delete', ['name' => __('teacher.teacher')])" :action="route('teachers.destroy', $teacher)" />
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
