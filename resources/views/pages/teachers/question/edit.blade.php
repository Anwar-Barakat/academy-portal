@extends('layouts.master')
@section('css')

@section('title')
    {{ __('msgs.update', ['name' => __('trans.question')]) }}
@stop

@endsection
@section('breadcrum')
{{ __('trans.quizzes') }}
@endsection

@section('breadcrum_home')
{{ __('msgs.update', ['name' => __('trans.question')]) }}
@endsection

@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="post" action="{{ route('questions.update', $question) }}" autocomplete="off">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="quiz_id" value="{{ $question->quiz->id }}">
                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <x-label for="title_ar" :value="__('trans.arabic_question')" />
                                <x-input type="text" name="title_ar" class="form-control" name="title_ar"
                                    :value="old('title_ar', $question->getTranslation('title', 'ar'))" aria-required="" />
                                @error('title_ar')
                                    <small class="text text-danger font-weight-bold">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <x-label for="title_en" :value="__('trans.english_question')" />
                                <x-input type="text" name="title_en" class="form-control" name="title_en"
                                    :value="old('title_en', $question->getTranslation('title', 'en'))" aria-required="" />
                                @error('title_en')
                                    <small class="text text-danger font-weight-bold">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <x-label for="all_answers" :value="__('trans.all_answers')" />
                                <textarea id="all_answers" class="form-control w-100" name="all_answers" rows="3" required>{{ old('all_answers', $question->all_answers) }}</textarea>
                                @error('all_answers')
                                    <small class="text text-danger font-weight-bold">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <x-label for="right_answer" :value="__('trans.right_answer')" />
                                <x-input type="text" name="right_answer" class="form-control" name="right_answer"
                                    :value="old('right_answer', $question->right_answer)" aria-required="" />
                                @error('right_answer')
                                    <small class="text text-danger font-weight-bold">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-xl-6">
                            <div class="form-group">
                                <x-label for="degrees" :value="__('trans.degrees')" />
                                <select class="custom-select mr-sm-2" name="degrees">
                                    <option value="" disabled selected>
                                        {{ __('msgs.select', ['name' => __('...')]) }}
                                    </option>
                                    <option {{ $question->degrees == '5' ? 'selected' : '' }} value="5">5</option>
                                    <option {{ $question->degrees == '10' ? 'selected' : '' }} value="10">10
                                    </option>
                                    <option {{ $question->degrees == '15' ? 'selected' : '' }} value="15">15
                                    </option>
                                    <option {{ $question->degrees == '20' ? 'selected' : '' }} value="20">20
                                    </option>
                                    <option {{ $question->degrees == '25' ? 'selected' : '' }} value="25">25
                                    </option>
                                </select>
                                @error('degrees')
                                    <small class="text text-danger font-weight-bold">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <hr>
                    <button type="submit" class="button button-border x-small">
                        {{ __('buttons.update') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')
{{-- Get Grade's Classrooms --}}
<script>
    $(function() {
        $('select[name=grade_id]').on('change', function() {
            var grade_id = $(this).val();
            if (grade_id) {
                $.ajax({
                    type: "get",
                    url: "/get-classrooms/" + grade_id,
                    dataType: "json",
                    success: function(response) {
                        $('select[name=classroom_id]').empty();
                        $('select[name=classroom_id]').append(
                            '<option disabled  value="" selected>{{ __('msgs.select', ['name' => '...']) }}</option>'
                        );
                        $.each(response, function(index, value) {
                            $('select[name=classroom_id]').append(
                                '<option value="' + index + '">' + value +
                                '</option>'
                            );
                        });
                    }
                });
            }
        })
    });
</script>

{{-- Get Classroom's Sections --}}
<script>
    $(function() {
        $('select[name=classroom_id]').on('change', function() {
            var classroom_id = $(this).val();
            if (classroom_id) {
                $.ajax({
                    type: "get",
                    url: "/get-sections/" + classroom_id,
                    dataType: "json",
                    success: function(response) {
                        $('select[name=section_id]').empty();
                        $('select[name=section_id]').append(
                            '<option disabled  value="" selected>{{ __('msgs.select', ['name' => '...']) }}</option>'
                        );
                        $.each(response, function(index, value) {
                            $('select[name=section_id]').append(
                                '<option value="' + index + '">' + value +
                                '</option>'
                            );
                        });
                    }
                });
            }
        })
    });
</script>

{{-- Get Classroom's Subjects --}}
<script>
    $(function() {
        $('select[name=classroom_id]').on('change', function() {
            var grade_id = $('select[name=grade_id]').val();
            var classroom_id = $(this).val();
            if (classroom_id) {
                $.ajax({
                    type: "get",
                    url: "/get-subjects/" + grade_id + '/' + classroom_id,
                    dataType: "json",
                    success: function(response) {
                        $('select[name=subject_id]').empty();
                        $('select[name=subject_id]').append(
                            '<option disabled  value="" selected>{{ __('msgs.select', ['name' => '...']) }}</option>'
                        );
                        $.each(response, function(index, value) {
                            $('select[name=subject_id]').append(
                                '<option value="' + index + '">' + value +
                                '</option>'
                            );
                        });
                    }
                });
            }
        })
    });
</script>

{{-- Get Subject's Teacher --}}
<script>
    $(function() {
        $('select[name=subject_id]').on('change', function() {
            var grade_id = $('select[name=grade_id]').val();
            var classroom_id = $('select[name=classroom_id]').val();
            var subject_id = $('select[name=subject_id]').val();
            if (classroom_id) {
                $.ajax({
                    type: "get",
                    url: "/get-teachers/" + grade_id + '/' + classroom_id + '/' + subject_id,
                    dataType: "json",
                    success: function(response) {
                        $('select[name=teacher_id]').empty();
                        $('select[name=teacher_id]').append(
                            '<option disabled  value="" selected>{{ __('msgs.select', ['name' => '...']) }}</option>'
                        );
                        console.log(response);
                        response.forEach((teacher) => {
                            document.querySelector(
                                    'select[name=teacher_id]')
                                .innerHTML +=
                                `<option value=${teacher['id']}>${teacher['name']['en']}</option>`;
                        });
                    }
                });
            }
        })
    });
</script>



{{-- Get Section's Teachers --}}
{{-- <script>
    $(function() {
        $('select[name=section_id]').on('change', function() {
            var section_id = $(this).val();
            if (section_id) {
                $.ajax({
                    type: "get",
                    url: "/get-teachers/" + section_id,
                    dataType: "json",
                    success: function(response) {
                        $('select[name=teacher_id]').empty();
                        $('select[name=teacher_id]').append(
                            '<option disabled  value="" selected>{{ __('msgs.select', ['name' => '...']) }}</option>'
                        );
                        response.forEach((teachers) => {
                            teachers.forEach((teacher) => {
                                document.querySelector(
                                        'select[name=teacher_id]')
                                    .innerHTML +=
                                    `<option value=${teacher['id']}>${teacher['name']['en']}</option>`;
                            })
                        });
                    }
                });
            }
        })
    });
</script> --}}
@endsection
