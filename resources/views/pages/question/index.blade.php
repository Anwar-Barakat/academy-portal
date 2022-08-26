@extends('layouts.master')

@section('title')
    {{ __('trans.questions_list') }}
@stop

@section('breadcrum')
    {{ __('trans.questions') }}
@endsection

@section('breadcrum_home')
    {{ __('trans.questions_list') }}
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
                    <a href="{{ route('questions.create') }}" class="button button-border x-small mb-3">
                        {{ __('msgs.add', ['name' => __('trans.quiz')]) }}
                    </a>

                    <div class="table-responsive">
                        <table id="datatable" class="table table-striped table-bordered text-center p-0 table-hover table-sm">
                            <thead>
                                <tr>
                                    <th class="alert-info">#</th>
                                    <th class="alert-info">{{ __('trans.question') }}</th>
                                    <th class="alert-success">{{ __('trans.quiz_name') }}</th>
                                    <th class="alert-success">{{ __('trans.subject') }}</th>
                                    <th class="alert-success">{{ __('grade.grade') }}</th>
                                    <th class="alert-success">{{ __('classroom.classroom') }}</th>
                                    <th class="alert-success">{{ __('section.section') }}</th>
                                    <th class="alert-success">{{ __('teacher.name') }}</th>
                                    <th class="alert-info">{{ __('trans.created_at') }}</th>
                                    <th class="alert-info">{{ __('buttons.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse ($questions as $question)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $question->title }}</td>
                                        <td>{{ $question->quiz->name }}</td>
                                        <td>{{ $question->quiz->subject->name }}</td>
                                        <td>{{ $question->quiz->grade->name }}</td>
                                        <td>{{ $question->quiz->classroom->name }}</td>
                                        <td>{{ $question->quiz->section->name }}</td>
                                        <td>{{ $question->quiz->teacher->name }}</td>
                                        <td>{{ $question->created_at }}</td>
                                        <td>
                                            <a href="{{ route('quizzes.edit', $question) }}"
                                                class="btn btn-outline-info btn-sm" role="button" aria-pressed="true"><i
                                                    class="fas fa-edit"></i></a>
                                            <button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal"
                                                data-target="#delete{{ $question->id }}"><i
                                                    class="fas fa-trash-alt"></i></button>
                                        </td>

                                        {{-- @include('pages.quizzes.delete') --}}
                                    </tr>
                                @empty
                                    <tr class="text-center">
                                        <td colspan="10">{{ __('msgs.not_found_yet') }}</td>
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
