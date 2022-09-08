@extends('layouts.master')



@section('css')

@section('title')
    {{ __('msgs.show', ['name' => __('student.student')]) }}
@stop

@endsection
@section('breadcrum')
{{ __('student.students') }}
@endsection

@section('breadcrum_home')
{{ __('msgs.show', ['name' => __('student.student')]) }}
@endsection


@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <div class="card-body">
                    <div class="tab nav-border">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active show" id="home-02-tab" data-toggle="tab" href="#home-02"
                                    role="tab" aria-controls="home-02"
                                    aria-selected="true">{{ __('student.student_details') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-02-tab" data-toggle="tab" href="#profile-02"
                                    role="tab" aria-controls="profile-02"
                                    aria-selected="false">{{ __('trans.attachments') }}</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade active show" id="home-02" role="tabpanel"
                                aria-labelledby="home-02-tab">
                                <div class="card card-statistics">
                                    <div class="card-body">
                                        <h5 class="text text-info">{{ __('student.personal_information') }}</h5>
                                        <div class="table-responsive">
                                            <table class="table table-striped table-hover table-sm"
                                                style="text-align:center">
                                                <tbody>
                                                    <tr scope="row">
                                                        <td>{{ __('student.name_ar') }}</td>
                                                        <td>{{ $student->getTranslation('name', 'ar') }}</td>
                                                    </tr>
                                                    <tr scope="row">
                                                        <td>{{ __('student.name_en') }}</td>
                                                        <td>{{ $student->getTranslation('name', 'en') }}</td>
                                                    </tr>
                                                    <tr scope="row">
                                                        <td>{{ __('student.name_en') }}</td>
                                                        <td>{{ $student->getTranslation('name', 'en') }}</td>
                                                    </tr>
                                                    <tr scope="row">
                                                        <td>{{ __('trans.email') }}</td>
                                                        <td>{{ $student->email }}</td>
                                                    </tr>
                                                    <tr scope="row">
                                                        <td>{{ __('grade.grade') }}</td>
                                                        <td>{{ $student->grade->name }}</td>
                                                    </tr>
                                                    <tr scope="row">
                                                        <td>{{ __('classroom.classroom') }}</td>
                                                        <td>{{ $student->classroom->name }}</td>
                                                    </tr>
                                                    <tr scope="row">
                                                        <td>{{ __('section.section') }}</td>
                                                        <td>{{ $student->section->name }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                            <hr>
                                            <h5 class="text text-info">{{ __('student.student_information') }}</h5>
                                            <table class="table table-striped table-hover table-sm"
                                                style="text-align:center">
                                                <tbody>
                                                    <tr scope="row">
                                                        <td>{{ __('student.nationality') }}</td>
                                                        <td>{{ $student->nationality->name }}</td>
                                                    </tr>
                                                    <tr scope="row">
                                                        <td>{{ __('student.blood_type') }}</td>
                                                        <td>{{ $student->blood->name }}</td>
                                                    </tr>
                                                    <tr scope="row">
                                                        <td>{{ __('parent.parent') }}</td>
                                                        <td>{{ $student->myParent->father_name }}</td>
                                                    </tr>
                                                    <tr scope="row">
                                                        <td>{{ __('student.academic_year') }}</td>
                                                        <td>{{ $student->academic_year }}</td>
                                                    </tr>
                                                    <tr scope="row">
                                                        <td>{{ __('student.birthday') }}</td>
                                                        <td>{{ $student->birthday }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="profile-02" role="tabpanel" aria-labelledby="profile-02-tab">
                                <div class="card card-statistics">
                                    <div class="card-body">
                                        <form method="post" action="{{ route('student_upload_attachment') }}"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <h5 class="text text-info">{{ __('trans.attachments') }}</h5>
                                            <div class="row mb-3">
                                                <div class="col-xl-6 col-md-6">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"
                                                                id="inputGroupFileAddon01">{{ __('buttons.upload') }}</span>
                                                        </div>
                                                        <div class="custom-file">
                                                            <x-input type="file" name="images[]" multiple
                                                                class="custom-file" accept="image/*" id="photos"
                                                                aria-describedby="inputGroupFileAddon01" />
                                                            <x-label class="custom-file-label" for="photos"
                                                                :value="__('msgs.select', [
                                                                    'name' => __('trans.attachments'),
                                                                ])" />
                                                            <input type="hidden" name="student_name"
                                                                value="{{ $student->getTranslation('name', 'en') }}">
                                                            <input type="hidden" name="student_id"
                                                                value="{{ $student->id }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" class="button button-border x-small">
                                                {{ __('buttons.upload') }}
                                            </button>
                                        </form>
                                    </div>
                                    <hr>
                                    <table class="table center-aligned-table mb-0 table table-hover"
                                        style="text-align:center">
                                        <thead>
                                            <tr class="table-secondary">
                                                <th scope="col">#</th>
                                                <th scope="col">{{ __('student.filename') }}</th>
                                                <th scope="col">{{ __('trans.created_at') }}</th>
                                                <th scope="col">{{ __('buttons.actions') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($student->images as $img)
                                                <tr class="text-center">
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>
                                                        <img src="{{ asset('attachments/students/' . $student->getTranslation('name', 'en') . '/' . $img->file_name) }}"
                                                            alt="" width="100" class="img img-thumbnail">
                                                    </td>
                                                    <td>{{ $img->created_at->diffForHumans() }}</td>
                                                    <td colspan="2">
                                                        <a class="btn btn-outline-info btn-sm"
                                                            href="{{ url('download-attachment') }}/{{ $student->getTranslation('name', 'en') }}/{{ $img->file_name }}"
                                                            role="button"><i class="fas fa-download"></i>&nbsp;
                                                            {{ __('buttons.download') }}</a>

                                                        <button type="button" class="btn btn-outline-danger btn-sm"
                                                            data-toggle="modal"
                                                            data-target="#deleteImage{{ $img->id }}"
                                                            title="{{ __('buttons.delete') }}">{{ __('buttons.delete') }}
                                                        </button>
                                                    </td>
                                                </tr>
                                                @include('pages.students.delete-attachment')
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
                </div>
            </div>
        </div>
        <!-- row closed -->
    </div>
</div>
<!-- row closed -->
@endsection
