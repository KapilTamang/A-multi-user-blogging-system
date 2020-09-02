<?php

use Illuminate\Support\Facades\Route;
use RealRashid\SweetAlert\Facades\Alert;

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

Route::get('/', 'BlogController@index');

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/blogs', 'BlogController@index')->name('blogs');

Route::get('/blogs/create', 'BlogController@create')->name('blogs.create');

Route::post('/blogs/store', 'BlogController@store')->name('blogs.store');

//Trahsed Routes

Route::get('/blogs/trash', 'BlogController@trash')->name('blogs.trash');

Route::get('/blogs/trash/{id}/restore', 'BlogController@restore')->name('blogs.restore');

Route::delete('/blogs/trash/permanent-delete/{id}', 'BlogController@permanentDelete')->name('blogs.permanent-delete');

 
Route::get('/blogs/{id}', 'BlogController@show')->name('blogs.show');

Route::get('/blogs/{id}/edit', 'BlogController@edit')->name('blogs.edit'); 

Route::patch('/blogs/{id}/{keyword}/update', 'BlogController@update')->name('blogs.update');

Route::delete('/blogs/delete/{id}', 'BlogController@delete')->name('blogs.delete');

Route::post('/blogs/search', 'BlogController@searchResult')->name('blogs.search');

//Admin Routes

Route::get('/admin', 'AdminController@index')->name('admin.index');

Route::get('/admin/blogs', 'AdminController@blogs')->name('admin.blogs');

Route::get('/admin/blogs/{id}/user', 'AdminController@adminBlogs')->name('admin.blogs.user');

Route::get('/admin/blogs/{id}/edit', 'BlogController@edit')->name('admin.blogs.edit');

Route::get('/admin/create', 'AdminController@create')->name('admin.create');

Route::get('/admin/dashboard', 'AdminController@dashboard')->name('admin.dashboard');

Route::get('/admin/users', 'AdminController@users')->name('admin.users');

Route::get('/admin/categories', 'AdminController@categories')->name('admin.categories');

Route::get('/admin/categories/create', 'AdminController@createCategory')->name('admin.categories.create');

Route::get('/admin/trash', 'AdminController@trash')->name('admin.trash');

Route::get('/admin/{id}/profile', 'AdminController@getProfile')->name('admin.profile');

Route::get('/admin/users/{id}/profile', 'AdminController@getUserProfile')->name('admin.users.profile');

//Users Route

Route::get('/user/{id}/blogs', 'UserController@userBlogs')->name('user.blogs');

Route::delete('/user/delete/{id}', 'UserController@delete')->name('user.delete');

Route::patch('/user/{id}/{keyword}/update', 'UserController@update')->name('user.update');

// Route Author

Route::get('/authors', 'AuthorController@index')->name('author.index');

Route::get('/author/{id}/show', 'AuthorController@show')->name('author.show');

//Resource Routes

Route::resource('categories', 'CategoryController');

//Route Group File-Manager

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
}); 

//Contact Routes
Route::get('/contact', 'ContactController@contact')->name('contact');

Route::post('/contact/send', 'ContactController@send')->name('mail.send');

Route::get('/alert', function() {
    Alert::success('Signed in successfully', 'success');
    return view('alert');
});

// Socialite route
Route::get('/login/{provider}', 'SocialAuthController@redirectToProvider')->name('login.social');
Route::get('/login/{provider}/callback', 'SocialAuthController@handleProviderCallback')->name('login.social.callback');
