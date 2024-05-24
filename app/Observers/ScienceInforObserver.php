<?php

namespace App\Observers;

use App\Models\ScienceInfor;
use Illuminate\Support\Str;

class ScienceInforObserver
{
    public function saving(ScienceInfor $scienceinfor)
    {
        $scienceinfor->title = Str::ucfirst($scienceinfor->title);
        $scienceinfor->slug = Str::slug($scienceinfor->title);
    }
}
