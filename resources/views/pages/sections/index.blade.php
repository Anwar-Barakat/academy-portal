@extends('layouts.master')

@section('title')
    {{ __('trans.list', ['name' => __('section.sections')]) }}
@stop

@section('breadcrum')
    {{ __('section.sections') }}
@endsection

@section('breadcrum_home')
    {{ __('trans.list', ['name' => __('section.sections')]) }}
@endsection

@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <a class="button button-border x-small mb-3" href="#" data-toggle="modal"
                        data-target="#addNewSection">
                        {{ __('msgs.add', ['name' => __('section.section')]) }}
                    </a>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif


                <div class="card card-statistics h-100">
                    <div class="card-body">
                        <div class="accordion gray plus-icon round">
                            @foreach ($grades as $grade)
                                <div class="acd-group">
                                    <a href="#" class="acd-heading">{{ $grade->name }}</a>
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
                                                                        <th>{{ __('section.name') }}
                                                                        </th>
                                                                        <th>{{ __('student.students') }}</th>
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
                                                                            <td>
                                                                                {{ App\Models\Student::where(['grade_id' => $grade->id, 'classroom_id' => $section->classroom->id, 'section_id' => $section->id])->count() }}
                                                                            </td>
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
                                                                                <a href="#"
                                                                                    class="btn btn-outline-info btn-sm"
                                                                                    data-toggle="modal"
                                                                                    data-target="#edit{{ $section->id }}">{{ __('buttons.update') }}</a>
                                                                                <a href="#"
                                                                                    class="btn btn-outline-danger btn-sm"
                                                                                    data-toggle="modal"
                                                                                    data-target="#delete{{ $section->id }}">{{ __('buttons.delete') }}</a>
                                                                            </td>
                                                                        </tr>

                                                                        @include('pages.sections.edit')

                                                                        {{-- Delete the section --}}
                                                                        <x-delete-modal :id="$section->id" :title="__('msgs.delete', [
                                                                            'name' => __('section.section'),
                                                                        ])"
                                                                            :action="route(
                                                                                'sections.destroy',
                                                                                $section,
                                                                            )" />

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
                {{-- Add A new Section --}}
                @include('pages.sections.add')
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection


@section('ajax-scripts')
    <script src="{{ asset('assets/js/custom/get-classtooms.js') }}"></script>
@endsection
