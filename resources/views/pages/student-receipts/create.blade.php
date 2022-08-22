@extends('layouts.master')

@section('title')
    {{ __('msgs.add', ['name' => __('fee.receipt')]) }}
@stop

@section('breadcrum')
    {{ __('fee.receipts') }}@endsection

@section('breadcrum_home')
    {{ __('msgs.add', ['name' => __('fee.receipt')]) }}
@endsection

@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
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
                    <h5 class="text text-info mb-4">{{ __('student.student') }} ({{ $student->name }})</h5>
                    <form method="post" action="{{ route('student-receipts.store') }}" autocomplete="off">
                        @csrf
                        <x-input type="hidden" name="student_id" :value="$student->id" />
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <x-label for="debit" :value="__('fee.amount')" />
                                    <x-input type="number" id="debit" name="debit" :value="old('debit')"
                                        class="form-control" />
                                    @error('debit')
                                        <small class="text text-danger font-weight-bold">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <x-label for="description" :value="__('fee.report')" />
                                    <textarea class="form-control" name="description" id="description" rows="3">{{ old('description') }}</textarea>
                                    @error('description')
                                        <small class="text text-danger font-weight-bold">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <hr>
                        <button class="button button-border x-small mb-3" type="submit">
                            {{ __('buttons.submit') }}
                        </button>
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
