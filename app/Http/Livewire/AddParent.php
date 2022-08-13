<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AddParent extends Component
{
    public function render()
    {
        return view('livewire.add-parent')->layout('layouts.master', ['header' => __('msgs.add', ['name' => __('parent.parent')])]);;
    }
}