@extends('layouts.master')

@section('title')
    {{ __('trans.list', ['name' => __('section.sections')]) }}
@stop

@section('breadcrum')
    {{ __('section.sections_list') }}@endsection

@section('breadcrum_home')
    {{ __('trans.list', ['name' => __('section.sections')]) }}
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

                    <div class="table-responsive">
                        <table id="datatable" class="table table-striped table-bordered text-center p-0 table-hover table-sm">
                            <thead>
                                <tr>
                                    <th class="alert-success">#</th>
                                    <th class="alert-success">{{ __('section.section') }}</th>
                                    <th class="alert-info">{{ __('student.students') }}</th>
                                    <th class="alert-info">{{ __('classroom.classroom') }}</th>
                                    <th class="alert-info">{{ __('grade.grade') }}</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse ($sections as $section)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $section->name }}</td>
                                        <td>
                                            {{ App\Models\Student::where(['grade_id' => $section->grade->id, 'classroom_id' => $section->classroom->id, 'section_id' => $section->id])->count() }}
                                        </td>
                                        <td>{{ $section->classroom->name }}</td>
                                        <td>{{ $section->grade->name }}</td>
                                    </tr>
                                @empty
                                    <tr class="text-center">
                                        <td colspan="5">
                                            {{ __('msgs.not_found_yet') }}
                                        </td>
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
