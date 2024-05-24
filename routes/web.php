<?php

use App\Http\Controllers\Web\AnnouncementsController;
use App\Http\Controllers\Web\ContactController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\NewsController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');
Route::get('/tin-tuc', [NewsController::class, 'index'])->name('news.index');
Route::get('/tin-tuc/{post:slug}', [NewsController::class, 'show'])->name('news.show');
Route::get('/thong-bao', [AnnouncementsController::class, 'index'])->name('announcements.index');
Route::get('/thong-bao/{announcement:slug}', [AnnouncementsController::class, 'show'])->name('announcements.show');

Route::get('/lien-he', [ContactController::class, 'index'])->name('contacts.index');
Route::post('/lien-he', [ContactController::class, 'store'])->name('contacts.store');

Route::get('/gioi-thieu', fn () => view('web.about'))->name('about');

require __DIR__.'/admin.php';
