@extends('layouts.master')

@section('title')
    {{ __('section.sections_list') }}
@stop

@section('breadcrum')
    {{ __('section.sections_list') }}
@endsection

@section('breadcrum_home')
    {{ __('section.sections') }}
@endsection

@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <a class="button x-small" href="#" data-toggle="modal" data-target="#addNewSection">
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
                                                                class="table center-aligned-table mb-0 table-hover table-sm">
                                                                <thead>
                                                                    <tr class="text-dark">
                                                                        <th>#</th>
                                                                        <th>{{ __('section.name') }}
                                                                        </th>
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
                                                                            <td class="d-flex" style="gap: 5px">
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
                                                                        {{-- Edit The Section --}}
                                                                        <div class="modal fade"
                                                                            id="edit{{ $section->id }}" tabindex="-1"
                                                                            role="dialog" aria-labelledby="editSection"
                                                                            aria-hidden="true">
                                                                            <div class="modal-dialog" role="document">
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header">
                                                                                        <h5 class="modal-title"
                                                                                            style="font-family: 'Cairo', sans-serif;"
                                                                                            id="editSection">
                                                                                            {{ __('msgs.update', ['name' => __('section.section')]) }}
                                                                                        </h5>
                                                                                        <button type="button"
                                                                                            class="close"
                                                                                            data-dismiss="modal"
                                                                                            aria-label="Close">
                                                                                            <span
                                                                                                aria-hidden="true">&times;</span>
                                                                                        </button>
                                                                                    </div>
                                                                                    <form
                                                                                        action="{{ route('sections.update', $section) }}"
                                                                                        method="POST">
                                                                                        <div class="modal-body">
                                                                                            @method('PUT')
                                                                                            @csrf
                                                                                            <div class="row">
                                                                                                <div class="col">
                                                                                                    <x-input type="text"
                                                                                                        name="name_ar"
                                                                                                        class="form-control"
                                                                                                        :value="old(
                                                                                                            'name_ar',
                                                                                                            $section->getTranslation(
                                                                                                                'name',
                                                                                                                'ar',
                                                                                                            ),
                                                                                                        )"
                                                                                                        placeholder="{{ __('section.name_ar') }}" />
                                                                                                </div>

                                                                                                <div class="col">
                                                                                                    <x-input type="text"
                                                                                                        name="name_en"
                                                                                                        class="form-control"
                                                                                                        :value="old(
                                                                                                            'name_en',
                                                                                                            $section->getTranslation(
                                                                                                                'name',
                                                                                                                'en',
                                                                                                            ),
                                                                                                        )"
                                                                                                        placeholder="{{ __('section.name_en') }}" />
                                                                                                </div>
                                                                                            </div>
                                                                                            <br>
                                                                                            <div class="col">
                                                                                                <x-label :value="__(
                                                                                                    'section.grade_name',
                                                                                                )"
                                                                                                    for="grade_id"
                                                                                                    class="control-label" />
                                                                                                <select name="grade_id"
                                                                                                    class="custom-select">
                                                                                                    <option
                                                                                                        value="{{ $grade->id }}">
                                                                                                        {{ $grade->name }}
                                                                                                    </option>
                                                                                                    @foreach ($grades as $grade)
                                                                                                        <option
                                                                                                            value="{{ $grade->id }}">
                                                                                                            {{ $grade->name }}
                                                                                                        </option>
                                                                                                    @endforeach
                                                                                                </select>
                                                                                            </div>
                                                                                            <br>

                                                                                            <div class="col">
                                                                                                <x-label :value="__(
                                                                                                    'section.classrrom_name',
                                                                                                )"
                                                                                                    for="classrrom_id"
                                                                                                    class="control-label" />
                                                                                                <select name="classroom_id"
                                                                                                    class="custom-select">
                                                                                                    <option
                                                                                                        value="{{ $section->classroom->id }}">
                                                                                                        {{ $section->classroom->name }}
                                                                                                    </option>
                                                                                                </select>
                                                                                            </div>
                                                                                            <br>

                                                                                            <div class="col">
                                                                                                <div class="form-check">
                                                                                                    @if ($section->status === 1)
                                                                                                        <x-input
                                                                                                            type="checkbox"
                                                                                                            checked
                                                                                                            class="form-check-input"
                                                                                                            name="status"
                                                                                                            :value="1"
                                                                                                            id="status" />
                                                                                                    @else
                                                                                                        <x-input
                                                                                                            type="checkbox"
                                                                                                            class="form-check-input"
                                                                                                            name="status"
                                                                                                            :value="0"
                                                                                                            id="status" />
                                                                                                    @endif
                                                                                                    <x-label
                                                                                                        :value="__(
                                                                                                            'section.status',
                                                                                                        )"
                                                                                                        for="status"
                                                                                                        class="control-label" />
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="modal-footer">
                                                                                            <button type="button"
                                                                                                class="btn btn-secondary"
                                                                                                data-dismiss="modal">{{ __('buttons.close') }}</button>
                                                                                            <x-button
                                                                                                class="btn btn-success">
                                                                                                {{ __('buttons.submit') }}
                                                                                            </x-button>
                                                                                        </div>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        {{-- Delete The Section --}}
                                                                        <div class="modal fade"
                                                                            id="delete{{ $section->id }}" tabindex="-1"
                                                                            role="dialog"
                                                                            aria-labelledby="exampleModalLabel"
                                                                            aria-hidden="true">
                                                                            <div class="modal-dialog" role="document">
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header">
                                                                                        <h5 style="font-family: 'Cairo', sans-serif;"
                                                                                            class="modal-title"
                                                                                            id="deleteGradeLabel">
                                                                                            {{ __('msgs.delete', ['name' => __('section.section')]) }}
                                                                                        </h5>
                                                                                        <button type="button"
                                                                                            class="close"
                                                                                            data-dismiss="modal"
                                                                                            aria-label="Close">
                                                                                            <span
                                                                                                aria-hidden="true">&times;</span>
                                                                                        </button>
                                                                                    </div>
                                                                                    <form
                                                                                        action="{{ route('sections.destroy', $section) }}"
                                                                                        method="POST">
                                                                                        <div class="modal-body">
                                                                                            @csrf
                                                                                            @method('DELETE')
                                                                                            <div class="row">
                                                                                                <div class="col">
                                                                                                    <h5>{{ __('msgs.deleting_warning') }}
                                                                                                    </h5>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="modal-footer">
                                                                                            <button type="button"
                                                                                                class="btn btn-secondary"
                                                                                                data-dismiss="modal">{{ __('buttons.close') }}</button>
                                                                                            <x-button
                                                                                                class="btn btn-danger">
                                                                                                {{ __('buttons.delete') }}
                                                                                            </x-button>
                                                                                        </div>
                                                                                    </form>

                                                                                </div>
                                                                            </div>
                                                                        </div>
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
                <div class="modal fade" id="addNewSection" tabindex="-1" role="dialog"
                    aria-labelledby="addNewSectionLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" style="font-family: 'Cairo', sans-serif;"
                                    id="addNewSectionLabel">
                                    {{ __('msgs.add', ['name' => __('section.section')]) }}
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('sections.store') }}" method="POST">
                                <div class="modal-body">
                                    @csrf
                                    <div class="row">
                                        <div class="col">
                                            <x-input type="text" :value="old('name_ar')" id="name_ar" name="name_ar"
                                                class="form-control" placeholder="{{ __('section.name_ar') }}" required
                                                autofocus />
                                        </div>

                                        <div class="col">
                                            <x-input type="text" :value="old('name_en')" id="name_en" name="name_en"
                                                class="form-control" placeholder="{{ __('section.name_en') }}" required
                                                autofocus />
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col d-flex flex-column">
                                            <x-label for="grade_id" :value="__('section.grade_name')" />
                                            <select name="grade_id" class="fancyselect" id="grade_id">
                                                <option value="" selected disabled>
                                                    {{ __('msgs.select', ['name' => __('section.grade_name')]) }}
                                                </option>
                                                @foreach ($grades as $grade)
                                                    <option value="{{ $grade->id }}"> {{ $grade->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col d-flex flex-column">
                                            <x-label for="classroom_id" :value="__('section.classrrom_name')" />
                                            <select name="classroom_id" id="get-classrooms" class="form-control">
                                                <option value=""></option>
                                            </select>
                                        </div>
                                    </div>
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
        </div>
    </div>
    <!-- row closed -->
@endsection


@section('js')



    <script>
        $(document).ready(function() {
            $('select[name=grade_id]').on('change', function() {
                var grade_id = $(this).val()
                if (grade_id) {
                    $.ajax({
                        url: "{{ URL::to('get-classrooms') }}/" + grade_id,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('select[name=classroom_id]').empty();
                            $.each(data, function(key, value) {
                                console.log(key);
                                console.log(value);
                                $('select[name=classroom_id]').append(
                                    '<option value="' + key + '">' + value +
                                    '</option>');
                            });
                        },
                    });
                }
            })
        })
    </script>
@stop
