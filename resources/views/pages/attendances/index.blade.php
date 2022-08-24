@extends('layouts.master')

@section('title')
    {{ __('trans.attendances_list') }}
@stop

@section('breadcrum')
    {{ __('trans.attendances') }}
@endsection

@section('breadcrum_home')
    {{ __('trans.attendances_list') }}
@endsection

@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="accordion gray plus-icon round">
                        @foreach ($grades as $grade)
                            <div class="acd-group">
                                <a href="javascript:void(0)" class="acd-heading">{{ $grade->name }}</a>
                                <div class="acd-des">
                                    <div class="row">
                                        <div class="col-xl-12 mb-30">
                                            <div class="card card-statistics h-100">
                                                <div class="card-body">
                                                    <div class="d-block d-md-flex justify-content-between">
                                                        <div class="d-block">
                                                        </div>
                                                    </div>
                                                    <div class="table-responsive mt-15">
                                                        <table
                                                            class="table center-aligned-table text-center mb-0 table-hover table-sm">
                                                            <thead>
                                                                <tr class="text-dark">
                                                                    <th>#</th>
                                                                    <th>{{ __('section.name') }}</th>
                                                                    <th>{{ __('section.classrrom_name') }}</th>
                                                                    <th>{{ __('section.status') }}</th>
                                                                    <th>{{ __('buttons.actions') }}</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @forelse ($grade->sections as $section)
                                                                    <tr>
                                                                        <td>{{ $loop->iteration }}</td>
                                                                        <td>{{ $section->name }}</td>
                                                                        <td>{{ $section->classroom->name }}
                                                                        </td>
                                                                        <td>
                                                                            @if ($section->status === 1)
                                                                                <label
                                                                                    class="badge badge-success">{{ __('buttons.active') }}</label>
                                                                            @else
                                                                                <label
                                                                                    class="badge badge-danger">{{ __('buttons.disactive') }}</label>
                                                                            @endif
                                                                        </td>
                                                                        <td class="d-flex justify-content-center"
                                                                            style="gap: 5px">
                                                                            <a href="{{ route('add_attendances', $section->id) }}"
                                                                                class="btn btn-outline-info btn-sm">{{ __('student.students_list') }}</a>
                                                                        </td>
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
                                </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
