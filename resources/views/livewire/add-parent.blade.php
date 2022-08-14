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
            <div class="col-md-12">
                <h3 class="mt-5">{{ __('msgs.save_data') }}</h3>
                <hr>
                <div class="nextPrevBtns  mt-4">
                    <button class="btn btn-warning btn-sm nextBtn btn-lg pull-right" type="button"
                        wire:click="back(2)">{{ __('buttons.back') }}</button>
                    <button class="btn btn-success btn-sm btn-lg pull-right" wire:click="submitForm"
                        type="button">{{ __('buttons.submit') }}</button>
                </div>
            </div>
        @endif
    </div>
</div>
