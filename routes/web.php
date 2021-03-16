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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/confirm', 'Auth\VerificationController@verify')->name('confirm');
Route::group(['namespace' => 'User','middleware' => ['user']], function () {
  Route::get('/home','ProductController@index')->name('home');
  Route::post('/payment', 'PaymentController@payment')->name('payment');
  Route::get('/payment/success/{id}','PaymentController@success')->name('success');
  Route::get('/payment/cancel/','PaymentController@cancel')->name('cancel');

});

Route::group(['prefix' => 'admin','namespace' => 'Admin','as' => 'admin.','middleware' => ['admin']],
	function () {
    Route::get('/home','HomeController@index')->name('home');
	Route::get('/user', 'UserController@index')->name('user');
	Route::get('/user/block/{id}', 'UserController@block')->name('user.block');
    Route::get('/user/unblock/{id}', 'UserController@unblock')->name('user.unblock');
	Route::get('/categories', 'CategoryController@index')->name('categories');

	Route::get('/categories/delete/{id}', 'CategoryController@delete')->name('categories.delete');

    Route::get('/categories/update/{id}', 'CategoryController@update')->name('categories.update');  

    Route::get('/category/create', 'CategoryController@create')->name('category.create'); 

    Route::post('/category/store', 'CategoryController@store')->name('category.store');    
    Route::post('/category/edit/{id}', 'CategoryController@edit')->name('category.edit');
});
