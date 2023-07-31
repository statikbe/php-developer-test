<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('pages/welcome');
})->name('home');

Route::get('/nasa', 'App\Http\Controllers\NasaPictures@showLastNPicturesOfTheDay')->name('overview30');

Route::get('/nasa/{day}', 'App\Http\Controllers\NasaPictures@getPictureOfTheDay')->name('singlePicture');

Route::get('/random-cat', function () {
    return view('pages/randomCat');
})->name('randomCat');


// Route::get('/addlike', 'App\Http\Controllers\NasaPictures@addLikes')->name('addLike');
Route::post('/addlike/{id}', 'App\Http\Controllers\NasaPictures@addLikes')->name('addLike');

