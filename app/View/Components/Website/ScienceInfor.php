<?php

namespace App\View\Components\Website;

use App\Models\ScienceInfor as ScienceInforModel;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ScienceInfor extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.website.science-infor', [
            'scienceinfors' => ScienceInforModel::query()
                ->where('keep_on_top', 1)
                ->orderByDesc('published_at')
                ->take(4)
                ->get(),
        ]);

    }
}
