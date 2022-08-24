@extends('layouts.master')

@section('title')
    {{ __('msgs.add', ['name' => __('trans.attendances')]) }}
@stop

@section('breadcrum')
    {{ __('trans.attendances') }}@endsection

@section('breadcrum_home')
    {{ __('msgs.add', ['name' => __('trans.attendances')]) }}
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
                    <h5 class="mb-4 text-info">
                        {{ __('trans.today_data') }} :
                        {{ date('Y-m-d') }}
                    </h5>
                    <div class="table-responsive">
                        <form action="{{ route('attendances.store') }}" method="POST">
                            @csrf
                            <table id="datatable"
                                class="table table-striped table-bordered text-center p-0 table-hover table-sm">
                                <thead>
                                    <tr>
                                        <th class="alert alert-info">#</th>
                                        <th class="alert alert-info">{{ __('fee.student_name') }}</th>
                                        <th class="alert alert-info">{{ __('grade.grade') }}</th>
                                        <th class="alert alert-info">{{ __('classroom.classroom') }}</th>
                                        <th class="alert alert-info">{{ __('section.section') }}</th>
                                        <th class="alert alert-info">{{ __('trans.created_at') }}</th>
                                        <th class="alert alert-info">{{ __('buttons.actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($students as $student)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $student->name }}</td>
                                            <td>{{ $student->grade->name }}</td>
                                            <td>{{ $student->classroom->name }}</td>
                                            <td>{{ $student->section->name }}</td>
                                            <td>{{ $student->created_at }}</td>
                                            <td>
                                                @if (!empty(
                                                    $student->attendances()->where('created_at', date('Y-m-d'))->first()->student_id
                                                ) &&
                                                    isset(
                                                        $student->attendances()->where('created_at', date('Y-m-d'))->first()->student_id))
                                                    <div class="d-flex justify-content-around">
                                                        <div>
                                                            <label class="block text-gray-500 font-semibold">
                                                                <input name="attendences[{{ $student->id }}]" disabled
                                                                    {{ $student->attendances()->first()->status == 1 ? 'checked' : '' }}
                                                                    class="leading-tight" type="radio" value="presence">
                                                                <span class="text-success">حضور</span>
                                                            </label>
                                                        </div>

                                                        <div>
                                                            <label class="ml-4 block text-gray-500 font-semibold">
                                                                <input name="attendences[{{ $student->id }}]" disabled
                                                                    {{ $student->attendances()->first()->status == 0 ? 'checked' : '' }}
                                                                    class="leading-tight" type="radio" value="absent">
                                                                <span class="text-danger">غياب</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="d-flex justify-content-around">
                                                        <div>
                                                            <label class="block text-gray-500 font-semibold">
                                                                <input name="attendences[{{ $student->id }}]"
                                                                    class="leading-tight" type="radio" value="presence">
                                                                <span class="text-success">حضور</span>
                                                            </label>
                                                        </div>
                                                        <div>
                                                            <label class="ml-4 block text-gray-500 font-semibold">
                                                                <input name="attendences[{{ $student->id }}]"
                                                                    class="leading-tight" type="radio" value="absent">
                                                                <span class="text-danger">غياب</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                @endif

                                                <input type="hidden" name="student_id[]" value="{{ $student->id }}">
                                                <input type="hidden" name="grade_id" value="{{ $student->grade_id }}">
                                                <input type="hidden" name="classroom_id"
                                                    value="{{ $student->classroom_id }}">
                                                <input type="hidden" name="section_id" value="{{ $student->section_id }}">
                                            </td>
                                        </tr>
                                    @empty
                                        <tr class="text-center">
                                            <td colspan="7">{{ __('msgs.not_found_yet') }}</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <hr>
                            <button class="button button-border x-small mb-3" type="submit">
                                {{ __('buttons.submit') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
