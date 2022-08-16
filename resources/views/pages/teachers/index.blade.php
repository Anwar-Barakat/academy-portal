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
                                <th>{{ __('teacher.specialization') }}</th>
                                <th>{{ __('buttons.actions') }}</th>
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
                                        <a href="{{ route('teachers.edit', $teacher) }}" class="btn btn-info btn-sm"
                                            title="{{ __('buttons.update') }}">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                            data-target="#delete{{ $teacher->id }}"
                                            title="{{ __('buttons.delete') }}">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                    {{-- Delete The Teacher --}}
                                    <div class="modal fade" id="delete{{ $teacher->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="deleteLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                        id="deleteLabel">
                                                        {{ __('msgs.delete', ['name' => __('teacher.teacher')]) }}
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{ route('teachers.destroy', $teacher) }}" method="POST">
                                                    <div class="modal-body">
                                                        @csrf
                                                        @method('DELETE')
                                                        <div class="row">
                                                            <div class="col">
                                                                <h5>{{ __('msgs.deleting_warning') }}</h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">{{ __('buttons.close') }}</button>
                                                        <x-button class="btn btn-danger">
                                                            {{ __('buttons.delete') }}
                                                        </x-button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
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
