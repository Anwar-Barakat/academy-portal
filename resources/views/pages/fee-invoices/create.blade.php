@extends('layouts.master')

@section('title')
    {{ __('msgs.add', ['name' => __('fee.student_invoice')]) }}
@stop

@section('breadcrum')
    {{ __('fee.fees_invoices') }}@endsection

@section('breadcrum_home')
    {{ __('msgs.add', ['name' => __('fee.student_invoice')]) }}
@endsection

@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 col-lg-6 mb-2-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form class=" row mb-30" action="{{ route('fee-invoices.store') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="repeater">
                                <div data-repeater-list="List_Fees">
                                    <div data-repeater-item>
                                        <div class="row">

                                            <div class="col-md-12 col-lg-6 mb-2">
                                                <x-label for="student_id" class="mr-sm-2" :value="__('fee.student_name')" />
                                                <select class="fancyselect" name="student_id" required>
                                                    <option value="{{ $student->id }}">{{ $student->name }}</option>
                                                </select>
                                            </div>

                                            <div class="col-md-12 col-lg-6 mb-2">
                                                <x-label for="fee_id" class="mr-sm-2" :value="__('fee.fees_type')" />
                                                <div class="box">
                                                    <select class="fancyselect" name="fee_id" required>
                                                        <option disabled value="" selected>
                                                            {{ __('msgs.select', ['name' => '...']) }}</option>
                                                        @foreach ($fees as $fee)
                                                            <option value="{{ $fee->id }}">{{ $fee->title }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                            </div>

                                            <div class="col-md-12 col-lg-6 mb-2">
                                                <x-label for="amount" class="mr-sm-2" :value="__('fee.amount')" />
                                                <div class="box">
                                                    <select class="fancyselect" name="amount" required>
                                                        <option disabled value="" selected>
                                                            {{ __('msgs.select', ['name' => '...']) }}</option>
                                                        @foreach ($fees as $fee)
                                                            <option value="{{ $fee->amount }}">{{ $fee->amount }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-12 col-lg-6 mb-2">
                                                <x-label for="description" class="mr-sm-2" :value="__('fee.report')" />
                                                <div class="box">
                                                    <input type="text" class="form-control" name="description"
                                                        max="20" required>
                                                </div>
                                            </div>

                                            <div class="col-md-12 col-lg-6 mb-2">
                                                <label for="Name_en" class="mr-sm-2">{{ __('buttons.actions') }}:</label>
                                                <input class="btn btn-danger btn-block" data-repeater-delete type="button"
                                                    value="{{ __('msgs.delete', ['name' => __('classroom.row')]) }}" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-20">
                                    <div class="col-md-12 col-lg-6 mb-2-12">
                                        <input class="button x-small mb-3" data-repeater-create type="button"
                                            value="{{ __('msgs.add', ['name' => __('classroom.row')]) }}" />
                                    </div>
                                </div><br>
                                <hr>
                                <input type="hidden" name="grade_id" value="{{ $student->grade_id }}">
                                <input type="hidden" name="classroom_id" value="{{ $student->classroom_id }}">
                                <button type="submit"
                                    class="button button-border x-small mb-3">{{ __('buttons.submit') }}</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
@section('js')
    @toastr_js
    @toastr_render

@endsection
