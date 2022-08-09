@extends('layouts.master')

@section('title')
    {{ __('classroom.classrooms') }}
@stop


@section('page-header')
    <!-- breadcrumb -->
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0"> {{ __('classroom.classrooms_list') }}</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"
                            class="default-color">{{ __('grade.home') }}</a></li>
                    <li class="breadcrumb-item active">{{ __('classroom.classrooms') }}</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
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

                    <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
                        {{ __('classroom.add_class') }}
                    </button>
                    <br><br>

                    <div class="table-responsive">
                        <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                            style="text-align: center">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('classroom.name') }}</th>
                                    <th>{{ __('classroom.grade_name') }}</th>
                                    <th>{{ __('trans.created_at') }}</th>
                                    <th>{{ __('buttons.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($classrooms as $classroom)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $classroom->name }}</td>
                                        <td>{{ $classroom->grades->name }}</td>
                                        <td>{{ $classroom->created_at }}</td>
                                        <td>
                                            asdasd
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="text-center">
                                        <td colspan="5">{{ __('msgs.not_found_yet') }}</td>
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

    <!-- Add A New Classroom -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                        {{ __('classroom.add_class') }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="row" action="{{ route('classrooms.store') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="repeater">
                                <div data-repeater-list="classrooms_list">
                                    <div data-repeater-item>
                                        <div class="row">
                                            <div class="col">
                                                <x-label for="name_ar" class="mr-sm-2" :value="__('classroom.name_ar')" />
                                                <x-input type="text" id="name_ar" class="form-control" name="name_ar"
                                                    :value="old('name_ar')" required autofocus />

                                            </div>
                                            <div class="col">
                                                <x-label for="name_en" class="mr-sm-2" :value="__('classroom.name_en')" />
                                                <x-input type="text" id="name_en" class="form-control" name="name_en"
                                                    :value="old('name_en')" required autofocus />
                                            </div>
                                            <div class="col">
                                                <x-label for="grade_id" class="mr-sm-2" :value="__('classroom.grade_name')" />

                                                <div class="box">
                                                    <select class="fancyselect" name="grade_id">
                                                        @foreach ($grades as $grade)
                                                            <option value="{{ $grade->id }}">{{ $grade->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <x-label for="actions" class="mr-sm-2" :value="__('buttons.actions')" />
                                                <x-input type="text" class="btn btn-danger btn-block"
                                                    data-repeater-delete type="button" :value="__('classroom.delete_row')" autofocus />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-20">
                                    <div class="col-12">
                                        <x-input type="text" class="btn btn-success btn-block w-25 mb-2"
                                            data-repeater-create type="button" :value="__('classroom.add_row')" autofocus />
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-dismiss="modal">{{ __('buttons.close') }}</button>
                                    <button type="submit" class="btn btn-success">{{ __('buttons.submit') }}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
