@extends('layouts.master')
@section('css')

@section('title')
    {{ __('grade.grades') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{ __('grade.grades_list') }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"
                        class="default-color">{{ __('grade.home') }}</a></li>
                <li class="breadcrumb-item active">{{ __('grade.grades') }}</li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<!-- main body -->
<div class="row">
    <div class="col-xl-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <button type="button" class="button x-small mb-3" data-toggle="modal" data-target="#addNewGrade">
                    {{ __('grade.add_grade') }}
                </button>
                @if ($errors->any())
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered p-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('grade.name_ar') }}</th>
                                <th>{{ __('grade.name_en') }}</th>
                                <th>{{ __('trans.created_at') }}</th>
                                <th>{{ __('grade.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($grades as $grade)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $grade->getTranslation('name', 'ar') }}</td>
                                    <td>{{ $grade->getTranslation('name', 'en') }}</td>
                                    <td>{{ $grade->created_at }}</td>
                                    <td>

                                    </td>
                                </tr>
                            @empty
                                <tr class="text-center">
                                    <td colspan="4">{{ __('msgs.not_found_yet') }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addNewGrade" tabindex="-1" role="dialog" aria-labelledby="addNewGradeLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="addNewGradeLabel">
                        {{ __('grade.add_grade') }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('grades.store') }}" method="POST">
                    <div class="modal-body">
                        <!-- add_form -->
                        @csrf
                        <div class="row">
                            <div class="col">
                                <x-label for="name_ar" :value="__('grade.name_ar')" /> :
                                <x-input type="text" name="name_ar" id="name_ar" class="form-control"
                                    :value="old('name_ar')" required autofocus />

                            </div>
                            <div class="col">
                                <x-label for="name_en" :value="__('grade.name_en')" />
                                <x-input type="text" name="name_en" class="form-control" id="name_en"
                                    :value="old('name_en')" required />
                            </div>
                        </div>
                        <br>

                        <div class="form-group">
                            <x-label for="notes" :value="__('grade.notes')" />
                            <textarea class="form-control" name="notes" id="notes" rows="3"></textarea>
                        </div>
                        <br>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{ __('buttons.close') }}</button>
                        <x-button class="btn btn-success">
                            {{ __('buttons.submit') }}
                        </x-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>



<!-- row closed -->
@endsection
@section('js')

@endsection
