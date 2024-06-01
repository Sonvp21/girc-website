<?php

namespace App\View\Components\Website;

use App\Enums\StaffCategoryEnum;
use App\Models\Staff as ModelStaff;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Staff extends Component
{
    public $categories;

    public $staffs;

    public $selectedCategory;

    public function __construct()
    {
        $this->categories = StaffCategoryEnum::cases();
        $this->staffs = ModelStaff::all();
        $this->selectedCategory = null;
    }

    public function render(): View|Closure|string
    {
        return view('components.website.staff', [
            'categories' => $this->categories,
            'staffs' => $this->staffs,
            'selectedCategory' => $this->selectedCategory,
        ]);
    }
}
