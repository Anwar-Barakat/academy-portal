@extends('layouts.master')



@section('title')
    {{ __('trans.managmenet_promotion') }}
@stop

@section('breadcrum')
    {{ __('trans.students_promotion') }}@endsection

@section('breadcrum_home')
    {{ __('trans.managmenet_promotion') }}
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
                    <button type="button" class="button button-border x-small mb-3" data-toggle="modal"
                        data-target="#undoPromotion" title="{{ __('student.undo_the_promotion') }}">
                        {{ __('student.undo_the_promotion') }}
                    </button>
                    <br>

                    <div class="table-responsive">
                        <table id="datatable"
                            class="table table-striped table-bordered text-center p-0 table-hover table-sm">
                            <thead>
                                <tr>
                                    <th class="alert alert-info">#</th>
                                    <th class="alert alert-info">{{ __('student.name') }}</th>
                                    <th class="alert alert-danger">{{ __('student.old_grade') }}</th>
                                    <th class="alert alert-danger">{{ __('student.old_classroom') }}</th>
                                    <th class="alert alert-danger">{{ __('student.old_section') }}</th>
                                    <th class="alert alert-danger">{{ __('student.old_academic_year') }}</th>
                                    <th class="alert alert-success">{{ __('student.new_grade') }}</th>
                                    <th class="alert alert-success">{{ __('student.new_classroom') }}</th>
                                    <th class="alert alert-success">{{ __('student.new_section') }}</th>
                                    <th class="alert alert-success">{{ __('student.new_academic_year') }}</th>
                                    <th class="alert alert-info">{{ __('buttons.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse ($promotions as $promotion)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $promotion->student->name }}</td>
                                        <td>{{ $promotion->oldGrade->name }}</td>
                                        <td>{{ $promotion->oldClassroom->name }}</td>
                                        <td>{{ $promotion->oldSection->name }}</td>
                                        <td>{{ $promotion->academic_year }}</td>
                                        <td>{{ $promotion->newGrade->name }}</td>
                                        <td>{{ $promotion->newClassroom->name }}</td>
                                        <td>{{ $promotion->newSection->name }}</td>
                                        <td>{{ $promotion->new_academic_year }}</td>
                                        <td>

                                        </td>
                                    </tr>
                                @empty
                                    <tr class="text-center">
                                        <td colspan="11">{{ __('msgs.not_found_yet') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Undoing on Promotions --}}
    <div class="modal fade" id="undoPromotion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="deleteGradeLabel">
                        {{ __('student.undo_the_promotion') }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('students-promotions.destroy', 'test') }}" method="POST">
                    <div class="modal-body">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="all" value="1">
                        <div class="row">
                            <div class="col">
                                <h5>{{ __('msgs.undoing_promotion_warning') }}</h5>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{ __('buttons.close') }}</button>
                        <x-button class="btn btn-danger">
                            {{ __('buttons.undo') }}
                        </x-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
