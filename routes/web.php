<?php

use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\NewsController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');
Route::get('/tin-tuc', [NewsController::class, 'index'])->name('news.index');
Route::get('/tin-tuc/{post:slug}', [NewsController::class, 'show'])->name('news.show');

require __DIR__.'/admin.php';
