<div class="modal fade" id="editClassroom{{ $classroom->id }}" tabindex="-1" role="dialog"
    aria-labelledby="editClassroomLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editClassroomLabel">
                    {{ __('msgs.update', ['name' => __('classroom.classroom')]) }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('classrooms.update', $classroom) }}" method="POST">
                <div class="modal-body">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col">
                            <x-label for="name_ar" :value="__('grade.name_ar')" /> :
                            <x-input type="text" name="name_ar" id="name_ar" class="form-control" :value="old('name_ar', $classroom->getTranslation('name', 'ar'))"
                                required autofocus />
                            @error('name_ar')
                                <small class="text text-danger font-weight-bold">{{ $message }}</small>
                            @enderror

                        </div>
                        <div class="col">
                            <x-label for="name_en" :value="__('grade.name_en')" />
                            <x-input type="text" name="name_en" class="form-control" id="name_en" :value="old('name_ar', $classroom->getTranslation('name', 'en'))"
                                required />
                            @error('name_en')
                                <small class="text text-danger font-weight-bold">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <br>

                    <div class="form-group d-flex flex-column">
                        <x-label for="grade_id" :value="__('classroom.grade_name')" />
                        <select name="grade_id" id="grade_id" class="fancyselect">
                            @foreach ($grades as $grade)
                                <option value="{{ $grade->id }}"
                                    {{ $grade->id == $classroom->grade_id ? 'selected' : '' }}>{{ $grade->name }}
                                </option>
                            @endforeach
                            @error('grade_id')
                                <small class="text text-danger font-weight-bold">{{ $message }}</small>
                            @enderror
                        </select>
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
