@extends('layouts.master')
@section('css')

@section('title')
    {{ __('trans.list', ['name' => __('grade.grades')]) }}
@stop

@section('breadcrum')
    {{ __('grade.grades') }}
@stop

@section('breadcrum_home')
    {{ __('trans.list', ['name' => __('grade.grades')]) }}
@stop

@endsection

@section('content')
<!-- row -->
<!-- main body -->
<div class="row">
    <div class="col-xl-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <button type="button" class="button button-border x-small mb-3" data-toggle="modal"
                    data-target="#addNewGrade">
                    {{ __('msgs.add', ['name' => __('grade.grade')]) }}
                </button>
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger">{{ $error }}</div>
                    @endforeach
                @endif
                <div class="table-responsive">
                    <table id="datatable"
                        class="table table-striped table-bordered text-center p-0 table-hover table-sm">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('grade.name') }}</th>
                                <th>{{ __('trans.created_at') }}</th>
                                <th>{{ __('buttons.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($grades as $grade)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $grade->name }}</td>
                                    <td>{{ $grade->created_at }}</td>
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                            data-target="#editGrade{{ $grade->id }}"
                                            title="{{ __('buttons.update') }}">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                            data-target="#delete{{ $grade->id }}"
                                            title="{{ __('buttons.delete') }}">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>

                                {{-- Edit The Grade --}}
                                <div class="modal fade" id="editGrade{{ $grade->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="editGradeLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editGradeLabel">
                                                    {{ __('msgs.update', ['name' => __('grade.grade')]) }}
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{ route('grades.update', $grade) }}" method="POST">
                                                <div class="modal-body">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="row">
                                                        <div class="col">
                                                            <x-label for="name_ar" :value="__('grade.name_ar')" /> :
                                                            <x-input type="text" name="name_ar" id="name_ar"
                                                                class="form-control" :value="old(
                                                                    'name_ar',
                                                                    $grade->getTranslation('name', 'ar'),
                                                                )" required
                                                                autofocus />

                                                        </div>
                                                        <div class="col">
                                                            <x-label for="name_en" :value="__('grade.name_en')" />
                                                            <x-input type="text" name="name_en" class="form-control"
                                                                id="name_en" :value="old(
                                                                    'name_ar',
                                                                    $grade->getTranslation('name', 'en'),
                                                                )" required />
                                                        </div>
                                                    </div>
                                                    <br>

                                                    <div class="form-group">
                                                        <x-label for="notes" :value="__('grade.notes')" />
                                                        <textarea class="form-control" name="notes" id="notes" rows="3">{{ old('notes', $grade->notes) }}</textarea>
                                                    </div>
                                                    <br>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="button x-small secondary-button"
                                                        data-dismiss="modal">{{ __('buttons.close') }}</button>
                                                    <button type="submit" class="button x-small successful-button">
                                                        {{ __('buttons.update') }}
                                                    </button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>

                                {{-- Delete The Grade --}}
                                <x-delete-modal :id="$grade->id" :title="__('msgs.delete', ['name' => __('grade.grade')])" :action="route('grades.destroy', $grade)" />
                            @empty
                                <tr class="text-center">
                                    <td colspan="4">{{ __('msgs.not_found_yet') }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Add A New Grade --}}
    <div class="modal fade" id="addNewGrade" tabindex="-1" role="dialog" aria-labelledby="addNewGradeLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addNewGradeLabel">
                        {{ __('msgs.add', ['name' => __('grade.grade')]) }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('grades.store') }}" method="POST">
                    <div class="modal-body">
                        <!-- add_form -->
                        @csrf
                        <div class="row">
                            <div class="col">
                                <x-label for="name_ar" :value="__('grade.name_ar')" /> :
                                <x-input type="text" name="name_ar" id="name_ar" class="form-control"
                                    :value="old('name_ar')" required autofocus />
                                @error('name_ar')
                                    <small class="text text-danger font-weight-bold">{{ $message }}</small>
                                @enderror

                            </div>
                            <div class="col">
                                <x-label for="name_en" :value="__('grade.name_en')" />
                                <x-input type="text" name="name_en" class="form-control" id="name_en"
                                    :value="old('name_en')" required />
                                @error('name_en')
                                    <small class="text text-danger font-weight-bold">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <br>

                        <div class="form-group">
                            <x-label for="notes" :value="__('grade.notes')" />
                            <textarea class="form-control" name="notes" id="notes" rows="3">{{ old('notes') }}</textarea>
                            @error('notes')
                                <small class="text text-danger font-weight-bold">{{ $message }}</small>
                            @enderror
                        </div>
                        <br>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{ __('buttons.close') }}</button>
                        <button type="submit" class="button button-border x-small">
                            {{ __('buttons.submit') }}
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>



<!-- row closed -->
@endsection
@section('js')

@endsection
