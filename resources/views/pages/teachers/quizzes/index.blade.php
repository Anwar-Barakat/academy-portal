@extends('layouts.master')

@section('title')
    {{ __('trans.list', ['name' => __('trans.quizzes')]) }}
@stop

@section('breadcrum')
    {{ __('trans.quizzes') }}
@endsection

@section('breadcrum_home')
    {{ __('trans.list', ['name' => __('trans.quizzes')]) }}
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
                    <a href="{{ route('teacher.quizzes.create') }}" class="button button-border x-small mb-3">
                        {{ __('msgs.add', ['name' => __('trans.quiz')]) }}
                    </a>

                    <div class="table-responsive">
                        <table id="datatable" class="table table-striped table-bordered text-center p-0 table-hover table-sm">
                            <thead>
                                <tr>
                                    <th class="alert-info">#</th>
                                    <th class="alert-info">{{ __('trans.quiz_name') }}</th>
                                    <th class="alert-info">{{ __('trans.subject') }}</th>
                                    <th class="alert-success">{{ __('grade.grade') }}</th>
                                    <th class="alert-success">{{ __('classroom.classroom') }}</th>
                                    <th class="alert-success">{{ __('section.section') }}</th>
                                    <th class="alert-success">{{ __('teacher.name') }}</th>
                                    <th class="alert-info">{{ __('trans.created_at') }}</th>
                                    <th class="alert-info">{{ __('buttons.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse ($quizzes as $quiz)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $quiz->name }}</td>
                                        <td>{{ $quiz->subject->name }}</td>
                                        <td>{{ $quiz->grade->name }}</td>
                                        <td>{{ $quiz->classroom->name }}</td>
                                        <td>{{ $quiz->section->name }}</td>
                                        <td>{{ $quiz->teacher->name }}</td>
                                        <td>{{ $quiz->created_at }}</td>
                                        <td class="d-flex align-items-center justify-content-between flex-wrap"
                                            style="gap: 1rem">
                                            <div>
                                                <a href="{{ route('teacher.quizzes.edit', $quiz) }}"
                                                    class="btn btn-outline-info btn-sm" role="button"
                                                    title="{{ __('msgs.add', ['name' => __('trans.quiz')]) }}"
                                                    aria-pressed="true"><i class="fas fa-edit"></i></a>
                                                <button type="button" class="btn btn-outline-danger btn-sm"
                                                    data-toggle="modal" data-target="#delete{{ $quiz->id }}"><i
                                                        class="fas fa-trash-alt"></i></button>
                                            </div>
                                            <div>
                                                <a href="{{ route('teacher.quizzes.show', $quiz) }}"
                                                    class="btn btn-outline-warning btn-sm" role="button"
                                                    title="{{ __('trans.list', ['name' => __('trans.questions')]) }}"
                                                    aria-pressed="true"><i class="fas fa-question"></i></a>
                                            </div>
                                            <div>
                                                <a href="{{ route('teacher.students_was_examed', $quiz->id) }}"
                                                    class="btn btn-outline-secondary btn-sm" role="button"
                                                    title="{{ __('trans.list', ['name' => __('msgs.finished', ['name' => __('trans.quiz')])]) }}"
                                                    aria-pressed="true"><i class="fas fa-user-graduate"></i></a>
                                            </div>
                                        </td>

                                        @include('pages.teachers.quizzes.delete')
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
    <!-- row closed -->
@endsection
