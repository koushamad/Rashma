<?php

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


use App\Notifications\SendMessage;
use Illuminate\Support\Facades\Notification;
use Mpociot\ApiDoc\ApiDoc;

Route::get('/', function () {
    return view('index');
})->name('welcome');

Route::get('/transaction/cashIn','TransactionController@cashIn')->name('cash-in-view');
Route::post('/transaction/cashInApprove','TransactionController@cashInApprove')->name('cash-in-approve');

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/admin', 'HomeController@index')->name('admin');
    ApiDoc::routes("/apidoc");
});

