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

Route::get('', 'AnalyzerController@intro')->name('analyzer.get'); // DONE
Route::post('', 'AnalyzerController@analyze')->name('analyzer.post'); // DONE
