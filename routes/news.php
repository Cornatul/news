<?php

use Cornatul\News\Http\Controllers\NewsController;

Route::group(['middleware' => ['web','auth'],'prefix' => 'news', 'as' => 'news.'], static function () {

    //generate a route for the news contraoller
    Route::get('/{topic?}', [NewsController::class, 'index'])->name('index');
    Route::get('/topic/{topic}', [NewsController::class, 'topic'])->name('topic');

    Route::get('/show/{url}', [NewsController::class, 'show'])->name('show');

    //generate the route for googleNews


});

