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
                <li class="breadcrumb-item active">Page Title</li>
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
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered p-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('grade.name_ar') }}</th>
                                <th>{{ __('grade.name_en') }}</th>
                                <th>{{ __('grade.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($grades as $grade)
                            @empty
                                <tr class="text-center">
                                    <td colspan="4">{{ __('not_found_yet!') }}</td>
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
@section('js')

@endsection
