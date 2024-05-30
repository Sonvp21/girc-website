<?php

namespace App\View\Components\Website;

use App\Enums\VideoSourceEnum;
use App\Models\Video;
use App\Services\VideoService;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Infrastructure extends Component
{
    public function __construct(
        public VideoService $videoService
    ) {
    }

    public function render(): View|Closure|string
    {
        $videos = Video::query()
            ->with('album')
            ->whereHas('album', function ($query) {
                $query->whereId(config('app.home_album_infrastructure_id'));
            })
            ->latest('updated_at')
            ->get();
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

        return view('components.website.infrastructure', [
            'youtubeVideos' => $youtubeVideos,
            'googleDriveVideos' => $googleDriveVideos,
            'videos' => $this->videoService->cachedVideosForHome(),
        ]);
    }
}
