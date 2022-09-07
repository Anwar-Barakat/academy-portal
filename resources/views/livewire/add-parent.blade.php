<div>
    @if (isset($successfulMsg) && !empty($successfulMsg))
        <div class="alert alert-success" id="success-alert mb-5">
            <button type="button" class="close" data-dismiss="alert">x</button>
            {{ $successfulMsg }}
        </div>
    @endif

    @if (isset($errorMsg) && !empty($errorMsg))
        <div class="alert alert-danger" id="success-alert mb-5">
            <button type="button" class="close" data-dismiss="alert">x</button>
            {{ $errorMsg }}
        </div>
    @endif


    @if ($showTable === true)
        @include('livewire.parents_table')
    @else
        <div class="stepwizard">
            <div class="stepwizard-row setup-panel">
                <div class="stepwizard-step">
                    <a href="#step-1" type="button"
                        class="btn btn-circle {{ $currentStep != 1 ? 'btn-dark' : 'btn-success' }}">1</a>
                    <p>{{ __('parent.step1') }}</p>
                </div>
                <div class="stepwizard-step">
                    <a href="#step-2" type="button"
                        class="btn btn-circle {{ $currentStep != 2 ? 'btn-dark' : 'btn-success' }}">2</a>
                    <p>{{ __('parent.step2') }}</p>
                </div>
                <div class="stepwizard-step">
                    <a href="#step-3" type="button"
                        class="btn btn-circle {{ $currentStep != 3 ? 'btn-dark' : 'btn-success' }}"
                        disabled="disabled">3</a>
                    <p>{{ __('parent.step3') }}</p>
                </div>
            </div>
        </div>

        @include('livewire.father-form')

        @include('livewire.mother-form')


        <div class="row setup-content {{ $currentStep != 3 ? 'displayNone' : '' }}" id="step-3">
            @if ($currentStep === 3)
                @if ($updateMode == true)
                    <div class="table-responsive mt-5">
                        <table class="table center-aligned-table mb-0 table table-hover" style="text-align:center">
                            <thead>
                                <tr class="table-secondary">
                                    <th scope="col">#</th>
                                    <th scope="col">{{ __('student.filename') }}</th>
                                    <th scope="col">{{ __('trans.created_at') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $myParent = App\Models\MyParent::where('id', $parent_id)->first();
                                @endphp
                                @forelse ($myParent->images as $img)
                                    <tr class="text-center">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <img src="{{ asset('attachments/parents/' . $img->imageable->father_name . '/' . $img->file_name) }}"
                                                alt="" width="100" class="img img-thumbnail">
                                        </td>
                                        <td>{{ $img->created_at->diffForHumans() }}</td>
                                    </tr>
                                @empty
                                    <tr class="text-center">
                                        <td colspan="3">{{ __('msgs.not_found_yet') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                @endif
                <div class="col-md-6">
                    <h3 class="mt-5 mb-3">{{ __('parent.attachments') }}</h3>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupFileAddon01">{{ __('buttons.upload') }}</span>
                        </div>
                        <div class="custom-file">
                            <x-input type="file" class="custom-file-input" wire:model="photos" accept="image/*"
                                multiple id="photos" />
                            <x-input wire:model="parent_id" type="hidden" />
                            <x-label class="custom-file-label" for="photos" :value="__('msgs.select', ['name' => __('parent.attachments')])" />
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <h3 class="mt-5">{{ __('msgs.save_data') }}</h3>
                    <hr>
                    <div class="nextPrevBtns  mt-4">
                        <button class="btn btn-secondary" type="button"
                            wire:click="back(2)">{{ __('buttons.back') }}</button>
                        @if ($updateMode === true)
                            <button class="button x-small successful-button"
                                wire:click="updateForm({{ $parent_id }})"
                                type="button">{{ __('buttons.update') }}</button>
                        @else
                            <button class="button x-small successful-button" wire:click="submitForm"
                                type="button">{{ __('buttons.submit') }}</button>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    @endif
</div>
