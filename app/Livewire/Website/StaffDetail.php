<?php

namespace App\Livewire\Website;

use App\Enums\StaffCategoryEnum;
use App\Models\Staff;
use Livewire\Attributes\Layout;
use Livewire\Component;

class StaffDetail extends Component
{
    public $categories;

    public $staffs;

    public $selectedCategory;

    public $isModalOpen = false;

    public $currentIndex = 0;

    #[Layout('layouts.website')]
    public function mount()
    {
        $this->categories = StaffCategoryEnum::cases();
        $this->staffs = collect();
    }

    public function showStaffDetail($categoryValue)
    {
        $this->staffs = Staff::where('category', $categoryValue)->get();
        $this->selectedCategory = collect($this->categories)->firstWhere('value', $categoryValue)->value;
        $this->currentIndex = 0; // Reset to first staff
        $this->isModalOpen = true;
    }

    public function showNextStaff()
    {
        $this->currentIndex = ($this->currentIndex + 1) % $this->staffs->count();
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
    }

    public function render()
    {
        return view('livewire.website.staff-detail');
    }
}
