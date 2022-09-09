@extends('layouts.master')

@section('title')
    {{ __('trans.subjects_list') }}
@stop

@section('breadcrum')
    {{ __('trans.subjects') }}@endsection

@section('breadcrum_home')
    {{ __('trans.subjects_list') }}
@endsection

@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-xl-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <a href="{{ route('subjects.create') }}" class="button button-border x-small mb-3">
                        {{ __('msgs.add', ['name' => __('trans.subject')]) }}
                    </a>
                    <div class="table-responsive">
                        <table id="datatable" class="table table-striped table-bordered text-center p-0 table-hover table-sm">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('trans.subject') }}</th>
                                    <th>{{ __('grade.grade') }}</th>
                                    <th>{{ __('classroom.classroom') }}</th>
                                    <th>{{ __('teacher.name') }}</th>
                                    <th>{{ __('trans.created_at') }}</th>
                                    <th>{{ __('buttons.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse ($subjects as $subject)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $subject->name }}</td>
                                        <td>{{ $subject->grade->name }}</td>
                                        <td>{{ $subject->classroom->name }}</td>
                                        <td>{{ $subject->teacher->name }}</td>
                                        <td>{{ $subject->created_at }}</td>
                                        <td>
                                            <a href="{{ route('subjects.edit', $subject) }}"
                                                class="btn btn-outline-info btn-sm" role="button" aria-pressed="true"><i
                                                    class="fas fa-edit"></i></a>
                                            <button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal"
                                                data-target="#delete{{ $subject->id }}"><i
                                                    class="fas fa-trash-alt"></i></button>
                                        </td>
                                        {{-- Deleted The Subject --}}
                                        <x-delete-modal :id="$subject->id" :title="__('msgs.delete', ['name' => __('trans.subject')])" :action="route('subjects.destroy', $subject)" />

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
