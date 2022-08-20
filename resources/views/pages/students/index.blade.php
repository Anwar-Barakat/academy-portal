@extends('layouts.master')



@section('title')
    {{ __('student.students_list') }}
@stop

@section('breadcrum')
    {{ __('student.students') }}@endsection

@section('breadcrum_home')
    {{ __('student.students_list') }}
@endsection

@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-xl-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger">{{ $error }}</div>
                        @endforeach
                    @endif

                    <div class="table-responsive">
                        <table id="datatable" class="table table-striped table-bordered text-center p-0 table-hover table-sm">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('student.name') }}</th>
                                    <th>{{ __('grade.grade') }}</th>
                                    <th>{{ __('classroom.classroom') }}</th>
                                    <th>{{ __('section.section') }}</th>
                                    <th>{{ __('trans.created_at') }}</th>
                                    <th>{{ __('buttons.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse ($students as $student)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $student->name }}</td>
                                        <td>{{ $student->grade->name }}</td>
                                        <td>{{ $student->classroom->name }}</td>
                                        <td>{{ $student->section->name }}</td>
                                        <td>{{ $student->created_at }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-secondary dropdown-toggle" type="button"
                                                    id="triggerId" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    <i class="fas fa-list-alt"></i>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="triggerId">
                                                    <a class="dropdown-item" title="{{ __('buttons.update') }}"
                                                        href="{{ route('students.edit', $student) }}">
                                                        <i class="fas fa-edit text-success"></i>
                                                        {{ __('buttons.update') }}
                                                    </a>
                                                    <button type="button" class="btn btn-danger btn-sm dropdown-item"
                                                        data-toggle="modal" data-target="#delete{{ $student->id }}"
                                                        title="{{ __('buttons.delete') }}">
                                                        <i class="fas fa-trash text-danger fa-lg"></i>
                                                        {{ __('buttons.delete') }}
                                                    </button>
                                                    <a class="dropdown-item" title="{{ __('buttons.show') }}"
                                                        href="{{ route('students.show', $student) }}">
                                                        <i class="fas fa-eye text-warning"></i>
                                                        {{ __('buttons.show') }}
                                                    </a>
                                                </div>
                                            </div>


                                            {{-- Delete The Classroom
                                            <div class="modal fade" id="delete{{ $student->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 style="font-family: 'Cairo', sans-serif;"
                                                                class="modal-title" id="deleteGradeLabel">
                                                                {{ __('msgs.delete', ['name' => __('classroom.classroom')]) }}
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="{{ route('students.destroy', $student) }}"
                                                            method="POST">
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
                                            </div> --}}
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="text-center">
                                        <td colspan="7">{{ __('msgs.not_found_yet') }}</td>
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
@endsection
