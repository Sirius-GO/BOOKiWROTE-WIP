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
Route::get('/admin/add_story', [App\Http\Controllers\HomeController::class, 'show_add_story'])->name('add.story');
Route::post('/admin/add_story', [App\Http\Controllers\HomeController::class, 'store_story'])->name('store.story');
Route::get('/admin/edit_story/{id}', [App\Http\Controllers\HomeController::class, 'edit_story'])->name('edit.story');
Route::post('/admin/update_story/{id}', [App\Http\Controllers\HomeController::class, 'update_story'])->name('update.story');
Route::post('changeImage', [App\Http\Controllers\HomeController::class, 'storyImageChange'])->name('cover.change');
Route::delete('/admin/deletestory/{id}', [App\Http\Controllers\HomeController::class, 'story_destroy'])->name('delete.story');
Route::get('/admin/undeletestory/{id}', [App\Http\Controllers\HomeController::class, 'story_undestroy'])->name('story.undelete');


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
Route::post('/addbooklink', [App\Http\Controllers\HomeController::class, 'add_book_link'])->name('booklink.create');
Route::post('/admin/deletebooklink', [App\Http\Controllers\HomeController::class, 'delete_book_link'])->name('booklink.delete');

//Account settings
Route::get('/admin/account', [App\Http\Controllers\HomeController::class, 'myAccount']);
Route::post('updateaccount', ['as' => 'UpdateDetails.account', 'uses' => 'App\Http\Controllers\HomeController@updateAccount']);
Route::post('changepassword', ['as' => 'ChangePassword.account', 'uses' => 'App\Http\Controllers\HomeController@changePassword']);

//Narrators
Route::get('/admin/narrator/{id}', [App\Http\Controllers\HomeController::class, 'narrator'])->name('narrator');
Route::get('/all_narrators', [App\Http\Controllers\HomeController::class, 'all_narrators'])->name('narrators');
Route::get('/ind_narrator/{id}', [App\Http\Controllers\HomeController::class, 'show_narrator'])->name('show.narrator');
//Narrator Admin
Route::get('/admin/add_narrator', [App\Http\Controllers\HomeController::class, 'show_add_narrator'])->name('add.narrator');
Route::post('/admin/add_narrator', [App\Http\Controllers\HomeController::class, 'store_narrator'])->name('store.narrator');
Route::get('/admin/edit_narrator/{id}', [App\Http\Controllers\HomeController::class, 'edit_narrator'])->name('edit.narrator');
Route::post('/admin/update_narrator/{id}', [App\Http\Controllers\HomeController::class, 'update_narrator'])->name('update.narrator');

//Narrator Links
Route::post('/addnarratorlink', [App\Http\Controllers\HomeController::class, 'add_narrator_link'])->name('narratorlink.create');
Route::post('/editnarratorlink', [App\Http\Controllers\HomeController::class, 'edit_narrator_link'])->name('narratorlink.edit');
Route::delete('/narrator_delete', [App\Http\Controllers\HomeController::class, 'narrator_delete'])->name('narrator.delete');

//Author Other Links
Route::post('olink_create', ['App\Http\Controllers\HomeController@create_author_link'])->name('authorlink.create');
Route::post('/olink_edit', ['App\Http\Controllers\HomeController@edit_author_link'])->name('authorlink.edit');
Route::delete('/olink_delete', ['App\Http\Controllers\HomeController@delete_author_link'])->name('authorlink.delete');

//Audio Previews
Route::post('/admin/addaudiopreview', [App\Http\Controllers\HomeController::class, 'add_audio_preview'])->name('audiopreview.create');
Route::post('edit_audiobook_preview/{id}', [App\Http\Controllers\HomeController::class, 'editAudiobookPreview'])->name('audiopreview.edit');
Route::get('delete_audiobook_preview/{id}', [App\Http\Controllers\HomeController::class, 'deleteAudiobookPreview'])->name('audiopreview.delete');
