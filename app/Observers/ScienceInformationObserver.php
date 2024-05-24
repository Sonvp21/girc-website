<?php

namespace App\Observers;

use App\Models\ScienceInformation;
use Illuminate\Support\Str;

class ScienceInformationObserver
{
    public function saving(ScienceInformation $scienceinfor)
    {
        $scienceinfor->title = Str::ucfirst($scienceinfor->title);
        $scienceinfor->slug = Str::slug($scienceinfor->title);
    }
}
