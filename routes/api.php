<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


// необходимо писать полное название пространства имен и отчищать кэш роута после изменения

// получение  записи из таблицы по id
Route::get('country/{id}', 'App\Http\Controllers\Api\Country\CountryController@countryById');
// вход по логину и паролю. Возвращается токен
Route::post('login', 'App\Http\Controllers\Api\Auth\LoginController@login');
// добавление записи в таблицу методом firstOrCreate()
Route::post('countryfoc', 'App\Http\Controllers\Api\Country\CountryController@countrySaveFOC');

Route::group([

    'middleware' => ['jwt.verify']],

    function () {
    // редактирование записи в таблице. можно редактировать только одно поле
    Route::put('country/{id}', 'App\Http\Controllers\Api\Country\CountryController@countryEdit');
    // удаление строки из таблицы
    Route::delete('country/{id}', 'App\Http\Controllers\Api\Country\CountryController@countryDelete');
    // получение всех записей из таблицы
    Route::get('/country', 'App\Http\Controllers\Api\Country\CountryController@country');
    // добавление записи в таблицу методом create()
    Route::post('country', 'App\Http\Controllers\Api\Country\CountryController@countrySave');
    // обновление токена
    Route::get('refresh', 'App\Http\Controllers\Api\Auth\LoginController@refresh');
});




// это из https://www.youtube.com/watch?v=c9ULPmk949I
Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    // вход по логину. в ответ получает токен
    Route::post('login', 'App\Http\Controllers\AuthController@login');
    Route::post('logout', 'App\Http\Controllers\AuthController@logout');
    Route::post('refresh', 'App\Http\Controllers\AuthController@refresh');
    Route::get('user', 'App\Http\Controllers\AuthController@user');

    // роут регистрации ( '/api/auth/register' )
    Route::post('register', 'App\Http\Controllers\Auth\RegisterController@register');

});
