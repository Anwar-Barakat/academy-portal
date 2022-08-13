   {{-- Add Father --}}
   @if ($currentStep != 1)
       <div style="display: none" class="row setup-content" id="step-1">
   @endif
   <div class="col-xs-12">
       <div class="col-md-12">
           <br>
           <div class="row mb-4">
               <div class="col">
                   <x-label for="email" :value="__('trans.email')" />
                   <x-input type="email" wire:model="Email" class="form-control" id="email" :value="old('email')" />
                   @error('Email')
                       <div class="alert alert-danger">{{ $message }}</div>
                   @enderror
               </div>
               <div class="col">
                   <x-label for="password" :value="__('trans.password')" />
                   <x-input type="password" wire:model="password" class="form-control" id="password"
                       :value="old('password')" />
                   @error('password')
                       <div class="alert alert-danger">{{ $message }}</div>
                   @enderror
               </div>
           </div>

           <div class="row mb-4">
               <div class="col">
                   <x-label for="father_name_ar" :value="__('parent.father_name_ar')" />
                   <x-input type="text" wire:model="father_name_ar" class="form-control" id="father_name_ar"
                       :value="old('father_name_ar')" />
                   @error('father_name_ar')
                       <div class="alert alert-danger">{{ $message }}</div>
                   @enderror
               </div>
               <div class="col">
                   <x-label for="father_name_en" :value="__('parent.father_name_en')" />
                   <x-input type="text" wire:model="father_name_en" class="form-control" id="father_name_en"
                       :value="old('father_name_en')" />
                   @error('father_name_en')
                       <div class="alert alert-danger">{{ $message }}</div>
                   @enderror
               </div>
           </div>

           <div class="row mb-4">
               <div class="col">
                   <x-label for="father_job_ar" :value="__('parent.father_job_ar')" />
                   <x-input type="text" wire:model="father_job_ar" class="form-control" id="father_job_ar"
                       :value="old('father_job_ar')" />
                   @error('father_job_ar')
                       <div class="alert alert-danger">{{ $message }}</div>
                   @enderror
               </div>
               <div class="col">
                   <x-label for="father_job_en" :value="__('parent.father_job_en')" />
                   <x-input type="text" wire:model="father_job_en" class="form-control" id="father_job_en"
                       :value="old('father_job_en')" />
                   @error('father_job_en')
                       <div class="alert alert-danger">{{ $message }}</div>
                   @enderror
               </div>
           </div>
           <div class="row mb-4">
               <div class="col">
                   <x-label for="father_nationality_id" :value="__('parent.father_nationality_id')" />
                   <input type="text" wire:model="father_nationality_id" class="form-control">
                   @error('father_nationality_id')
                       <div class="alert alert-danger">{{ $message }}</div>
                   @enderror
               </div>
               <div class="col">
                   <x-label for="father_passport" :value="__('parent.father_passport')" />
                   <x-input type="text" wire:model="father_passport" class="form-control" id="father_passport"
                       :value="old('father_passport')" />
                   @error('Passport_ID_Father')
                       <div class="alert alert-danger">{{ $message }}</div>
                   @enderror
               </div>

               <div class="col">
                   <x-label for="father_phone" :value="__('parent.father_phone')" />
                   <x-input type="text" wire:model="father_phone" class="form-control" id="father_phone"
                       :value="old('father_phone')" />
                   @error('Phone_Father')
                       <div class="alert alert-danger">{{ $message }}</div>
                   @enderror
               </div>
           </div>


           <div class="row mb-4">
               <div class="form-group col">
                   <x-label for="father_nationality_id" :value="__('parent.father_nationality_id')" />
                   <select class="custom-select my-1 mr-sm-2" wire:model="father_nationality_id">
                       <option selected>{{ __('msgs.select', ['name' => '...']) }}</option>
                       @foreach ($nationalities as $nationality)
                           <option value="{{ $nationality->id }}">{{ $nationality->name }}</option>
                       @endforeach
                   </select>
                   @error('father_nationality_id')
                       <div class="alert alert-danger">{{ $message }}</div>
                   @enderror
               </div>
               <div class="form-group col">
                   <x-label for="father_blood_id" :value="__('parent.father_blood_id')" />
                   <label for="inputState">{{ __('parent.father_blood_id') }}</label>
                   <select class="custom-select my-1 mr-sm-2" wire:model="father_blood_id">
                       <option selected>{{ __('msgs.select', ['name' => '...']) }}</option>
                       @foreach ($bloods as $blood)
                           <option value="{{ $blood->id }}">{{ $blood->name }}</option>
                       @endforeach
                   </select>
                   @error('father_blood_id')
                       <div class="alert alert-danger">{{ $message }}</div>
                   @enderror
               </div>
               <div class="form-group col">
                   <x-label for="father_religion_id" :value="__('parent.father_religion_id')" />
                   <select class="custom-select my-1 mr-sm-2" wire:model="father_religion_id">
                       <option selected>{{ __('msgs.select', ['name' => '...']) }}</option>
                       @foreach ($religions as $religion)
                           <option value="{{ $religion->id }}">{{ $religion->name }}</option>
                       @endforeach
                   </select>
                   @error('father_religion_id')
                       <div class="alert alert-danger">{{ $message }}</div>
                   @enderror
               </div>
           </div>


           <div class="form-group">
               <x-label for="father_address" :value="__('parent.father_address')" />
               <textarea class="form-control" wire:model="father_address" id="father_address" rows="4"></textarea>
               @error('father_address')
                   <div class="alert alert-danger">{{ $message }}</div>
               @enderror
           </div>

           <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" wire:click="firstStepSubmit"
               type="button">{{ __('Parent_trans.Next') }}
           </button>

       </div>
   </div>
