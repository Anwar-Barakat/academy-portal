<?php

namespace App\Http\Livewire;

use App\Models\Blood;
use App\Models\Nationality;
use App\Models\Religion;
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
        $this->currentStep = 2;
    }

    public function secondStepSubmit()
    {
        $this->currentStep = 3;
    }

    public function back($step)
    {
        $this->currentStep = $step;
    }
}
