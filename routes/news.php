<?php

use Cornatul\News\Http\Controllers\NewsController;

Route::group(['middleware' => ['web','auth'],'prefix' => 'news', 'as' => 'news.'], static function () {

    //generate a route for the news contraoller
    Route::get('/index', [NewsController::class, 'index'])->name('index');
    Route::get('/topic/{topic}', [NewsController::class, 'topic'])->name('topic');

    Route::get('/show/{url}', [NewsController::class, 'show'])->name('show');
    Route::get('/extract/{url}', [NewsController::class, 'extract'])->name('extract');

    //generate the route for googleNews
    Route::get('/trending', [NewsController::class, 'trending'])->name('trending');
});

