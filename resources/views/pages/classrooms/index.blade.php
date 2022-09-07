@extends('layouts.master')



@section('title')
    {{ __('trans.list', ['name' => __('classroom.classrooms')]) }}
@stop

@section('breadcrum')
    {{ __('classroom.classrooms') }}
@endsection

@section('breadcrum_home')
    {{ __('trans.list', ['name' => __('classroom.classrooms')]) }}
@endsection

@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-xl-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="d-flex mb-4 flex-wrap" style="gap: 10px">
                        <button type="button" class="button button-border x-small" data-toggle="modal"
                            data-target="#exampleModal">
                            {{ __('msgs.add', ['name' => __('classroom.classroom')]) }}
                        </button>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table id="datatable"
                            class="table table-striped table-bordered text-center p-0 table-hover table-sm">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('classroom.name') }}</th>
                                    <th>{{ __('classroom.grade_name') }}</th>
                                    <th>{{ __('trans.created_at') }}</th>
                                    <th>{{ __('buttons.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($classrooms as $classroom)
                                    <tr id="classroomID{{ $classroom->id }}">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $classroom->name }}</td>
                                        <td>{{ $classroom->grades->name }}</td>
                                        <td>{{ $classroom->created_at }}</td>
                                        <td>
                                            <button type="button" class="btn btn-outline-info btn-sm" data-toggle="modal"
                                                data-target="#edit{{ $classroom->id }}"
                                                title="{{ __('buttons.update') }}">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal"
                                                data-target="#delete{{ $classroom->id }}"
                                                title="{{ __('buttons.delete') }}">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>

                                            {{-- Delete The Classroom --}}
                                            <x-delete-modal :id="$classroom->id" :title="__('msgs.delete', ['name' => __('classroom.classroom')])" :action="route('classrooms.destroy', $classroom)" />
                                        </td>
                                    </tr>
                                    {{-- Edit The Classroom --}}
                                    @include('pages.classrooms.edit')

                                @empty
                                    <tr class="text-center">
                                        <td colspan="6">{{ __('msgs.not_found_yet') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->

    {{-- Add Classrooms --}}
    @include('pages.classrooms.add')
@endsection

@section('js')

@endsection
