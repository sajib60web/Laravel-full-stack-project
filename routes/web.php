<?php
Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|   ->where(['id' => '[0-9]+', 'name' => '[a-z]+']);
*/
Route::get('/', 'Frontend\FrontendController@index');
Route::get('/posts', 'Frontend\FrontendController@posts')->name('posts');


Route::get('/dashboard', 'Frontend\FrontendController@dashboard')->name('dashboard');
Route::get('/profile', 'Frontend\FrontendController@profile')->name('profile');

Route::get('/login', 'Frontend\FrontendController@showLoginForm')->name('login');
Route::post('/login', 'Frontend\FrontendController@login');
Route::get('/verify/{token}', 'Frontend\FrontendController@verifyEmail')->name('verify');
Route::get('/logout', 'Frontend\FrontendController@logout')->name('logout');
Route::get('/registration', 'Frontend\FrontendController@showRegistrationForm')->name('registration');
Route::post('/registration', 'Frontend\FrontendController@registration');

Route::get('/categories', 'Frontend\CategoryController@index')->name('categories.index');
Route::get('/categories/create', 'Frontend\CategoryController@create')->name('categories.create');
Route::post('/categories', 'Frontend\CategoryController@store')->name('categories.store');
Route::get('/categories/{id}', 'Frontend\CategoryController@show')->name('categories.show');
Route::get('/categories/{id}/edit', 'Frontend\CategoryController@edit')->name('categories.edit');
Route::put('/categories/{id}', 'Frontend\CategoryController@update')->name('categories.update');
Route::delete('/categories/{id}', 'Frontend\CategoryController@destroy')->name('categories.destroy');

Route::get('/posts', 'Frontend\PostController@index')->name('posts.index');
Route::get('/posts/create', 'Frontend\PostController@create')->name('posts.create');
Route::post('/posts', 'Frontend\PostController@store')->name('posts.store');
Route::get('/posts/{id}', 'Frontend\PostController@show')->name('posts.show');
Route::get('/posts/{id}/edit', 'Frontend\PostController@edit')->name('posts.edit');
Route::put('/posts/{id}', 'Frontend\PostController@update')->name('posts.update');
Route::delete('/posts/{id}', 'Frontend\PostController@destroy')->name('posts.destroy');


