<?php

Route::group(['prefix' => 'ajax', 'namespace' => 'Ajax'], function () {
    Route::resource('posts', 'PostController')->names([
        'index' => 'ajax.posts.index',
        'store' => 'ajax.posts.store',
        'show' => 'ajax.posts.show',
        'update' => 'ajax.posts.update',
        'destroy' => 'ajax.posts.destroy',
    ]);

    Route::resource('posts.comments', 'PostCommentController')->names([
        'index' => 'ajax.posts.comments.index',
        'store' => 'ajax.posts.comments.store',
        'show' => 'ajax.posts.comments.show',
        'update' => 'ajax.posts.comments.update',
        'destroy' => 'ajax.posts.comments.destroy',
    ]);
    
    Route::patch('profile/{user}', 'ProfileController@update')->name('profile.update');
    Route::post('profile/{user}/image-upload', 'ProfileController@imageUpload')->name('profile.image_upload');
});