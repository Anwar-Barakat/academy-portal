<div>
    @if (!empty($successMessage))
        <div class="alert alert-success" id="success-alert">
            <button type="button" class="close" data-dismiss="alert">x</button>
            {{ $successMessage }}
        </div>
    @endif


    <div class="stepwizard">
        <div class="stepwizard-row setup-panel">
            <div class="stepwizard-step">
                <a href="#step-1" type="button"
                    class="btn btn-circle {{ $currentStep != 1 ? 'btn-dark' : 'btn-success' }}">1</a>
                <p>{{ trans('parent.step1') }}</p>
            </div>
            <div class="stepwizard-step">
                <a href="#step-2" type="button"
                    class="btn btn-circle {{ $currentStep != 2 ? 'btn-dark' : 'btn-success' }}">2</a>
                <p>{{ trans('parent.step2') }}</p>
            </div>
            <div class="stepwizard-step">
                <a href="#step-3" type="button"
                    class="btn btn-circle {{ $currentStep != 3 ? 'btn-dark' : 'btn-success' }}"
                    disabled="disabled">3</a>
                <p>{{ trans('parent.step3') }}</p>
            </div>
        </div>
    </div>


    @include('livewire.father-form')

    @include('livewire.mother-form')


    <div class="row setup-content {{ $currentStep != 3 ? 'displayNone' : '' }}" id="step-3">
        @if ($currentStep === 3)
            <div class="col-md-12">
                <h3>{{ __('msgs.save_data') }}</h3>
                <hr>
                <div class="nextPrevBtns  mt-4">
                    <button class="btn btn-warning btn-sm nextBtn btn-lg pull-right" type="button"
                        wire:click="back(2)">{{ trans('buttons.back') }}</button>
                    <button class="btn btn-success btn-sm btn-lg pull-right" wire:click="submitForm"
                        type="button">{{ trans('buttons.submit') }}</button>
                </div>
            </div>
        @endif
    </div>
</div>
