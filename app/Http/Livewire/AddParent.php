<?php

namespace App\Http\Livewire;

use App\Models\Blood;
use App\Models\Nationality;
use App\Models\Religion;
use Livewire\Component;

class AddParent extends Component
{
    public $currentStep = 1;
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
}