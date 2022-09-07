<div class="modal fade" id="addNewSection" tabindex="-1" role="dialog" aria-labelledby="addNewSectionLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addNewSectionLabel">
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
                            <x-input type="text" :value="old('name_ar')" id="name_ar" name="name_ar" class="form-control"
                                placeholder="{{ __('section.name_ar') }}" required autofocus />
                            @error('name_ar')
                                <small class="text text-danger font-weight-bold">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col">
                            <x-input type="text" :value="old('name_en')" id="name_en" name="name_en" class="form-control"
                                placeholder="{{ __('section.name_en') }}" required autofocus />
                            @error('name_en')
                                <small class="text text-danger font-weight-bold">{{ $message }}</small>
                            @enderror
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
                            @error('grade_id')
                                <small class="text text-danger font-weight-bold">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col d-flex flex-column">
                            <x-label for="classroom_id" :value="__('section.classrrom_name')" />
                            <select name="classroom_id" id="get-classrooms" class="form-control">
                                <option value=""></option>
                            </select>
                            @error('classroom_id')
                                <small class="text text-danger font-weight-bold">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col d-flex flex-column">
                            <x-label for="teacher_id" :value="__('teacher.teachers')" />
                            <select name="teacher_id[]" class="form-control form-select form-multiselect"
                                id="teacher_id" multiple>
                                <option value="" disabled>
                                    {{ __('msgs.select', ['name' => __('teacher.teachers')]) }}
                                </option>
                                @foreach ($teachers as $teacher)
                                    <option value="{{ $teacher->id }}"> {{ $teacher->name }}</option>
                                @endforeach
                            </select>
                            @error('teacher_id')
                                <small class="text text-danger font-weight-bold">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="status" value="{{ old('status') }}"
                                id="status" />
                            <label for="status" class="control-label">{{ __('section.status') }}</label>
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
