{{-- Edit The Section --}}
<div class="modal fade" id="edit{{ $section->id }}" tabindex="-1" role="dialog" aria-labelledby="editSection"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editSection">
                    {{ __('msgs.update', ['name' => __('section.section')]) }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('sections.update', $section) }}" method="POST">
                <div class="modal-body">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="col">
                            <x-input type="text" name="name_ar" class="form-control" :value="old('name_ar', $section->getTranslation('name', 'ar'))"
                                placeholder="{{ __('section.name_ar') }}" />
                        </div>

                        <div class="col">
                            <x-input type="text" name="name_en" class="form-control" :value="old('name_en', $section->getTranslation('name', 'en'))"
                                placeholder="{{ __('section.name_en') }}" />
                        </div>
                    </div>
                    <br>
                    <div class="col">
                        <x-label :value="__('section.grade_name')" for="grade_id" class="control-label" />
                        <select name="grade_id" class="custom-select">
                            <option value="{{ $grade->id }}">
                                {{ $grade->name }}
                            </option>
                            @foreach ($grades as $grade)
                                <option value="{{ $grade->id }}">
                                    {{ $grade->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <br>

                    <div class="col">
                        <x-label :value="__('section.classrrom_name')" for="classrrom_id" class="control-label" />
                        <select name="classroom_id" class="custom-select">
                            <option value="{{ $section->classroom->id }}">
                                {{ $section->classroom->name }}
                            </option>
                        </select>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col d-flex flex-column">
                            <x-label for="teacher_id" :value="__('teacher.teachers')" />
                            <select name="teacher_id[]" class="form-control form-select form-multiselect" id="teachers"
                                multiple>
                                <option value="" disabled>
                                    {{ __('msgs.select', ['name' => __('teacher.teachers')]) }}
                                </option>
                                @foreach ($teachers as $teacher)
                                    <option value="{{ $teacher->id }}"
                                        @foreach ($section->teachers as $t) {{ $t->id == $teacher->id ? 'selected' : '' }} @endforeach>
                                        {{ $teacher->name }}
                                    </option>
                                @endforeach

                            </select>
                        </div>
                    </div>
                    <br>

                    <div class="col">
                        <div class="form-check">
                            @if ($section->status === 1)
                                <x-input type="checkbox" checked class="form-check-input" name="status"
                                    :value="1" id="status" />
                            @else
                                <x-input type="checkbox" class="form-check-input" name="status" :value="0"
                                    id="status" />
                            @endif
                            <x-label :value="__('section.status')" for="status" class="control-label" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">{{ __('buttons.close') }}</button>
                    <x-button class="btn btn-success">
                        {{ __('buttons.update') }}
                    </x-button>
                </div>
            </form>
        </div>
    </div>
</div>
