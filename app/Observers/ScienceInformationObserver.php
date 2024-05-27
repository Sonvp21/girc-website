<?php

namespace App\Observers;

use App\Models\ScienceInformation;
use Illuminate\Support\Str;

class ScienceInformationObserver
{
    public function saving(ScienceInformation $scienceinformation)
    {
        $scienceinformation->title = Str::ucfirst($scienceinformation->title);
        $scienceinformation->slug = Str::slug($scienceinformation->title);
    }
}
