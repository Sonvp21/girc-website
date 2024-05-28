<?php

namespace App\View\Components\Website;

use App\Enums\VideoSourceEnum;
use App\Models\Video;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ShowVideoStudy extends Component
{
    public function render(): View|Closure|string
    {
        $videos = Video::query()
            ->with('album')
            ->whereHas('album', function ($query) {
                $query->whereId(config('app.home_album_study_space_id'));
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

        $allVideos = $youtubeVideos->merge($googleDriveVideos);
        $latestVideo = $allVideos->sortByDesc('updated_at')->first();

        return view('components.website.show-video-study', [
            'youtubeVideos' => $youtubeVideos,
            'googleDriveVideos' => $googleDriveVideos,
            'latestVideo' => $latestVideo,
        ]);
    }
}
