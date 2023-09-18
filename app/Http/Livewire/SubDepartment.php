<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SubDepartment extends Component
{
    public function render()
    {
        return view('livewire.sub-department');
    }

    public function departmentValue($x)
    {
        dd($x);
    }
}
