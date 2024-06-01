<?php

namespace App\Livewire\Website;

use Illuminate\View\View;
use Livewire\Component;

class StaffDetail extends Component
{
    public bool $myModal2 = false;

    public function render(): View
    {
        return view('livewire.website.staff-detail');
    }
}
