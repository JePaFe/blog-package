<?php

Route::group(['middleware' => 'web', 'namespace' => 'JePaFe\Blog\Http\Controllers'], function() {
    Route::get('/blog', 'BlogController@index')->name('blog.index');
    Route::get('/blog/{slug}', 'BlogController@show')->name('blog.show');

    Route::group(['prefix' => 'admin'], function () {
        Route::name('admin')->resource('/posts', 'PostController');
    });
});

