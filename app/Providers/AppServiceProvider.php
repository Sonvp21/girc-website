<?php

namespace App\Providers;

use App\Models\Announcement;
use App\Models\Category;
use App\Models\Post;
use App\Models\ScienceInfor;
use App\Observers\AnnouncementObserver;
use App\Observers\ScienceInforObserver;
use App\Observers\CategoryObserver;
use App\Observers\PostObserver;
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
        ScienceInfor::observe(ScienceInforObserver::class);
        Category::observe(CategoryObserver::class);
        Post::observe(PostObserver::class);
    }
}
