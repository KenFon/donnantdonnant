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

Route::get('/', 'HomeController@index')->name('home');


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Auth::routes();


Route::group(['prefix' => 'user'], function() {
    Route::get('/', 'UsersController@show')->name('user.show')->middleware('auth');
    Route::get('show/{name?}', 'UsersController@index')->name('user.index')->middleware('auth');
});

/*Route des annonces, ajout de la contrainte d'être connecter pour edit d'une annonce plus personnalisation des vues index et show */

Route::resource('annonces', 'AdController')
    ->parameters(['annonces'=>'ad'])
    ->except(['index', 'show', 'destroy'])->middleware('auth');

/*Route personnalisée, gère aussi bien le show, la gestion des deux types d'annonce et de la recherche ajax sur la page d'accueil
et sur la page index des annonces.*/ 
Route::prefix('annonces')->group(function(){
    Route::get('/{id}/{slug?}', 'AdController@show')->name('annonces.show');
    Route::get('', 'AdController@index')->name('annonces.index');
    Route::post('recherche', 'AdController@search')->name('annonces.search');
    Route::post('offre', 'AdController@offer')->name('annonces.offer');
    Route::delete('/destroy/{ad?}', 'AdController@destroy')->name('annonces.destroy');
    Route::post('/responseAd', 'AdController@responseAd')->name('annonces.responseAd');
});

/*Route pour les commentaires*/
Route::post('comment/store', 'CommentsController@store')->name('comment.store');
