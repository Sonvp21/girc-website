<?php

namespace App\Observers;

use App\Models\Video;
use App\Services\VideoService;

class VideoObserver
{
    public function __construct(
        public VideoService $VideoService
    ) {
    }

    public function saving(Video $Video): void
    {
        $this->VideoService->deletecachedVideosForHome();
    }

    public function saved(Video $Video): void
    {
        $this->VideoService->cachedVideosForHome();
    }

    public function deleted(Video $Video): void
    {
        $this->VideoService->deletecachedVideosForHome();
    }
}
