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
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger">{{ $error }}</div>
                        @endforeach
                    @endif
                    <a href="{{ route('teacher.library.create') }}" class="button button-border x-small mb-3">
                        {{ __('msgs.add', ['name' => __('trans.book')]) }}
                    </a>
                    <div class="table-responsive">
                        <table id="datatable" class="table table-striped table-bordered text-center p-0 table-hover table-sm">
                            <thead>
                                <tr>
                                    <th class="alert-success">#</th>
                                    <th class="alert-success">{{ __('trans.title') }}</th>
                                    <th class="alert-info">{{ __('grade.grade') }}</th>
                                    <th class="alert-info">{{ __('classroom.classroom') }}</th>
                                    <th class="alert-info">{{ __('section.section') }}</th>
                                    <th class="alert-success">{{ __('buttons.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse ($library as $book)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $book->title }}</td>
                                        <td>{{ $book->grade->name }}</td>
                                        <td>{{ $book->classroom->name }}</td>
                                        <td>{{ $book->section->name }}</td>
                                        <td>
                                            <a href="{{ route('teacher.library.edit', $book) }}"
                                                class="btn btn-outline-success btn-sm" title="{{ __('buttons.update') }}">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="{{ route('teacher.download_book_attachment', $book->file_name) }}"
                                                class="btn btn-outline-dark btn-sm" title="{{ __('buttons.download') }}">
                                                <i class="fas fa-download"></i>
                                            </a>
                                            <button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal"
                                                data-target="#delete{{ $book->id }}"
                                                title="{{ __('buttons.delete') }}">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </td>

                                        {{-- delete fee processing --}}
                                        <x-delete-modal :id="$book->id" :title="__('msgs.delete', ['name' => __('trans.book')])" :action="route('teacher.library.destroy', $book)" />
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
