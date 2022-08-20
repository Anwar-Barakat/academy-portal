@extends('layouts.master')



@section('title')
    {{ __('trans.graduations_list') }}
@stop

@section('breadcrum')
    {{ __('trans.graduations_students') }}@endsection

@section('breadcrum_home')
    {{ __('trans.graduations_list') }}
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

                                @forelse ($graduatedStudents as $student)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $student->name }}</td>
                                        <td>{{ $student->grade->name }}</td>
                                        <td>{{ $student->classroom->name }}</td>
                                        <td>{{ $student->section->name }}</td>
                                        <td>{{ $student->created_at }}</td>
                                        <td class="students-promotions-buttons">
                                            <button type="button" class="btn btn-outline-info btn-sm" data-toggle="modal"
                                                data-target="#returnStudent{{ $student->id }}">{{ __('msgs.returned') }}
                                            </button>
                                            <button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal"
                                                data-target="#deleteStudent{{ $student->id }}">{{ __('buttons.delete') }}
                                            </button>
                                        </td>


                                        {{-- Return The Student --}}
                                        <div class="modal fade" id="returnStudent{{ $student->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                            id="deleteGradeLabel">
                                                            {{ __('msgs.has_returned', ['name' => __('student.student')]) }}
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{ route('students-graduations.update', 'test') }}"
                                                        method="POST">
                                                        <div class="modal-body">
                                                            @csrf
                                                            @method('PUT')
                                                            <x-input type="hidden" name="id" :value="$student->id" />
                                                            <div class="row">
                                                                <div class="col">
                                                                    <h5>{{ __('msgs.return_student_warning') }}</h5>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">{{ __('buttons.close') }}</button>
                                                            <x-button class="btn btn-info">
                                                                {{ __('msgs.returned') }}
                                                            </x-button>
                                                        </div>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>

                                        {{-- Delete The Student --}}
                                        <div class="modal fade" id="deleteStudent{{ $student->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                            id="deleteGradeLabel">
                                                            {{ __('msgs.has_returned', ['name' => __('student.student')]) }}
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{ route('students-graduations.destroy', 'test') }}"
                                                        method="POST">
                                                        <div class="modal-body">
                                                            @csrf
                                                            @method('DELETE')
                                                            <x-input type="hidden" name="id" :value="$student->id" />
                                                            <div class="row">
                                                                <div class="col">
                                                                    <h5>{{ __('msgs.return_student_warning') }}</h5>
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
