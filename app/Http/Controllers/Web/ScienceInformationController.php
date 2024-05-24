<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\ScienceInformation;
use Illuminate\View\View;

class ScienceInformationController extends Controller
{
    public function index(): View
    {
        return view('web.scienceinfors.index', [
            'scienceinfors' => ScienceInformation::query()
                ->where('keep_on_top', 1)
                ->orderByDesc('published_at')
                ->paginate(6),
        ]);
    }

    public function show(ScienceInformation $scienceinfor): View
    {
        return view('web.scienceinfors.show', [
            'scienceinfor' => $scienceinfor,
        ]);
    }
}
