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

/*
 * Login routes
 */
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::get('yandex', 'Auth\LoginController@yandex')->name('yandex');
Route::post('yandex-auth', 'Auth\LoginController@yandexLogin')->name('yandex-login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('login/google', 'Auth\LoginController@redirectToProvider');
Route::get('login/google/callback', 'Auth\LoginController@handleProviderCallback');


Route::get('/', 'HomeController@index')->name('home');
Route::get('/sequences', 'HomeController@sequences')->name('sequences');


Route::get('/get-user', 'HomeController@getUser');

/*
 * Api routes
 */

Route::post('/api/create-sequences', 'Api\SequencesController@create');
Route::post('/api/send-myself', 'Api\SequencesController@sendMyself');
Route::get('/api/get-sequences', 'Api\SequencesController@getAll');
Route::post('/api/save-sequence', 'Api\SequencesController@save');
Route::post('/api/del-sequence', 'Api\SequencesController@delete');
Route::get('/api/get-stat', 'HomeController@getStat');
Route::get('/api/get-recepients', 'HomeController@getRecepients');
Route::get('/api/checked/{recepient_id}', 'Api\SequencesController@checked');

Route::post('/api/add-recepient', 'Api\SequencesController@addRecepient');

Route::post('/api/extension-send', 'Api\SequencesController@extension');
Route::post('/api/extension-login', 'Api\SequencesController@extensionLogin');
Route::post('/api/extension-get-sequences', 'Api\SequencesController@extensionGetSequences');

