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
                            @error('name_ar')
                                <small class="text text-danger font-weight-bold">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col">
                            <x-input type="text" name="name_en" class="form-control" :value="old('name_en', $section->getTranslation('name', 'en'))"
                                placeholder="{{ __('section.name_en') }}" />
                            @error('name_en')
                                <small class="text text-danger font-weight-bold">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <br>
                    <div class="col">
                        <x-label :value="__('section.grade_name')" for="grade_id" class="control-label" />
                        <select name="grade_id" class="custom-select">
                            @foreach ($grades as $grade)
                                <option value="{{ $grade->id }}"
                                    {{ $grade->id == $section->grade_id ? 'selected' : '' }}>
                                    {{ $grade->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('grade_id')
                            <small class="text text-danger font-weight-bold">{{ $message }}</small>
                        @enderror
                    </div>
                    <br>

                    <div class="col">
                        <x-label :value="__('section.classrrom_name')" for="classrrom_id" class="control-label" />
                        <select name="classroom_id" class="custom-select">
                            @foreach ($grades as $grade)
                                @if ($grade->id == $section->grade_id)
                                    @foreach ($grade->classrooms as $classroom)
                                        <option value="{{ $classroom->id }}"
                                            {{ $classroom->id == $section->classroom_id ? 'selected' : '' }}>
                                            {{ $classroom->name }}</option>
                                    @endforeach
                                @endif
                            @endforeach
                        </select>
                        @error('classroom_id')
                            <small class="text text-danger font-weight-bold">{{ $message }}</small>
                        @enderror
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
                                @error('teacher_id')
                                    <small class="text text-danger font-weight-bold">{{ $message }}</small>
                                @enderror
                            </select>
                        </div>
                    </div>
                    <br>

                    <div class="col">
                        <div class="form-check">
                            <input type="checkbox" checked class="form-check-input" name="status"
                                value="{{ $section->status }}" id="status"
                                {{ $section->status == 1 ? 'checked' : '' }} />
                            <label for="status" class="control-label">{{ __('section.status') }}</label>
                        </div>
                    </div>
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
