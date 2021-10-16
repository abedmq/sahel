<?php


Auth::routes();

Route::middleware("auth:admin", 'admin_lang')->group(function () {
    Route::post('images/upload', 'ImagesController@upload')->name('upload.image');
    Route::get('images/remove', 'ImagesController@remove')->name('images.remove');
    Route::post('images/upload/image-ckeditor', 'ImagesController@uploadImageCK')->name('images.upload.ckeditor');

    Route::get('profiles', 'ProfileController@index')->name('profiles.index');
    Route::post('profiles/update', 'ProfileController@update')->name('profiles.update');
    Route::get('/', "HomeController@index")->name('home');

    Route::resourceAdmin('users', 'UserController');
    Route::resourceAdmin('letters', 'LetterController');
    Route::resourceAdmin('invitations', 'InvitationController');
    Route::resourceAdmin('thanks', 'ThankController');
    Route::resourceAdmin('attachments', 'AttachmentController');
    Route::resourceAdmin('galleries', 'GalleryController');
    Route::resourceAdmin('albums', 'AlbumController');

    Route::resourceAdmin('providers', 'ProviderController');

    Route::resourceAdmin('languages', 'LanguageController');

    Route::get('/settings', 'SettingsController@index')->name('settings.index');
    Route::post('/settings', 'SettingsController@update')->name('settings.update');
});
