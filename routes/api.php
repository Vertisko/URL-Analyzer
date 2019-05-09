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
    Route::get('', 'AnalyzerController@analyze')->name('analyzer.get'); // DONE
    Route::get('http', 'AnalyzerController@http2test')->name('analyzer.http'); // DONE
    Route::get('alts', 'AnalyzerController@missingAlts')->name('analyzer.alts'); // DONE

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

Route::prefix('insight')->group(function () {
    Route::get('', 'PageSpeedInsightController@insightAnalysis')->name('insight.insightAnalysis'); // DONE
});

