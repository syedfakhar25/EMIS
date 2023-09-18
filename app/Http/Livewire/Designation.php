<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Designation extends Component
{

    public $ottPlatform = '';

    public $webseries = [
        'Wanda Vision',
        'Money Heist',
        'Lucifer',
        'Stranger Things'
    ];

    public $department_id = 5;

    public function render()
    {
        return view('livewire.designation');
    }

    public function getDesignationForDepartment($dep_id)
    {
//        dd($dep_id);
        $this->department_id = $dep_id;
    }
}
