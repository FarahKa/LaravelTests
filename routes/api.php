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

Route::group(['middleware' => ['cors', 'json.response']], function () {

    Route::middleware('auth:api')->get('/user', function (Request $request) {
        return $request->user();
    });

    Route::middleware('auth:api')->group(function () {
        Route::get('/articles', 'ArticleController@index')->name('articles')->middleware(['scopes:see-articles']);
        Route::get('/patchArticle', 'ArticleController@update')->name('patchArticle')->middleware(['scopes:update-article']);
        Route::post('/logout', 'Auth\ApiAuthController@logout')->name('logout.api');
    });

    // public routes
    Route::post('/login', 'Auth\ApiAuthController@login')->name('login.api');
    Route::post('/register','Auth\ApiAuthController@register')->name('register.api');



});


/*
Route::middleware('auth:api')->group( function () {

    Route::resource('products', 'API\ProductController');

});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/
