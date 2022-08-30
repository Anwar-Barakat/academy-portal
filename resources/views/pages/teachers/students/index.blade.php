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
                                    <th class="alert-info">#</th>
                                    <th class="alert-info">{{ __('student.name') }}</th>
                                    <th class="alert-success">{{ __('grade.grade') }}</th>
                                    <th class="alert-success">{{ __('classroom.classroom') }}</th>
                                    <th class="alert-success">{{ __('section.section') }}</th>
                                    <th class="alert-info">{{ __('trans.created_at') }}</th>
                                    <th class="alert-info">{{ __('buttons.actions') }}</th>
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

                                                    <a class="dropdown-item" title="{{ __('buttons.show') }}"
                                                        href="{{ route('students.show', $student) }}">
                                                        <i class="fas fa-eye text-warning"></i>
                                                        {{ __('buttons.show') }}
                                                    </a>
                                                </div>
                                            </div>
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
