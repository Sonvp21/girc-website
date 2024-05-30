<?php

namespace App\Providers;

use App\Models\Announcement;
use App\Models\Category;
use App\Models\Post;
use App\Models\ScienceInformation;
use App\Models\Video;
use App\Observers\AnnouncementObserver;
use App\Observers\CategoryObserver;
use App\Observers\VideoObserver;
use App\Observers\PostObserver;
use App\Observers\ScienceInformationObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Announcement::observe(AnnouncementObserver::class);
        ScienceInformation::observe(ScienceInformationObserver::class);
        Category::observe(CategoryObserver::class);
        Post::observe(PostObserver::class);
        Video::observe(VideoObserver::class);
    }
}
