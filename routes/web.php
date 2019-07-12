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

//Start Custom Auth Controller
Route::get('/dashboard', 'Auth\CustomAuthController@dashboard')->name('dashboard');
Route::get('/profile', 'Auth\CustomAuthController@profile')->name('profile');
Route::get('/login', 'Auth\CustomAuthController@showLoginForm')->name('login');
Route::post('/login', 'Auth\CustomAuthController@login');
Route::get('/verify/{token}', 'Auth\CustomAuthController@verifyEmail')->name('verify');
Route::get('/logout', 'Auth\CustomAuthController@logout')->name('logout');
Route::get('/registration', 'Auth\CustomAuthController@showRegistrationForm')->name('registration');
Route::post('/registration', 'Auth\CustomAuthController@registration');
//End Custom Auth Controller

Route::get('/categories', 'Backend\CategoryController@index')->name('categories.index');
Route::get('/categories/create', 'Backend\CategoryController@create')->name('categories.create');
Route::post('/categories', 'Backend\CategoryController@store')->name('categories.store');
Route::get('/categories/{id}', 'Backend\CategoryController@show')->name('categories.show');
Route::get('/categories/{id}/edit', 'Backend\CategoryController@edit')->name('categories.edit');
Route::put('/categories/{id}', 'Backend\CategoryController@update')->name('categories.update');
Route::delete('/categories/{id}', 'Backend\CategoryController@destroy')->name('categories.destroy');

Route::get('/posts', 'Backend\PostController@index')->name('posts.index');
Route::get('/posts/create', 'Backend\PostController@create')->name('posts.create');
Route::post('/posts', 'Backend\PostController@store')->name('posts.store');
Route::get('/posts/{id}', 'Backend\PostController@show')->name('posts.show');
Route::get('/posts/{id}/edit', 'Backend\PostController@edit')->name('posts.edit');
Route::put('/posts/{id}', 'Backend\PostController@update')->name('posts.update');
Route::delete('/posts/{id}', 'Backend\PostController@destroy')->name('posts.destroy');


