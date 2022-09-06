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

                        <button type="button" class="button dangerous-button x-small" id="deleteAllClassroomsBtn"
                            data-toggle="modal" data-target="#deleteAllClassrooms">
                            {{ __('msgs.delete', ['name' => __('classroom.checked_classrooms')]) }}
                        </button>
                    </div>

                    <div class="table-responsive">
                        <table id="datatable"
                            class="table table-striped table-bordered text-center p-0 table-hover table-sm">
                            <thead>
                                <tr>
                                    <th>
                                        <x-input type="checkbox" class="checkbox" id="checkAllClassrooms" />
                                    </th>
                                    <th>#</th>
                                    <th>{{ __('classroom.name') }}</th>
                                    <th>{{ __('classroom.grade_name') }}</th>
                                    <th>{{ __('trans.created_at') }}</th>
                                    <th>{{ __('buttons.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($classrooms as $classroom)
                                    <tr id="classroomID{{ $classroom->id }}">
                                        <td>
                                            <x-input type="checkbox" :value="$classroom->id" class="checkBoxClass"
                                                name="ids" />
                                        </td>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $classroom->name }}</td>
                                        <td>{{ $classroom->grades->name }}</td>
                                        <td>{{ $classroom->created_at }}</td>
                                        <td>
                                            <button type="button" class="btn btn-outline-info btn-sm" data-toggle="modal"
                                                data-target="#edit{{ $classroom->id }}"
                                                title="{{ __('buttons.update') }}">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal"
                                                data-target="#delete{{ $classroom->id }}"
                                                title="{{ __('buttons.delete') }}">
                                                <i class="fas fa-trash-alt"></i>
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
    <div class="modal fade" id="deleteAllClassrooms" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
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
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <h5>{{ __('msgs.deleting_warning') }}</h5>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">{{ __('buttons.close') }}</button>
                    <button type="button" class="btn btn-danger" id="delete-all-classrooms">
                        {{ __('buttons.delete') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            // Check ALl Rows
            $('#checkAllClassrooms').on('click', function() {
                $('.checkBoxClass').prop('checked', $(this).prop('checked'));
            })

            $('input:checkbox[name=ids],#checkAllClassrooms').change(function() {
                var ids = [];

                $('input:checkbox[name=ids]:checked').each(function() {
                    ids.push($(this).val())
                });

                if (ids.length > 0)
                    $('#deleteAllClassroomsBtn').css('display', 'block')
                else
                    $('#deleteAllClassroomsBtn').css('display', 'none')


                $('#delete-all-classrooms').click(function() {
                    $.ajax({
                        url: 'delete-checked-classrooms',
                        type: "delete",
                        data: {
                            ids: ids,
                        },
                        cache: false,
                        dataType: "text",
                        success: function(response) {
                            console.log(response);
                            // if (response.success) {
                            //     $.each(ids, function(indexInArray, valueOfElement) {
                            //         $('#classroomID' + valueOfElement).remove();
                            //         $('#deleteAllClassroomsBtn').css('display',
                            //             'none');
                            //         $('#deleteAllClassrooms').modal('hide')
                            //     });
                            // }
                        },
                        error: function(error) {
                            alert('failed')
                        }
                    });
                });

            })
        });
    </script>
@endsection
