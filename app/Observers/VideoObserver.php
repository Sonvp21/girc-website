<?php

namespace App\Observers;

use App\Models\Video;
use App\Services\VideoService;

class VideoObserver
{
    public function __construct(
        public VideoService $videoService
    ) {
    }

    public function saving(Video $Video): void
    {
        $this->videoService->deletecachedVideosForHome();
    }

    public function saved(Video $Video): void
    {
        $this->videoService->cachedVideosForHome();
    }

    public function deleted(Video $Video): void
    {
        $this->videoService->deletecachedVideosForHome();
    }
}
