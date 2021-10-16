<?php

use App\Jobs\ImportContacts;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

use Google\Cloud\Firestore\FirestoreClient;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Route::get('images/{id}/{size?}', ['as' => 'image', 'uses' => 'ImageController@get']);


Auth::routes();

Route::get('/quick-search', 'PagesController@quickSearch')->name('quick-search');
Route::middleware('auth:web')->group(function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/profile', 'HomeController@profile')->name('profile');
    Route::get('/letters/create/{id}', 'LetterController@create')->name('letters.create');
    Route::post('/letters/store/{id}', 'LetterController@store')->name('letters.store');
    Route::get('/letters/{type?}', 'LetterController@index')->name('letters.index');
    Route::get('/letters/files/{id}', 'LetterController@filesShow')->name('letters.files.show')->where('id', '[0-9]*');
    Route::get('/letters/files/pdf/{id}', 'LetterController@shareFilePdf')->name('letters.files.pdf')->where('id', '[0-9]*');
    Route::get('/letters/files/print/{id}', 'LetterController@shareFilePrint')->name('letters.files.print')->where('id', '[0-9]*');
    Route::get('/letters/files/{type?}', 'LetterController@files')->name('letters.files');

    Route::get('/albums/show/{id}', 'AlbumController@show')->name('albums.show');
    Route::get('/galleries', 'GalleryController@index')->name('galleries.index');

});

Route::get('test2', function () {

    $file  = \App\Models\LetterFile::find(10);
    \App\Jobs\UpdateFileImage::dispatch($file);
});
