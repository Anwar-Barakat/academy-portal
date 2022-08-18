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
                                    aria-selected="false">{{ __('trans.attchments') }}</a>
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
