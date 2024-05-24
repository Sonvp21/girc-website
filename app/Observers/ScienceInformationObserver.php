<?php

namespace App\Observers;

use App\Models\ScienceInformation;
use Illuminate\Support\Str;

class ScienceInformationObserver
{
    public function saving(ScienceInformation $scienceInformation)
    {
        $scienceInformation->title = Str::ucfirst($scienceInformation->title);
        $scienceInformation->slug = Str::slug($scienceInformation->title);
    }
}
