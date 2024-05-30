<?php

namespace App\View\Components\Website;

use App\Enums\VideoSourceEnum;
use App\Models\Video;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Cache;

class ScienceTechnology extends Component
{
    public function render(): View|Closure|string
    {
        $videos = Cache::remember('science_technology_videos', 60, function () {
            return Video::query()
                ->with('album')
                ->whereHas('album', function ($query) {
                    $query->whereId(config('app.home_album_science_and_technology_id'));
                })
                ->latest('updated_at')
                ->get();
        });

        $youtubeVideos = collect();
        $googleDriveVideos = collect();

        // Phân loại video dựa trên enum
        $videos->each(function ($video) use ($youtubeVideos, $googleDriveVideos) {
            if ($video->source === VideoSourceEnum::YOUTUBE) {
                $youtubeVideos->push($video);
            } elseif ($video->source === VideoSourceEnum::GOOGLE_DRIVE) {
                $googleDriveVideos->push($video);
            }
        });

        return view('components.website.science-technology', [
            'youtubeVideos' => $youtubeVideos,
            'googleDriveVideos' => $googleDriveVideos,
        ]);
    }
}
