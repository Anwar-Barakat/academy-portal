@extends('layouts.master')

@section('title')
    {{ __('trans.list', ['name' => __('trans.online_classes')]) }}
@stop

@section('breadcrum')
    {{ __('trans.online_classes') }}
@endsection

@section('breadcrum_home')
    {{ __('trans.list', ['name' => __('trans.online_classes')]) }}
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
                    <a href="{{ route('teacher.online-classess.create') }}" class="button button-border x-small mb-3">
                        {{ __('msgs.add', ['name' => __('trans.online_class')]) }}
                    </a>
                    &nbsp;
                    <a href="{{ route('indirect-classes.create') }}" class="button button x-small mb-3">
                        {{ __('msgs.add', ['name' => __('trans.new_class')]) }}
                    </a>

                    <div class="table-responsive">
                        <table id="datatable"
                            class="table table-striped table-bordered text-center p-0 table-hover table-sm">
                            <thead>
                                <tr>
                                    <th class="alert-success">#</th>
                                    <th class="alert-info">{{ __('grade.grade') }}</th>
                                    <th class="alert-info">{{ __('classroom.classroom') }}</th>
                                    <th class="alert-info">{{ __('section.section') }}</th>
                                    <th class="alert-info">{{ __('trans.created_by') }}</th>
                                    <th class="alert-success">{{ __('trans.title') }}</th>
                                    <th class="alert-success">{{ __('trans.start_at') }}</th>
                                    <th class="alert-success">{{ __('trans.duration') }}</th>
                                    <th class="alert-success">{{ __('trans.link') }}</th>
                                    <th class="alert-success">{{ __('buttons.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse ($onlineClasses as $onlineClass)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $onlineClass->grade->name }}</td>
                                        <td>{{ $onlineClass->classroom->name }}</td>
                                        <td>{{ $onlineClass->section->name }}</td>
                                        <td>{{ $onlineClass->created_by }}</td>
                                        <td>{{ $onlineClass->topic }}</td>
                                        <td>{{ $onlineClass->start_at }}</td>
                                        <td>{{ $onlineClass->duration }}</td>
                                        <td>
                                            <a class="text text-success font-weight-bold" target="_blank"
                                                href="{{ $onlineClass->start_url }}">{{ __('join') }}</a>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal"
                                                data-target="#delete{{ $onlineClass->id }}"><i
                                                    class="fas fa-trash-alt"></i></button>
                                        </td>
                                    </tr>
                                    @include('pages.teachers.online-classes.delete')
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
