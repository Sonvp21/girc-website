<?php

namespace App\View\Components\Website;

use App\Models\ScienceInformation;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ScienceInformations extends Component
{
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.website.science-informations', [
            'scienceInformations' => ScienceInformation::query()
                ->where('keep_on_top', 1)
                ->orderByDesc('published_at')
                ->take(4)
                ->get(),
        ]);
    }
}
