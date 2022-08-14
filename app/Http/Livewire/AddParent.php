<?php

namespace App\Http\Livewire;

use App\Models\Blood;
use App\Models\MyParent;
use App\Models\Nationality;
use App\Models\Religion;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\Component;

class AddParent extends Component
{
    public $currentStep = 1,
        $email,
        $password,
        // father varibales :
        $father_name_ar,
        $father_name_en,
        $father_job_ar,
        $father_job_en,
        $father_passport,
        $father_identification,
        $father_phone,
        $father_nationality_id,
        $father_blood_id,
        $father_religion_id,
        $father_address,
        // mother varibales :
        $mother_name_ar,
        $mother_name_en,
        $mother_job_ar,
        $mother_job_en,
        $mother_passport,
        $mother_identification,
        $mother_phone,
        $mother_nationality_id,
        $mother_blood_id,
        $mother_religion_id,
        $mother_address;


    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'email'                     => 'required|email|unique:my_parents,email',
            'password'                  => 'required|min:8',
            'father_name_ar'            => 'required|min:3',
            'father_name_en'            => 'required|min:3',
            'father_job_ar'             => 'required|min:3',
            'father_job_en'             => 'required|min:3',
            'father_passport'           => 'required|min:10|max:10|unique:my_parents,father_passport',
            'father_identification'     => 'required|min:10|max:10|unique:my_parents,father_identification',
            'father_phone'              => 'required|min:10|max:10|unique:my_parents,father_phone',
            'father_nationality_id'     => 'required',
            'father_blood_id'           => 'required',
            'father_religion_id'        => 'required:in:1,2,3',
            'father_address'            => 'required|min:10',
        ]);
    }

    public function render()
    {
        return view('livewire.add-parent', [
            'nationalities'     => Nationality::all(),
            'bloods'            => Blood::all(),
            'religions'         => Religion::all(),
        ])->layout(
            'layouts.master',
            ['header' => __('msgs.add', ['name' => __('parent.parent')])]
        );;
    }

    public function firstStepSubmit()
    {
        $this->validate([
            'email'                     => ['required', 'email', 'unique:my_parents,email,' . $this->id],
            'password'                  => 'required|min:8',
            'father_name_ar'            => 'required|min:3',
            'father_name_en'            => 'required|min:3',
            'father_job_ar'             => 'required|min:3',
            'father_job_en'             => 'required|min:3',
            'father_passport'           => ['required', 'min:10', 'max:10', 'unique:my_parents,father_passport,' . $this->id],
            'father_identification'     => ['required', 'min:10', 'max:10', 'unique:my_parents,father_identification,' . $this->id],
            'father_phone'              => ['required', 'min:10', 'max:10', 'unique:my_parents,father_phone,' . $this->id],
            'father_nationality_id'     => 'required',
            'father_blood_id'           => 'required',
            'father_religion_id'        => 'required:in:1,2,3',
            'father_address'            => 'required|min:10',
        ]);

        $this->currentStep = 2;
    }

    public function secondStepSubmit()
    {
        $this->validate([
            'mother_name_ar'            => 'required|min:3',
            'mother_name_en'            => 'required|min:3',
            'mother_job_ar'             => 'required|min:3',
            'mother_job_en'             => 'required|min:3',
            'mother_passport'           => ['required', 'min:10', 'max:10', 'unique:my_parents,mother_passport,' . $this->id],
            'mother_identification'     => ['required', 'min:10', 'max:10', 'unique:my_parents,mother_identification,' . $this->id],
            'mother_phone'              => ['required', 'min:10', 'max:10', 'unique:my_parents,mother_phone,' . $this->id],
            'mother_nationality_id'     => 'required',
            'mother_blood_id'           => 'required',
            'mother_religion_id'        => 'required:in:1,2,3',
            'mother_address'            => 'required|min:10',
        ]);
        $this->currentStep = 3;
    }

    public function back($step)
    {
        $this->currentStep = $step;
    }
}
