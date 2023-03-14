<?php

use Cornatul\News\Http\Controllers\NewsController;

Route::group(['middleware' => ['web','auth'],'prefix' => 'news', 'as' => 'news.'], static function () {

    //generate a route for the news contraoller
    Route::get('/', [NewsController::class, 'index'])->name('index');
});
