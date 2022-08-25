<div class="modal fade" id="edit{{ $exam->id }}" tabindex="-1" role="dialog" aria-labelledby="editLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editLabel">
                    {{ __('msgs.update', ['name' => __('trans.exam')]) }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('exams.update', $exam) }}" method="POST">
                <div class="modal-body">
                    @csrf
                    @method('PUT')
                    <div class="row mb-3">
                        <div class="col">
                            <x-label for="name_ar" :value="__('trans.name_ar')" /> :
                            <x-input type="text" name="name_ar" id="name_ar" class="form-control" :value="old('name_ar', $exam->getTranslation('name', 'ar'))"
                                required autofocus />

                        </div>
                        <div class="col">
                            <x-label for="name_en" :value="__('trans.name_en')" />
                            <x-input type="text" name="name_en" class="form-control" id="name_en" :value="old('name_en', $exam->getTranslation('name', 'en'))"
                                required />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <x-label for="term" :value="__('trans.term')" />
                            <x-input type="text" name="term" class="form-control" id="term" :value="old('term', $exam->term)"
                                required />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <x-label for="academic_year" :value="__('student.academic_year')" />
                            <select class="custom-select mr-sm-2" name="academic_year">
                                <option selected disabled>
                                    {{ __('msgs.select', ['name' => '...']) }}</option>
                                @php
                                    $current_year = date('Y');
                                @endphp
                                @for ($year = $current_year; $year <= $current_year + 1; $year++)
                                    <option value="{{ $year }}"
                                        {{ $year == $exam->academic_year ? 'selected' : '' }}>
                                        {{ $year }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <br>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">{{ __('buttons.close') }}</button>
                    <button class="button button-border x-small" type="submit">
                        {{ __('buttons.update') }}
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
