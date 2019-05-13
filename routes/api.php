<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('analyzer')->group(function () {
    Route::post('', 'AnalyzerController@analyzeJson')->name('analyzer.post'); // DONE
});

Route::prefix('curl')->group(function () {
    Route::get('body', 'ClientUrlController@body')->name('curl.body'); // DONE
    Route::get('header', 'ClientUrlController@header')->name('curl.header'); // DONE
});

Route::prefix('image-alt')->group(function () {
    Route::get('', 'ImageAltController@altsComputation')->name('imageAlt.altsComputation'); // DONE
});

Route::prefix('http')->group(function () {
    Route::get('', 'HttpController@httpTest')->name('http.httpTest'); // DONE
});

Route::prefix('gzip')->group(function () {
    Route::get('', 'GzipEncodingController@gzipTest')->name('gzip.gzipTest'); // DONE
});

Route::prefix('webp')->group(function () {
    Route::get('', 'ImageWebPController@webPTest')->name('webP.webPTest'); // DONE
});

Route::prefix('insight')->group(function () {
    Route::get('', 'PageSpeedInsightController@insightAnalysis')->name('insight.insightAnalysis'); // DONE
});

