@extends('layouts.master')

@section('title')
    {{ __('trans.quizzes_list') }}
@stop

@section('breadcrum')
    {{ __('msgs.add', ['name' => __('trans.quiz')]) }}
@endsection

@section('breadcrum_home')
    {{ __('trans.quizzes_list') }}
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
                    <a href="{{ route('quizzes.create') }}" class="button button-border x-small mb-3">
                        {{ __('msgs.add', ['name' => __('trans.quiz')]) }}
                    </a>

                    <div class="table-responsive">
                        <table id="datatable" class="table table-striped table-bordered text-center p-0 table-hover table-sm">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('trans.quiz_name') }}</th>
                                    <th>{{ __('trans.subject') }}</th>
                                    <th>{{ __('grade.grade') }}</th>
                                    <th>{{ __('classroom.classroom') }}</th>
                                    <th>{{ __('section.section') }}</th>
                                    <th>{{ __('teacher.name_en') }}</th>
                                    <th>{{ __('trans.created_at') }}</th>
                                    <th>{{ __('buttons.actions') }}</th>
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
                                        <td>
                                            <a href="{{ route('quizzes.edit', $quiz) }}"
                                                class="btn btn-outline-info btn-sm" role="button" aria-pressed="true"><i
                                                    class="fas fa-edit"></i></a>
                                            <button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal"
                                                data-target="#delete{{ $quiz->id }}"><i
                                                    class="fas fa-trash-alt"></i></button>
                                        </td>

                                        @include('pages.quizzes.delete')
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
