<?php

namespace App\View\Components\Website;

use App\Models\Cooperation as CooperationModel;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Cooperation extends Component
{
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view(
            'components.website.cooperation',
            [
                'cooperations' => CooperationModel::query()
                    ->with('media')
                    ->get()
                    ->shuffle(),
            ]
        );
    }
}
