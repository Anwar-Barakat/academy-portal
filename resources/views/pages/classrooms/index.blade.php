@extends('layouts.master')



@section('title')
    {{ __('trans.list', ['name' => __('classroom.classrooms')]) }}
@stop

@section('breadcrum')
    {{ __('classroom.classrooms') }}
@endsection

@section('breadcrum_home')
    {{ __('trans.list', ['name' => __('classroom.classrooms')]) }}
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

                    <div class="d-flex mb-4 flex-wrap" style="gap: 10px">
                        <button type="button" class="button button-border x-small" data-toggle="modal"
                            data-target="#exampleModal">
                            {{ __('msgs.add', ['name' => __('classroom.classroom')]) }}
                        </button>

                        <button type="button" class="btn x-small btn-danger" id="deleteAllClassroomsBtn">
                            {{ __('msgs.delete', ['name' => __('classroom.checked_classrooms')]) }}
                        </button>

                        <form action="{{ route('filter-classrooms') }}" method="POST">
                            @csrf
                            <select name="grade_id" id="" class="fancyselect" onchange="this.form.submit()"
                                required>
                                <option value="" selected disabled>{{ __('classroom.filter_using_grade') }}</option>
                                @foreach ($grades as $grade)
                                    <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                                @endforeach
                            </select>
                        </form>
                    </div>

                    <div class="table-responsive">
                        <table id="datatable"
                            class="table table-striped table-bordered text-center p-0 table-hover table-sm">
                            <thead>
                                <tr>
                                    <th>
                                        <x-input type="checkbox" class="checkbox" onclick="checkAllClassroom(this)" />
                                    </th>
                                    <th>#</th>
                                    <th>{{ __('classroom.name') }}</th>
                                    <th>{{ __('classroom.grade_name') }}</th>
                                    <th>{{ __('trans.created_at') }}</th>
                                    <th>{{ __('buttons.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>

                                @if (isset($classroomsSeached))
                                    @php
                                        $classrooms = $classroomsSeached;
                                    @endphp
                                @endif

                                @forelse ($classrooms as $classroom)
                                    <tr>
                                        <td>
                                            <x-input type="checkbox" :value="$classroom->id" class="box" />
                                        </td>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $classroom->name }}</td>
                                        <td>{{ $classroom->grades->name }}</td>
                                        <td>{{ $classroom->created_at }}</td>
                                        <td>
                                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                data-target="#editClassroom{{ $classroom->id }}"
                                                title="{{ __('buttons.update') }}">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#delete{{ $classroom->id }}"
                                                title="{{ __('buttons.delete') }}">
                                                <i class="fa fa-trash"></i>
                                            </button>

                                            {{-- Delete The Classroom --}}
                                            <x-delete-modal :id="$classroom->id" :title="__('msgs.delete', ['name' => __('classroom.classroom')])" :action="route('classrooms.destroy', $classroom)" />
                                        </td>
                                    </tr>
                                    {{-- Edit The Classroom --}}
                                    @include('pages.classrooms.edit')

                                @empty
                                    <tr class="text-center">
                                        <td colspan="6">{{ __('msgs.not_found_yet') }}</td>
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

    {{-- Add Classrooms --}}
    @include('pages.classrooms.add')

    {{-- Delete All Classrooms --}}
    <div class="modal fade" id="classroomsDeleteModal" tabindex="-1" role="dialog"
        aria-labelledby="classroomsDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="classroomsDeleteModalLabel">
                        {{ __('msgs.delete', ['name' => __('classroom.checked_classrooms')]) }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('empty-classrooms') }}" method="POST">
                    <div class="modal-body">
                        @csrf
                        <x-input type="hidden" name="classrooms_id" id="selectedClassrooms" />
                        <div class="row">
                            <div class="col">
                                <h5>{{ __('msgs.deleting_warning') }}</h5>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{ __('buttons.close') }}</button>
                        <x-button class="btn btn-danger">
                            {{ __('buttons.delete') }}
                        </x-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection

@section('js')
    {{-- Script To Toggle Checkbox Selecting --}}
    <script>
        function checkAllClassroom(el) {
            var elements = document.querySelectorAll('.box');

            if (el.checked) {
                for (let i = 0; i < elements.length; i++)
                    elements[i].checked = true
            } else {
                for (let i = 0; i < elements.length; i++)
                    elements[i].checked = false
            }
        }
    </script>


    {{-- Push The Value Of Selected Checkbox Input --}}
    <script>
        let selectedArray = new Array();
        let classroomsDeleteBtn = document.getElementById('deleteAllClassroomsBtn');

        classroomsDeleteBtn.addEventListener('click', () => {
            document.querySelectorAll('#datatable input[type=checkbox].box:checked').forEach((el) => {
                selectedArray.push(el.value);
            });

            if (selectedArray.length > 0) {
                $('#classroomsDeleteModal').modal('show')
                document.getElementById('selectedClassrooms').value = selectedArray;
            }
        })
    </script>
@endsection
