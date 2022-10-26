@extends('layouts.master')

@section('title')
    {{ __('trans.list', ['name' => __('trans.books')]) }}
@stop

@section('breadcrum')
    {{ __('trans.library') }}
@endsection

@section('breadcrum_home')
    {{ __('trans.list', ['name' => __('trans.books')]) }}
@endsection

@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-xl-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable" class="table table-striped table-bordered text-center p-0 table-hover table-sm">
                            <thead>
                                <tr>
                                    <th class="alert-success">#</th>
                                    <th class="alert-success">{{ __('trans.title') }}</th>
                                    <th class="alert-info">{{ __('grade.grade') }}</th>
                                    <th class="alert-info">{{ __('classroom.classroom') }}</th>
                                    <th class="alert-info">{{ __('section.section') }}</th>
                                    <th class="alert-info">{{ __('teacher.teacher') }}</th>
                                    <th class="alert-success">{{ __('buttons.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse ($books as $book)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $book->title }}</td>
                                        <td>{{ $book->grade->name }}</td>
                                        <td>{{ $book->classroom->name }}</td>
                                        <td>{{ $book->section->name }}</td>
                                        <td>{{ $book->teacher->name }}</td>
                                        <td>
                                            <a href="{{ route('student.download_book_attachment', [$book->file_name, $book->teacher->id]) }}"
                                                class="btn btn-outline-dark btn-sm" title="{{ __('buttons.download') }}">
                                                <i class="fas fa-download"></i>
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
