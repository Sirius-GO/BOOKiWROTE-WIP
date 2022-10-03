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
Route::get('/contact', [App\Http\Controllers\HomeController::class, 'contact'])->name('contact');
Route::post('/contact', ['as' => 'contact.form', 'uses' => 'App\Http\Controllers\HomeController@contact_form']);

//Policies
Route::get('/privacy', [App\Http\Controllers\HomeController::class, 'privacy'])->name('privacy');


//BOOK ADMIN CRUD ROUTES
Route::get('/admin/mybooks', [App\Http\Controllers\HomeController::class, 'my_books'])->name('my.books');
Route::get('/admin/addbook', [App\Http\Controllers\HomeController::class, 'show_add_book'])->name('show.add.book');
Route::post('/admin/addbook', [App\Http\Controllers\HomeController::class, 'add_book'])->name('add.book');
Route::get('/admin/editbook/{id}', [App\Http\Controllers\HomeController::class, 'edit_book'])->name('edit.book');
Route::post('/admin/storebook', [App\Http\Controllers\HomeController::class, 'store_book'])->name('store.book');
Route::delete('/admin/deletebook/{id}', [App\Http\Controllers\HomeController::class, 'book_destroy'])->name('delete.book');
Route::get('/admin/undeletebook/{id}', [App\Http\Controllers\HomeController::class, 'book_undestroy'])->name('book.undelete');

//MESSAGES
Route::get('/admin/message_form', [App\Http\Controllers\HomeController::class, 'message_form'])->name('message');
Route::post('/admin/message_form', ['as' => 'store.message', 'uses' => 'App\Http\Controllers\HomeController@store_message']);
Route::get('/admin/view_messages/{id}', [App\Http\Controllers\HomeController::class, 'view_messages'])->name('view.message');
Route::post('/admin/reply_to_message', [App\Http\Controllers\HomeController::class, 'reply_messages'])->name('reply.message');
Route::get('/admin/reply_to_message', [App\Http\Controllers\HomeController::class, 'reply_messages'])->name('reply.message');
Route::get('/admin/reply', [App\Http\Controllers\HomeController::class, 'send_reply_message'])->name('reply');


//STORIES ROUTES
Route::get('/stories/{id}', [App\Http\Controllers\HomeController::class, 'story'])->name('story');
Route::get('/shortstories', [App\Http\Controllers\HomeController::class, 'stories'])->name('stories');
//Stories Admin
Route::get('/admin/mystories', [App\Http\Controllers\HomeController::class, 'my_stories'])->name('my.stories');

//Article Routes
Route::get('/article/{id}', [App\Http\Controllers\HomeController::class, 'article'])->name('article');
Route::get('/articles', [App\Http\Controllers\HomeController::class, 'articles'])->name('articles');
Route::get('/admin/myarticles', [App\Http\Controllers\HomeController::class, 'my_articles'])->name('my.articles');
Route::get('/admin/add_article', [App\Http\Controllers\HomeController::class, 'show_add_article'])->name('add.article');
Route::post('/admin/add_article', [App\Http\Controllers\HomeController::class, 'store_article'])->name('store.article');
Route::get('/admin/edit_article/{id}', [App\Http\Controllers\HomeController::class, 'edit_article'])->name('edit.article');
Route::post('/admin/update_article/{id}', [App\Http\Controllers\HomeController::class, 'update_article'])->name('update.article');


//Authors
Route::get('/all_authors', [App\Http\Controllers\HomeController::class, 'all_authors'])->name('authors');
Route::get('/ind_author/{id}', [App\Http\Controllers\HomeController::class, 'show_author'])->name('show.author');
//Authors Admin
Route::get('/admin/author/{id}', [App\Http\Controllers\HomeController::class, 'author'])->name('author');
Route::get('/admin/authors', [App\Http\Controllers\HomeController::class, 'authors'])->name('all.authors');
Route::get('/admin/add_author', [App\Http\Controllers\HomeController::class, 'show_add_author'])->name('add.author');
Route::post('/admin/add_author', [App\Http\Controllers\HomeController::class, 'store_author'])->name('store.author');
Route::get('/admin/edit_author/{id}', [App\Http\Controllers\HomeController::class, 'edit_author'])->name('edit.author');
Route::post('/admin/update_author/{id}', [App\Http\Controllers\HomeController::class, 'update_author'])->name('update.author');

//Book Purchase Links
Route::post('/admin/addbooklink', [App\Http\Controllers\HomeController::class, 'add_book_link'])->name('booklink.create');
Route::post('/admin/addbooklink/{id}', [App\Http\Controllers\HomeController::class, 'edit_book_link'])->name('booklink.edit');
Route::post('/admin/deletebooklink', [App\Http\Controllers\HomeController::class, 'delete_book_link'])->name('booklink.delete');

//Audio Previews
Route::post('/admin/addaudiopreview', [App\Http\Controllers\HomeController::class, 'add_audio_preview'])->name('audiopreview.create');
