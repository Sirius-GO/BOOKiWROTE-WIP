<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

//Route::get('/response', [App\Http\Controllers\BooksController::class, 'index']);

Auth::routes();
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/', [App\Http\Controllers\HomeController::class, 'index'])->name('search.books');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/admin', [App\Http\Controllers\HomeController::class, 'admin'])->name('admin');
Route::get('/book_details/{id}', [App\Http\Controllers\HomeController::class, 'book_details']);
Route::get('/stories/{id}', [App\Http\Controllers\HomeController::class, 'story'])->name('story');
Route::get('/shortstories', [App\Http\Controllers\HomeController::class, 'stories'])->name('stories');

//BOOK CRUD ROUTES
Route::get('/admin/mybooks', [App\Http\Controllers\HomeController::class, 'my_books'])->name('my.books');
Route::get('/admin/addbook', [App\Http\Controllers\HomeController::class, 'show_add_book'])->name('show.add.book');
Route::post('/admin/addbook', [App\Http\Controllers\HomeController::class, 'add_book'])->name('add.book');
Route::get('/admin/editbook/{id}', [App\Http\Controllers\HomeController::class, 'edit_book'])->name('edit.book');
Route::post('/admin/storebook', [App\Http\Controllers\HomeController::class, 'store_book'])->name('store.book');
Route::delete('/admin/deletebook/{id}', [App\Http\Controllers\HomeController::class, 'book_destroy'])->name('delete.book');

Route::get('/admin/mystories', [App\Http\Controllers\HomeController::class, 'my_stories'])->name('my.stories');
Route::get('/admin/myarticles', [App\Http\Controllers\HomeController::class, 'my_articles'])->name('my.articles');

//Book Purchase Links
Route::post('/admin/addbooklink', [App\Http\Controllers\HomeController::class, 'add_book_link'])->name('booklink.create');
Route::post('/admin/addbooklink/{id}', [App\Http\Controllers\HomeController::class, 'edit_book_link'])->name('booklink.edit');
Route::post('/admin/deletebooklink', [App\Http\Controllers\HomeController::class, 'delete_book_link'])->name('booklink.delete');

//Audio Previews
Route::post('/admin/addaudiopreview', [App\Http\Controllers\HomeController::class, 'add_audio_preview'])->name('audiopreview.create');
