   {{-- Add Mother Form --}}
   @if ($currentStep === 2)
       <div class="col-xs-12">
           <div class="col-md-12">
               <div class="row mb-4 mt-3">
                   <div class="col">
                       <x-label for="mother_name_ar" :value="__('parent.mother_name_ar')" />
                       <x-input type="text" wire:model="mother_name_ar" class="form-control" id="mother_name_ar"
                           :value="old('mother_name_ar')" />
                       @error('mother_name_ar')
                           <small class="text text-danger">{{ $message }}</small>
                       @enderror
                   </div>
                   <div class="col">
                       <x-label for="mother_name_en" :value="__('parent.mother_name_en')" />
                       <x-input type="text" wire:model="mother_name_en" class="form-control" id="mother_name_en"
                           :value="old('mother_name_en')" />
                       @error('mother_name_en')
                           <small class="text text-danger">{{ $message }}</small>
                       @enderror
                   </div>
               </div>

               <div class="row mb-4">
                   <div class="col">
                       <x-label for="mother_job_ar" :value="__('parent.mother_job_ar')" />
                       <x-input type="text" wire:model="mother_job_ar" class="form-control" id="mother_job_ar"
                           :value="old('mother_job_ar')" />
                       @error('mother_job_ar')
                           <small class="text text-danger">{{ $message }}</small>
                       @enderror
                   </div>
                   <div class="col">
                       <x-label for="mother_job_en" :value="__('parent.mother_job_en')" />
                       <x-input type="text" wire:model="mother_job_en" class="form-control" id="mother_job_en"
                           :value="old('mother_job_en')" />
                       @error('mother_job_en')
                           <small class="text text-danger">{{ $message }}</small>
                       @enderror
                   </div>
               </div>
               <div class="row mb-4">
                   <div class="col">
                       <x-label for="mother_identification" :value="__('parent.mother_identification')" />
                       <input type="number" wire:model="mother_identification" class="form-control">
                       @error('mother_identification')
                           <small class="text text-danger">{{ $message }}</small>
                       @enderror
                   </div>
                   <div class="col">
                       <x-label for="mother_passport" :value="__('parent.mother_passport')" />
                       <x-input type="number" wire:model="mother_passport" class="form-control" id="mother_passport"
                           :value="old('mother_passport')" />
                       @error('mother_passport')
                           <small class="text text-danger">{{ $message }}</small>
                       @enderror
                   </div>

                   <div class="col">
                       <x-label for="mother_phone" :value="__('parent.mother_phone')" />
                       <x-input type="tel" wire:model="mother_phone" class="form-control" id="mother_phone"
                           :value="old('mother_phone')" />
                       @error('mother_phone')
                           <small class="text text-danger">{{ $message }}</small>
                       @enderror
                   </div>
               </div>


               <div class="row mb-4">
                   <div class="form-group col">
                       <x-label for="mother_nationality_id" :value="__('parent.mother_nationality_id')" />
                       <select class="custom-select my-1 mr-sm-2" wire:model="mother_nationality_id">
                           <option selected value="">{{ __('msgs.select', ['name' => '...']) }}</option>
                           @foreach ($nationalities as $nationality)
                               <option value="{{ $nationality->id }}">{{ $nationality->name }}</option>
                           @endforeach
                       </select>
                       @error('mother_nationality_id')
                           <small class="text text-danger">{{ $message }}</small>
                       @enderror
                   </div>
                   <div class="form-group col">
                       <x-label for="mother_blood_id" :value="__('parent.mother_blood_id')" />
                       <select class="custom-select my-1 mr-sm-2" wire:model="mother_blood_id">
                           <option selected value="">{{ __('msgs.select', ['name' => '...']) }}</option>
                           @foreach ($bloods as $blood)
                               <option value="{{ $blood->id }}">{{ $blood->name }}</option>
                           @endforeach
                       </select>
                       @error('mother_blood_id')
                           <small class="text text-danger">{{ $message }}</small>
                       @enderror
                   </div>
                   <div class="form-group col">
                       <x-label for="mother_religion_id" :value="__('parent.mother_religion_id')" />
                       <select class="custom-select my-1 mr-sm-2" wire:model="mother_religion_id">
                           <option selected value="">{{ __('msgs.select', ['name' => '...']) }}</option>
                           @foreach ($religions as $religion)
                               <option value="{{ $religion->id }}">{{ $religion->name }}</option>
                           @endforeach
                       </select>
                       @error('mother_religion_id')
                           <small class="text text-danger">{{ $message }}</small>
                       @enderror
                   </div>
               </div>


               <div class="form-group">
                   <x-label for="mother_address" :value="__('parent.mother_address')" />
                   <textarea class="form-control" wire:model="mother_address" id="mother_address" rows="4">{{ old('mother_address') }}</textarea>
                   @error('mother_address')
                       <small class="text text-danger">{{ $message }}</small>
                   @enderror
               </div>
               <br>
               <hr>
               <div class="nextPrevBtns  mt-4">
                   <button class="btn btn-secondary" wire:click="back(1)" type="button">{{ __('buttons.back') }}
                   </button>
                   @if ($updateMode === true)
                       <button class="button x-small successful-button" wire:click="secondStepEdit"
                           type="button">{{ __('buttons.next') }}
                       </button>
                   @else
                       <button class="button x-small successful-button" wire:click="secondStepSubmit"
                           type="button">{{ __('buttons.next') }}
                       </button>
                   @endif
               </div>
           </div>
       </div>
   @endif
