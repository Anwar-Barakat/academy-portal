@extends('layouts.master')

@section('title')
    {{ __('trans.list', ['name' => __('student.students')]) }}
@stop

@section('breadcrum')
    {{ __('student.students') }}@endsection

@section('breadcrum_home')
    {{ __('trans.list', ['name' => __('student.students')]) }}
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
                    <a href="{{ route('students.create') }}" class="button button-border x-small mb-3">
                        {{ __('msgs.add', ['name' => __('student.student')]) }}
                    </a>

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

                                @forelse ($children as $child)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $child->name }}</td>
                                        <td>{{ $child->grade->name }}</td>
                                        <td>{{ $child->classroom->name }}</td>
                                        <td>{{ $child->section->name }}</td>
                                        <td>{{ $child->created_at }}</td>
                                        <td>
                                            <a title="{{ __('teacher.results') }}" class="btn btn-info btn-sm"
                                                href="{{ route('parent.child_result', $child->id) }}">
                                                <i class="fas fa-chart-bar"></i>
                                            </a>
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
