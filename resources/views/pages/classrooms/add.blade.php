<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    {{ __('msgs.add', ['name' => __('classroom.classrooms')]) }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="row" action="{{ route('classrooms.store') }}" method="POST">
                    @csrf
                    <div class="card-body pb-0">
                        <div class="repeater">
                            <div data-repeater-list="classrooms_list">
                                <div data-repeater-item>
                                    <div class="row form-repeater-inputs">
                                        <div class="col mb-1">
                                            <x-label for="name_ar" class="mr-sm-2" :value="__('classroom.name_ar')" />
                                            <x-input type="text" id="name_ar" class="form-control" name="name_ar"
                                                :value="old('name_ar')" required autofocus />
                                            @error('name_ar')
                                                <small class="text text-danger font-weight-bold">{{ $message }}</small>
                                            @enderror

                                        </div>
                                        <div class="col mb-1">
                                            <x-label for="name_en" class="mr-sm-2" :value="__('classroom.name_en')" />
                                            <x-input type="text" id="name_en" class="form-control" name="name_en"
                                                :value="old('name_en')" required autofocus />
                                            @error('name_en')
                                                <small class="text text-danger font-weight-bold">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col mb-1">
                                            <x-label for="grade_id" class="mr-sm-2" :value="__('classroom.grade_name')" />

                                            <div class="box">
                                                <select class="fancyselect" name="grade_id">
                                                    @foreach ($grades as $key => $grade)
                                                        <option value="{{ $grade->id }}"
                                                            {{ old('grade_id') == $key ? 'selected' : '' }}>
                                                            {{ $grade->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('grade_id')
                                                    <small
                                                        class="text text-danger font-weight-bold">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col mb-1">
                                            <x-label for="actions" class="mr-sm-2" :value="__('buttons.actions')" />
                                            <x-input type="text" class="btn btn-danger btn-block"
                                                data-repeater-delete type="button" :value="__('msgs.delete', ['name' => __('classroom.row')])" autofocus />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-20">
                                <div class="col-12">
                                    <x-input type="text" class="btn btn-success btn-block w-25 mb-2"
                                        data-repeater-create type="button" :value="__('msgs.add', ['name' => __('classroom.row')])" autofocus />
                                </div>
                            </div>
                            <div class="modal-footer pb-0">
                                <button type="button" class="btn btn-secondary"
                                    data-dismiss="modal">{{ __('buttons.close') }}</button>
                                <button type="submit" class="button x-small successful-button">
                                    {{ __('buttons.submit') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
