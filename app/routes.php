<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('home/principal');
});

Route::get('principal', 'HomeController@principal');

Route::resource('tipo', 'TiposController', array('except' => array('show')));
Route::resource('genero', 'GenerosController', array('except' => array('show')));
Route::resource('filme', 'FilmesController');

Route::get('form', 'ContatosController@form');  
Route::post('send', 'ContatosController@send');