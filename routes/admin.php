<?php

use App\Http\Controllers\Admin\Album\CooperationController;
use App\Http\Controllers\Admin\Album\PhotoController;
use App\Http\Controllers\Admin\Album\VideoController;
use App\Http\Controllers\Admin\AlbumController;
use App\Http\Controllers\Admin\AnnouncementController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\RichTextAttachmentController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('posts', PostController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('tags', TagController::class);

        Route::resource('announcements', AnnouncementController::class);
        //album-photo-video
        Route::resource('albums', AlbumController::class);
        Route::resource('photos', PhotoController::class);
        Route::resource('videos', VideoController::class);
        Route::resource('cooperations', CooperationController::class);

        //contact
        Route::resource('contacts', ContactController::class);
        //faq
        Route::resource('faqs', FaqController::class);

        Route::post('rich-text-attachment', RichTextAttachmentController::class)->name('rich-text.attachment');
    });
});

require __DIR__.'/auth.php';
