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
                <button type="submit" class="button x-small successful-button">
                    {{ __('buttons.submit') }}
                </button>
            </div>
        </form>

    </div>
</div>
</div>
